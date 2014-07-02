<?php

/**
 * Subclass for representing a row from the 'project' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Project extends BaseProject
{
    public function getProjectMember(){
        if(!$this->getId()) return array();
        $criteria = new Criteria();
        $criteria->addJoin(ProjectMemberPeer::PROJECT_ID, ProjectPeer::ID, Criteria::LEFT_JOIN);
        $criteria->add(ProjectPeer::ID, $this->getId());
        $criteria->setDistinct();
        $projectMembers = ProjectMemberPeer::doSelect($criteria);
        return $projectMembers;
        
    }
    
    public function hasMilestone(){
        if(!$this->getId()) return false;
        if($this->getPhase() == ProjectPeer::PROJECT_PHASE){
            return true;
        } 
        return false;
    }
    
    public function checkChangeAndInsertData($changeArray){ 
        if(!$this->isNew()){
            $project = ProjectPeer::retrieveByPK($this->getId());
            $projectHistory = new ProjectHistory();
            $data = $project->toArray(); 
            $data['ProjectId'] = $this->getId();
            $data['UpdatedAt'] = date('Y-m-d H:i:s');
            $checkArray = array(
                        'StartDate' => ProjectPeer::START_DATE, 
                        'EndDate'=>ProjectPeer::END_DATE,
                        //'IsBuyTheTenderDocument'=>ProjectPeer::IS_BUY_THE_TENDER_DOCUMENT, 
                        //'TenderDocumentPrice'=>ProjectPeer::TENDER_DOCUMENT_PRICE,
                        'TenderingStatus'=>Projectpeer::TENDERING_STATUS,
                        'Comment'=>ProjectPeer::COMMENT,
                        'Modifier'=>ProjectPeer::MODIFIER    
                  );  
            $flag = false; 
            if($data['TenderDocumentPrice'] != $changeArray['TenderDocumentPrice']){
                    $flag = true;
                    $data['TenderDocumentPrice'] = $changeArray['TenderDocumentPrice'];
            } 
            
            if($data['IsBuyTheTenderDocument'] != $changeArray['IsBuyTheTenderDocument']){
                    $flag = true;
                    $data['IsBuyTheTenderDocument'] = $changeArray['IsBuyTheTenderDocument'];
            }            
            
            foreach($checkArray as $key=>$col){
                if($this->isColumnModified($col)){
                    $data[$key] = $changeArray[$key];
                    $flag = true;
                }      
            } 
            if($flag){               
                $projectHistory->fromArray($data);
                $projectHistory->save();
            }         
        }

    }
    
    public function getProjectMilestones(){
        $criteria = new Criteria();
        $criteria->add(MilestonePeer::PROJECT_ID, $this->getId() );
        $criteria->addAscendingOrderByColumn(MilestonePeer::ID);
        $mileStons = MilestonePeer::doSelect($criteria);
        return $mileStons;
    }
    public function isUserInProjectOrProjectCreater($user){
        $userId = $user->getUserId();
        $isSuperAdmin = $user->getGuardUser()->getIsSuperAdmin();
        $isInProject = $this->isUserInProject($userId);
        $isProjectCreater = $this->isProjectCreater($userId);
        if($isSuperAdmin || $isInProject || $isProjectCreater){
            return true;
        }
        return false;

    }
    
    public function isUserInProject($userId){
        $criteria = new Criteria();
        $criteria->add(ProjectMemberPeer::PROJECT_ID, $this->getId());
        $criteria->add(ProjectMemberPeer::SF_GUARD_USER_ID, $userId);
        $user = ProjectMemberPeer::doSelectOne($criteria);
        if($user){
            return true;
        }
        return false;
    }
    public function isProjectCreater($userId){
        if($this->getCreator() == $userId){
            return true;
        }
        return false;
    }
    /**
     * rewrite save
     * wuyou <you.wu@expacta.com.cn>
     */
    public function save($con = null){
        $project = ProjectPeer::retrieveByPK($this->getId());
        if($project && $project->getIsProjectEnd()){
            throw new PropelException("该项目已经终止了。你不能在进行操作了。");
        }
        return parent::save($con);
    }

}
