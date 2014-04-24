<?php

/**
 * Subclass for performing query and update operations on the 'application' table.
 *
 * 
 *
 * @package lib.model
 */
class ApplicationPeer extends BaseApplicationPeer {

    const NAMEFIELD = '审批流程';
    const PENDIND = '等待审批';
    const APPROVAL = '正在审批中';
    const DECLINE = '审批被驳回';
    const COMPLETE = '审批完成';

    public static function getApplicationInfo($applicationId) {
        try {
            $applicationInfo = array();
            $sql = 'SELECT application.id AS application_id, application.name AS application_name, application.created_at AS application_created_at, sf_guard_user_profile .* FROM %%application%% AS application
                    LEFT JOIN %%sf_guard_user%% AS sf_guard_user ON(application.sf_guard_user_id = sf_guard_user.id) 
                    LEFT JOIN %%sf_guard_user_profile%% AS sf_guard_user_profile ON(sf_guard_user.id = sf_guard_user_profile.user_id) 
                    WHERE application.id = ?';

            $tmpMap = array(
                '%%application%%' => ApplicationPeer::TABLE_NAME,
                '%%sf_guard_user%%' => sfGuardUserPeer::TABLE_NAME,
                '%%sf_guard_user_profile%%' => sfGuardUserProfilePeer::TABLE_NAME,
            );
            $sql = strtr($sql, $tmpMap);
            $p = array($applicationId);
            $resultSet = DBUtil::execSql($sql, $p, "");
            $applicationInfo = array();
            while ($resultSet->next()) {
                $row = $resultSet->getRow();
                $applicationInfo = array(
                    'application_id' => $row['application_id'],
                    'creator' => $row['last_name'] . $row['first_name'],
                    'created_time' => $row['application_created_at'],
                    'name' => $row['application_name']
                );
            }
            $responseData = array('application_info' => $applicationInfo);
            return $responseData;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * get approval status list
     * @return array
     * @issue 2337
     * @author brave
     */
    public static function getApprovalStatus($status = false) {
        $statusList = array(
            0 => self::PENDIND,
            1 => self::APPROVAL,
            2 => self::DECLINE,
            3 => self::COMPLETE,
        );
        return $status === false ? $statusList : $statusList[$status];
    }

    public static function getApprovalInfo($type, $id) {
        $obj = '';
        $c = new Criteria();
        if($type == ApprovalPeer::ENGINEERING_GOODS){
            $c->add(EngineeringGoodsPeer::APPLICATION_ID, $id);
            $c->addJoin(EngineeringGoodsPeer::ID, EngineeringGoodsItemsPeer::ENGINEERING_GOODS_ID);
            $obj = EngineeringGoodsPeer::doSelectOne($c);
        }elseif ($type == ApprovalPeer::ENGINERRING_SUMMARY) {
            $c->add(EngineeringSummaryPeer::APPLICATION_ID, $id);
            $c->addJoin(EngineeringSummaryPeer::ID, EngineeringSummaryItemsPeer::ENGINEERING_SUMMARY_ID);
            $obj = EngineeringSummaryPeer::doSelectOne($c);
        } elseif ($type == ApprovalPeer::ENGINEERING_MATERIALS) {
            $c->add(EngineeringMaterialsPeer::APPLICATION_ID, $id);
            $c->addJoin(EngineeringMaterialsPeer::ID, EngineeringMaterialsItemsPeer::ENGINEERING_MATERIALS_ID);
            $obj = EngineeringMaterialsPeer::doSelectOne($c);
        } elseif ($type == ApprovalPeer::ENGINERRING_SETTLEMENT) {
            $c->add(EngineeringSettlementPeer::APPLICATION_ID, $id);
            $obj = EngineeringSettlementPeer::doSelectOne($c);
        }
        return $obj;
    }

    /**
     * 
     * @param      $tel , $id
     * @return     code
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-12-2    
     * @issue      2344  -  app approval
     * @desc       echo html code
     */
    public static function getFormDetail($tel, $id) {
        try {
            $sfGuardUserId = sfGuardUserProfilePeer::getUserByTel($tel)->getUserId();
            $application = ApplicationPeer::retrieveByPK($id);
            $approvalId = $application->getApprovalId();
            $name = $application->getName();
            $project = $application->getProject();
            $obj = self::getApprovalInfo($approvalId, $id);
            $paramets = array(
                'name' => $name,
                'project' => $project,
                'type' => $approvalId,
                'obj' => $obj,
            );
            return $paramets;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * 
     * @param int $approvalId
     * @param int $applicationId
     * @param boolean $isShow 
     * @return string
     * @issue 2337
     * @author brave
     */
    public static function getRedirectPageByApproval($approvalId, $applicationId, $isShow = false) {
        //check is delete 
        $application = ApplicationPeer::retrieveByPK($applicationId);
        if ($application->getIsValid() == 1) {
            return false;
        }
        $request = sfContext::getInstance()->getRequest();
        $urlHost = $request->getUriPrefix();
        switch ($approvalId) {
            case ApprovalPeer::ENGINERRING_SUMMARY:
                $url = $isShow ? '/engineeringSummary/read' : '/engineeringSummary/edit';
                break;
            case ApprovalPeer::ENGINEERING_MATERIALS:
                $url = $isShow ? '/engineeringMaterials/read' : '/engineeringMaterials/edit';
                break;
            case ApprovalPeer::ENGINERRING_SETTLEMENT:
                $url = $isShow ? '/engineeringSettlement/read' : "/engineeringSettlement/edit";
                break;
            case ApprovalPeer::ENGINEERING_GOODS:
                $url = $isShow ? '/engineeringGoods/read' : "/engineeringGoods/edit";
                break;
        }
        return $urlHost . $url . '/id/' . $applicationId . '/approvalType/' . $approvalId;
    }

    /**
     * @issue 2337
     * @author brave
     */
    public static function updateApplicationStatus($applicationId, $applicationWorkflowStatus) {
        $application = ApplicationPeer::retrieveByPK($applicationId);
        $application->setCurrentStatus($applicationWorkflowStatus);
        $application->save();
    }

}
