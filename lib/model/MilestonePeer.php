<?php

/**
 * Subclass for performing query and update operations on the 'milestone' table.
 *
 * 
 *
 * @package lib.model
 */ 
class MilestonePeer extends BaseMilestonePeer
{
    /**
     * @param int $projectId
     * @return array
     * @issue 2333
     * @author brave
     */
    public static function getProjectMilestoneList($projectId) {
        $milestoneList = array();
        $criteria = new Criteria();
        $criteria->add(MilestonePeer::PROJECT_ID, $projectId);
        $milestones = MilestonePeer::doSelect($criteria);
        if ($milestones) {
            foreach ($milestones as $index => $milestone) {
                $index +=1;
                $milestoneList[$milestone->getId()] = "第" . $index . "阶段";
            }
        }
        return $milestoneList;
    }
}
