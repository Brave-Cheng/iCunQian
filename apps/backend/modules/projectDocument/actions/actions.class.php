<?php

/**
 * projectDocument actions.
 *
 * @package    oa
 * @subpackage projectDocument
 * @author     ice.leng<ice.leng@expacta.com.cn>
 * @version    2329 - projectDocument  manager
 */
class projectDocumentActions extends BaseBackends
{
    public function preExecute(){
        parent::preExecute();
        $userProfile = $this->getUser()->getGuardUser()->getProfile();
        $this->accessUpdate = $userProfile->moduleAccess($this->getModuleName(), 'update');
    }
    /**
     *@param       $projectId - project id
     *             $documents - document object
     * @return     null
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-10-25
     * @issue      2329 - projectDocument  manager
     * @desc       Modify the project document related information
     */
    public function executeEdit(){
        $projectId = $this->getRequestparameter('projectId');
        $this->project = ProjectPeer::retrieveByPK($projectId);
        if(!$this->project->isUserInProjectOrProjectCreater($this->getUser())) $this->redirect('dashboard/index');
        $this->forward404Unless($this->project);
        $c = new Criteria();
        $c->add(ProjectDocumentPeer::PROJECT_ID, $projectId);
        $c->addAscendingOrderByColumn(ProjectDocumentPeer::ID);
        $documents = ProjectDocumentPeer::doSelectJoinDocument($c);
        $this->documents = $documents;
    }
    /**
     *
     * @param      $projectId - project id
     *             $titles    - page to return to all title
     *             $issues    - page to return to all issue
     *             $documentNumbers - page to return to all documentNumber
     *             $contractNumbers - page to return to all contractNumber
     * @return     edit document page
     *             msg - judge number
     *             projectId - project id
     * @author     ice.leng<ice.leng@expacta.com.cn>
     * @date       2013-10-25
     * @issue      2329 - projectDocument  manager
     * @desc       first, delete the related project documents,then add document.
     *             and written to the system log
     */
    public function executeUpdate(){
        $projectId = $this->getRequestparameter('projectId');
        $project   = ProjectPeer::retrieveByPK($projectId);
        $this->forward404Unless($project);
        $titles = $this->getRequestParameter('title');
        $issues = $this->getRequestParameter('issue');
        $documentNumbers = $this->getRequestParameter('documentNumber');
        $contractNumbers = $this->getRequestParameter('contractNumber');
        $criteria = new Criteria();
        $criteria->add(ProjectPeer::ID, $projectId);
        $projectObj = ProjectPeer::doSelectOne($criteria);
        $projectDocuments = $projectObj->getProjectDocuments();
        foreach ($projectDocuments as $projectDocument){
            $projectDocument->getDocument()->delete();
            UserLogPeer::writeLog($projectDocument->getDocument()->getId(), 1);
        }
        $projectName = $project->getName();
        $proprietor  = $project->getProprietor();
        $blockNumber = $project->getBlockNumber();
        if(isset($titles)){
            foreach ($titles as $key=>$title){
                $document = new Document();
                $document->setTitle(trim($title));
                $document->setIssue(isset($issues[$key])?trim($issues[$key]):null);
                $document->setContractNumber(isset($contractNumbers[$key])?trim($contractNumbers[$key]):null);
                $document->setDocumentNumber(isset($documentNumbers[$key])?trim($documentNumbers[$key]):null);
                $document->setProprietor($proprietor);
                $document->setNew($projectName);
                $document->setBlockNumber($blockNumber);
                $document->setModifier($this->getUser()->getUserId());
                $document->save();
                $documentId = $document->getId();
                UserLogPeer::writeLog($documentId);
                $projectDocument = new ProjectDocument();
                $projectDocument->setDocumentId($documentId);
                $projectDocument->setProjectId($projectId);
                $projectDocument->save();
            }
        }
        return $this->redirect('projectDocument/edit?projectId='.$projectId.'&' . html_entity_decode(util::formGetQuery("keywords", 'type', 'pager')).'&msg=1');
    }
    public function executeCheckDocument(){
        $status = false;
        $paramets = array(
                'Proprietor' => $this->getRequestParameter('proprietor'),
                'BlockNumber' => $this->getRequestParameter('blockNumber'),
                'DocumentNumber' => $this->getRequestParameter('documentNumber'),
                'Title' => $this->getRequestParameter('title'),
                'ContractNumber' => $this->getRequestParameter('contractNumber'),
                'Issue' => $this->getRequestParameter('issue')
        );
        $projectId = $this->getRequestParameter('project');
        if($this->getRequestParameter('projectId')){
            // project document validate
            $document = array();
            $projectId = $this->getRequestParameter('projectId');
            $paramets = array(
                    'DocumentNumber' => $this->getRequestParameter('documentNumber'),
                    'Title' => $this->getRequestParameter('title'),
                    'ContractNumber' => $this->getRequestParameter('contractNumber'),
                    'Issue' => $this->getRequestParameter('issue')
            );
            $c = new Criteria();
            $c->add(ProjectDocumentPeer::PROJECT_ID, $projectId);
            $c->addAscendingOrderByColumn(ProjectDocumentPeer::ID);
            $projectDocuments = ProjectDocumentPeer::doSelect($c);
            if($projectDocuments){
                foreach ($projectDocuments as $projectDocument){
                    $document[] = isset($projectDocument) ? $projectDocument->getDocument() : null;
                }
            }
            $status = util::isModified($document, 'DocumentPeer', $paramets);
        }else{
            // validate project
            foreach ($paramets as $paramet){
                if($paramet != null || $projectId != null){
                    $status = true;
                }
            }
        }
        exit($status);
    }
    public function executeValidateDocumentNumber(){
        $documentNumber = $this->getRequestParameter('documentNumber');
        $c = new Criteria();
        $c->add(DocumentPeer::DOCUMENT_NUMBER, $documentNumber);
        $documentObj = DocumentPeer::doSelect($c);
        echo $documentObj ? 1 : 0 ;
        exit;
    }
}
