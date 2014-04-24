<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardUser.php 7633 2008-02-27 17:54:50Z fabien $
 */
class sfGuardUser extends PluginsfGuardUser
{
    /**
     * getDepartments - get all departments assign to user
     * @return array departments
     * @author john.mao <john.mao@expacta.com.cn>
     * @issue - 2321
     */
    public function getDepartments(){
        $departments = array();
        $departmentSfGuardUsers = $this->getDepartmentSfGuardUsersJoinDepartment();
        foreach ($departmentSfGuardUsers as $departmentSfGuardUser) {
            $department = $departmentSfGuardUser->getDepartment();
            if($department){
                $departments[] = $department;
            }
        }
        return $departments;
    }

    /**
     * getDepartmentNameString - get department name
     * @param  string - $seperator 
     * @return string - Department name string
     * @author john.mao <john.mao@expacta.com.cn>
     * @issue - 2321
     */
    public function getDepartmentNameString($seperator=','){
        $departmentNames = array();
        $departments = $this->getDepartments();
        foreach ($departments as $department) {
            $departmentNames[] = $department->getName();
        }
        return implode($seperator, $departmentNames);
    }

    /**
     * getProjects - get all projects assign to user
     * @return array projects
     * @author hang.lu <hang.lu@expacta.com.cn>
     * @issue - 2321
     */
    public function getProjects(){
        $projects = array();
        $projectMembers = $this->getProjectMembersJoinProject();
        foreach ($projectMembers as $projectMember) {
            $project = $projectMember->getProject();
            if($project){
                $projects[] = $project;
            }
        }
        return $projects;
    }

    /**
     * getProjectNameString - get project name
     * @param  string $seperator 
     * @return string - Project name string
     */
    public function getProjectNameString($seperator=','){
        $projectNames = array();
        $projects = $this->getProjects();
        foreach($projects as $project){
            $projectNames[] = $project->getName();
        }
        return implode($seperator, $projectNames);
    }

    public function getDepartmentSfUser( $sfUser ){
        $departmentSfGuardUsers = $sfUser->getDepartmentSfGuardUsers();
        if( !empty($departmentSfGuardUsers) ){
            foreach ($departmentSfGuardUsers as $departmentSfGuardUser){
                $departmentSfUser = $departmentSfGuardUser;
            }
            return $departmentSfUser;
        }
        return null;
    }

    public function getUserAllPermissions(){
        $permissions = $this->getAllPermissions();
        return $permissions;
    }

    public function getUserAllPermissionNames(){
        $permissions = $this->getUserAllPermissions();
        $names = array();
        foreach($permissions as $permission){
            $names[] = $permission->getName();
        }
        return $names;
    }

    public function getTitleByUserId($userId){
        $c = new Criteria();
        $c->add(TitleSfGuardUserPeer::SF_GUARD_USER_ID, $userId);
        $userTitle = TitleSfGuardUserPeer::doSelectOne( $c );
        return $userTitle && $userTitle->getTitle() ? $userTitle->getTitle()->getName() : '';
    }

    public function getTitleSfGuardUserBySfUser($sfUser){
        $titleSfGuardUsers = $sfUser->getTitleSfGuardUsers();
        if( !empty($titleSfGuardUsers) ){
            return $titleSfGuardUsers[0];
        }
        return null;
    }
}
