<?php

/**
 * Subclass for performing query and update operations on the 'daily_report' table.
 *
 * 
 *
 * @package lib.model
 */ 
class DailyReportPeer extends BaseDailyReportPeer
{
    public static function isProjectMemberByProjectId($projectId, $user){
        $status = false;
        $userId = $user->getId();
        $c = new Criteria();
        $c->add(ProjectMemberPeer::PROJECT_ID, $projectId);
        $c->add(ProjectMemberPeer::SF_GUARD_USER_ID, $userId);
        $projectMember = ProjectMemberPeer::doSelect($c);
        $project = ProjectPeer::retrieveByPK($projectId);
        if($project && $project->getCreator() == $userId || $projectMember){
            $status = true;
        }
        return $status;
    }
}
