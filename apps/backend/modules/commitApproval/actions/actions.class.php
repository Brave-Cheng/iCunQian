<?php

/**
 * commitApproval actions.
 *
 * @package    oa
 * @subpackage commitApproval
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class commitApprovalActions extends BaseBackends
{

    const NOSING = '注意，您还没有上传签名，您将无法进行审批，请先到个人中心上传您的签名';

    /**
     * get module permission
     * @issue 2337
     * @author brave
     */
    public function preExecute() {
        parent::preExecute();
        $userProfile = $this->getUser()->getGuardUser()->getProfile();
        $this->accessRead = $userProfile->moduleAccess($this->getModuleName(), 'read');
        $this->accessCreate = false;
        $this->accessUpdate = false;
        $this->accessDelete = false;
        if ($this->getUser()->getGuardUser()->getIsSuperAdmin() != '1') {
            $this->accessCreate = $userProfile->moduleAccess($this->getModuleName(), 'add');
            $this->accessUpdate = $userProfile->moduleAccess($this->getModuleName(), 'update');
            $this->accessDelete = $userProfile->moduleAccess($this->getModuleName(), 'delete');
        }
    }

    /**
     * get this module access 
     * @issue 2347
     * @modified brave
     */
    public function executeIndex() {
        $this->hasSignatureImage = true;
        if(!$this->getUser()->isSuperAdmin()){
            $userSignatureImage = $this->getUser()->getGuardUser()->getProfile()->getSignatureImage();
            if(!$userSignatureImage || !file_exists(sfGuardUserProfilePeer::getSignatureImageDir() . $userSignatureImage )){
                $this->hasSignatureImage = false;
            }
        }
        $this->getFilterApplication();
        $this->approvalList = ApprovalPeer::doSelect(new Criteria());
        $this->projectTypes = ProjectPeer::getTypes();
        array_unshift($this->projectTypes, '所有项目');
    }

    /**
     * @issue 2337
     * @author brave
     */
    protected function getFilterApplication() {
        $p = array();
        $sql = 'SELECT DISTINCT a.* FROM ' . ApplicationPeer::TABLE_NAME .
                ' AS a LEFT JOIN ' . ProjectPeer::TABLE_NAME .
                ' AS b on a.project_id = b.id LEFT JOIN application_work_flow AS c ON a.id = c.application_id WHERE 1 AND a.is_valid is null ';
        $this->projectType = $this->getRequestParameter('projectType');
        if ($this->projectType) {
            $sql .= ' AND b.type = ? ';
            $p[] = $this->projectType;
        }
        $this->keywords = trim(urldecode($this->getRequestParameter('keywords')));
        $this->keywords = util::replaceSpecialChar($this->keywords);
        if (strlen($this->keywords)) {
            $sql .= ' AND a.name LIKE ? ';
            $p[] = "%{$this->keywords}%";
        }
        $this->approvalId = $this->getRequestParameter('approvalId');
        if ($this->approvalId) {
            $sql .= ' AND a.approval_id = ? ';
            $p[] = $this->approvalId;
        }
        if (false == $this->getUser()->isSuperAdmin()) {
            $sql .= ' AND ( a.sf_guard_user_id = ? OR c.sf_guard_user_id = ? ) ';
            $p[] = $this->getUser()->getGuardUser()->getId();
            $p[] = $this->getUser()->getGuardUser()->getId();
        }
        $sql .=' ORDER BY a.ID DESC';
        $countSql = str_replace('a.*', 'COUNT(DISTINCT a.id) as count', $sql);
        $this->pager = DBUtil::pagerSql($sql, $p, 'ApplicationPeer', $countSql);
    }

    /**
     * executeSelectApprovalType- select approval type 
     * @author you.wu <you.wu@expacta.com.cn>
     * @issue 2337
     * @modified brave
     */
    public function executeSelectApprovalType() {
        $this->approvalTypes = ApprovalPeer::getApprovalTypeList();
    }

    /**
     * executeInsertApprovalType - insert approval type 
     * @author you.wu <you.wu@expacta.com.cn>
     * @issue <2337>
     * @midified brave
     */
    public function executeInsertApprovalType() {
        if ($this->getRequest()->getMethod() == sfRequest::POST) {
            $type = $this->getRequestParameter('types');
            $this->getUser()->setAttribute('approvalType', $type);
            switch ($type) {
                case ApprovalPeer::ENGINERRING_SUMMARY:
                    return $this->redirect('engineeringSummary/create');
                    break;
                case ApprovalPeer::ENGINEERING_MATERIALS:
                    return $this->redirect('engineeringMaterials/add');
                    break;
                case ApprovalPeer::ENGINERRING_SETTLEMENT:
                    return $this->redirect('engineeringSettlement/add?approvalType=' . $this->getRequestParameter('types'));
                    break;
                case ApprovalPeer::ENGINEERING_GOODS:
                    return $this->redirect('engineeringGoods/add');
                    break;
                default:
                    $this->forward404();
                    break;
            }
        } else {
            $this->forward404();
        }
    }

    /**
     * delete a user application
     * @issue 2337
     * @author brave, ice
     */
    public function executeDelete() {
        $deleteId = $this->getRequestParameter('deleteId');
        if($deleteId){
            if(is_array($deleteId)){
                $applications = ApplicationPeer::retrieveByPKs($deleteId);
                foreach($applications as $application){
                    $application->setIsValid(1);
                    $application->save();
                }
            }else{
                $application = ApplicationPeer::retrieveByPK($deleteId);
                $application->setIsValid(1);
                $application->save();
            }
            $this->setFlash('flag', '1');
            return  $this->redirect('commitApproval/index?' . html_entity_decode(util::formGetQuery("projectType", "approvalId", 'page', 'keywords')));
        }
        $this->setFlash('flag', '0');
        $this->redirect('commitApproval/index?' . html_entity_decode(util::formGetQuery("projectType", "approvalId", 'page', 'keywords')));
    }

    /**
     * update an application workflow
     * @issue 2337
     * @author brave
     */
    public function executeUpdateApplication() {
        $res['error'] = 1;
        //check user sign
        if (!sfGuardUserProfilePeer::hasSingatureImage($this->getUser()->getGuardUser()->getId())) {
            $res['msg'] = self::NOSING;
            $res['error'] = 2;
            die(json_encode($res));
        }
        $applicationId = $this->getRequestParameter('applicationId');
        $approvalComment = $this->getRequestParameter('approvalComment');
        $approvalResult = $this->getRequestParameter('approvalResult');
        $workflowId = $this->getRequestParameter('workflowId');
        try {
            ApplicationWorkFlowPeer::setApplicationResult($applicationId, $workflowId, $approvalResult, $approvalComment);
        } catch (Exception $exc) {
            $res['msg'] = $exc->getMessage();
            $res['error'] = 3;
            die(json_encode($res));
        }
        die(json_encode($res));
    }

}
