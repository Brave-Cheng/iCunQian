<?php

/**
 * Subclass for representing a row from the 'project_history' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ProjectHistory extends BaseProjectHistory
{
    public function getProjectModifier(){
        if(!$this->getModifier()) return null;
        $criteria = new Criteria();
        $criteria->add(sfGuardUserProfilePeer::USER_ID, $this->getModifier());
        $user = sfGuardUserProfilePeer::doSelectOne($criteria);
        return $user;
    }
    
    public function getChangeColor($index=0, $colorColumn){
        if(!$this->getId()) return array();
        $currentProjectArray = $this->getProjectHistory($index);       
        $prevProjectArray = $this->getProjectHistory($index+1);

        foreach($currentProjectArray as $key=>$project){
            if(($project != $prevProjectArray[$key]) && $prevProjectArray){
                $colorColumn[$key] = 'red';
            }
        } 
        return $colorColumn;       
    }
    public function getProjectHistory($index){
        $criteria = new Criteria();
        $criteria->add(ProjectHistoryPeer::PROJECT_ID, $this->getProjectId());
        $criteria->addDescendingOrderByColumn(ProjectHistoryPeer::ID);
        $criteria->addDescendingOrderByColumn(ProjectHistoryPeer::UPDATED_AT);
        $criteria->setOffset($index);
        $criteria->setLimit(1);
        $currentProject = ProjectHistoryPeer::doSelectOne($criteria);
        if($currentProject){
            return $currentProject->toArray();
        }
        return null;
    }
}
