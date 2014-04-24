<?php

/**
 * Subclass for performing query and update operations on the 'project_role' table.
 *
 * 
 *
 * @package lib.model
 */
class ProjectRolePeer extends BaseProjectRolePeer {

    const RESPONSIBLE_VICE_PRESIDENT = 1;
    const PROJECT_VP = '项目分管副总';
    const PROJECT_FM = '财务部经理';
    const PROJECT_FA = '财务工程会计';
    const PROJECT_PM = '项目经理';
    const PROJECT_FD = '财务部';
    const PROJECT_TD = '技术负责人';
    const PROJECT_FE = '现场工程师';
    const PROJECT_TL = '现场负责人';
    const PROJECT_FL = '施工队负责人';

    const CUSTOME_ROLE = 12;
    public static function getProjectRoleByUserId($id, $projectId) {
        $c = new Criteria();
        $c->add(ProjectMemberPeer::SF_GUARD_USER_ID, $id);
        $c->add(ProjectMemberPeer::PROJECT_ID, $projectId);
        $c->addJoin(ProjectMemberPeer::PROJECT_ROLE_ID, ProjectRolePeer::ID);
        $projectRole = ProjectMemberPeer::doSelectOne($c);
        if ($projectRole) {
            return $projectRole->getProjectRoleid();
        }
        return 0;
    }

    public static function getAllProjectRoles() {
        $c = new Criteria();
        $c->addAscendingOrderByColumn(ProjectRolePeer::ID);
        $projectRoles = ProjectRolePeer::doSelect($c);
        return $projectRoles;
    }
    
    

}
