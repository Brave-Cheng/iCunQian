<?php

/**
 * Subclass for performing query and update operations on the 'project_member' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ProjectMemberPeer extends BaseProjectMemberPeer
{
    public static function getProject($tel){
        try{
            $criteria = new Criteria();
            $sfGuardUserId = sfGuardUserProfilePeer::getUserByTel($tel)->getUserId();
            $userId  = sfGuardUserPeer::retrieveByPK($sfGuardUserId);
            if(!$userId) return array();
            $criteria->addJoin(ProjectPeer::ID, ProjectMemberPeer::PROJECT_ID, Criteria::LEFT_JOIN);
            $criteria->add(ProjectPeer::IS_PROJECT_END, 0);
            $criteria->add(ProjectMemberPeer::SF_GUARD_USER_ID, $sfGuardUserId);
            $criteria->setDistinct();
            $projects = ProjectPeer::doSelect($criteria);
            $projectList = array();
            foreach($projects as $project){
                $projectList[] = array(
                    'id' => $project->getId(),
                    'name' => $project->getName()            
                ); 
            }
            $responseData = array('project_list'=>$projectList);
            return $responseData;
        }catch(Exception $e){
           throw $e;
        }
        
    }  
    /**
     * getProjectMembersInfoByProjectId -- get project members by projectId
     * @author you.wu <you.wu@expacta.com.cn>
     */
    public static function getProjectMembersInfoByProjectId($projectId){
        try{
            $sql = 'SELECT sf_guard_user_profile.* FROM %%sf_guard_user%% AS sf_guard_user 
                    LEFT JOIN %%sf_guard_user_profile%% AS sf_guard_user_profile ON (sf_guard_user . id = sf_guard_user_profile .user_id) 
                    LEFT JOIN %%project_member%% AS project_member ON(sf_guard_user . id = project_member . sf_guard_user_id) 
                    LEFT JOIN %%project_role%% AS project_role ON (project_member . project_role_id = project_role .id) 
                    WHERE project_member.project_id = ? AND project_role.id IN (1, 4) AND sf_guard_user.is_active =1';
            $tmpMap = array(
                 '%%sf_guard_user%%' => sfGuardUserPeer::TABLE_NAME,
                 '%%sf_guard_user_profile%%' => sfGuardUserProfilePeer::TABLE_NAME,
                 '%%project_member%%' => ProjectMemberPeer::TABLE_NAME,
                 '%%project_role%%' => ProjectRolePeer::TABLE_NAME
            );
            $sql = strtr($sql, $tmpMap);
            $p = array($projectId);
            $resultSet = DBUtil::execSql($sql, $p, "");
            $memberInfo = array();
            while($resultSet->next()){
                $row = $resultSet->getRow();
                $memberInfo[] = $row;
            }
            return $memberInfo;
        }catch(Exception $e){
            throw $e;
        }
    }
    
    public static function checkInDepartment($departmentId, $userId){
        $criteria = new Criteria();
        $criteria->add(DepartmentSfGuardUserPeer::DEPARTMENT_ID, $departmentId);
        $criteria->add(DepartmentSfGuardUserPeer::SF_GUARD_USER_ID, $userId);
        $count = DepartmentSfGuardUserPeer::doCount($criteria);
        if($count){
            return true;
        }
        return false;
    }
    
    public static function getProjectMemberByProjectRoleId($projectRoleId, $projectId, $onlyOne=true){
        $sql = 'SELECT sf_guard_user_profile.* FROM %%sf_guard_user%% AS sf_guard_user 
                LEFT JOIN %%sf_guard_user_profile%% AS sf_guard_user_profile ON(sf_guard_user.id = sf_guard_user_profile . user_id) 
                LEFT JOIN %%project_member%% AS project_member ON(sf_guard_user.id = project_member.sf_guard_user_id) 
                WHERE project_member.project_id =? AND project_member.project_role_id =?';
        $tmpMap = array(
                '%%sf_guard_user%%' => sfGuardUserPeer::TABLE_NAME,
                '%%sf_guard_user_profile%%' => sfGuardUserProfilePeer::TABLE_NAME,
                '%%project_member%%' => ProjectMemberPeer::TABLE_NAME
            );
        $p = array($projectId, $projectRoleId);
        $sql = strtr($sql, $tmpMap);
        $resultSet = DBUtil::execSql($sql, $p, "");
        $members = array();
        while($resultSet->next()){
            $row = $resultSet->getRow();
            $members[] = $row;
        }
        if($onlyOne && $members){
            return $members[0];
        }
        var_dump($members);exit;
        return $members;
    }
}
