<?php

/**
 * Subclass for representing a row from the 'sf_guard_user_profile' table.
 *
 * 
 *
 * @package lib.model
 */ 
class sfGuardUserProfile extends BasesfGuardUserProfile{
    const CREATE_ACTION = 'add';
    const UPDATE_ACTION = 'update';
    const READ_ACTION = 'read';
    const DELETE_ACTION = 'delete';

/**
 *  moduleAccess - Determine what permissions the user has the module
 *  getModuleActionFunctionName method is used to get a different module under what action CURD operation requires permissions 
 *  (if userAccessAction joined this class method)
 *  Example: getProjectCreate () will get in the project module, perform the create operation needed action.
 *       
 * @param  string $module - module name
 * @param  string $action - action name
 * @return bool - Have permission to return true, false otherwise
 */
    public function moduleAccess($module, $action){ 
        $user = $this->getsfGuardUser();
        if($user->getIsSuperAdmin()) return true;
        $groupPermissions = sfGuardUserProfile::getUserGroupPermissions($module);
        if(empty($groupPermissions)) return false;
        if($action == 'index') return true;
        if(in_array($action, array('tender', 'completeProject'))){
            foreach($groupPermissions as $groupPermission){
                if($groupPermission->getSfGuardPermission()->getActionName() == $action){
                    return true;
                }
            }
            return false;
        }
        $actionTypes = array();
        foreach ($groupPermissions as $key => $groupPermission) {
            if($groupPermission->getAccessCreate()){
                $actionTypes[] = self::CREATE_ACTION;
            }

            if($groupPermission->getAccessUpdate()){
                $actionTypes[] = self::UPDATE_ACTION;
            }

            if($groupPermission->getAccessRead()){
                $actionTypes[] = self::READ_ACTION;
            }

            if($groupPermission->getAccessDelete()){
                $actionTypes[] = self::DELETE_ACTION;
            }
        }

        $actions = array();
        $actionTypes = array_unique($actionTypes);
        foreach($actionTypes as $key => $actionType){
            $getModuleActionFunctionName = "get" . ucfirst($module) . ucfirst($actionType);
            if(method_exists('userAccessAction', $getModuleActionFunctionName)){
                $actions = array_merge($actions, userAccessAction::$getModuleActionFunctionName());
            }else{
                $actions[] = $actionType;
            }
        }
        if(in_array( $action, $actions )) return true;
        return false;
    }

    public static function getUserGroupPermissions($module){
        $user = sfContext::getInstance()->getUser()->getGuardUser();
        $criteria = new Criteria();
        $criteria->addJoin(sfGuardGroupPermissionPeer::GROUP_ID, sfGuardUserGroupPeer::GROUP_ID, Criteria::LEFT_JOIN);
        $criteria->addJoin(sfGuardGroupPermissionPeer::PERMISSION_ID, sfGuardPermissionPeer::ID, Criteria::LEFT_JOIN);
        $criteria->add(sfGuardUserGroupPeer::USER_ID, $user->getId());
        $criteria->add(sfGuardPermissionPeer::MODULE_NAME, $module);
        return sfGuardGroupPermissionPeer::doSelect($criteria);
    }

    public static function isProjectManager($projectId){
        $user = sfContext::getInstance()->getUser()->getGuardUser();
        if($user->getIsSuperAdmin()) return true;
        $c = new Criteria();
        $c->add(ProjectMemberPeer::SF_GUARD_USER_ID, $user->getId());
        $c->add(ProjectMemberPeer::PROJECT_ID, $projectId);
        $projectMember = ProjectMemberPeer::doSelectOne($c);
        if ($projectMember && $projectMember->getMemberRole()) {
            if ($projectMember->getMemberRole()->getName() == ProjectRolePeer::PROJECT_PM) {
                return true;
            }
        }
        return false;
    }

    public static function hasPermission($permissionName){
        $user = sfContext::getInstance()->getUser()->getGuardUser();
        if($user->getIsSuperAdmin()) return true;
        return in_array($permissionName, $user->getAllPermissionNames());
    }

    public static function isVicePresident($projectId){
        $user = sfContext::getInstance()->getUser()->getGuardUser();
        if($user->getIsSuperAdmin()) return true;
        $c = new Criteria();
        $c->add(ProjectMemberPeer::SF_GUARD_USER_ID, $user->getId());
        $c->add(ProjectMemberPeer::PROJECT_ID, $projectId);
        $projectMember = ProjectMemberPeer::doSelectOne($c);
        if ($projectMember && $projectMember->getMemberRole()) {
            if ($projectMember->getMemberRole()->getName() == ProjectRolePeer::PROJECT_VP) {
                return true;
            }
        }
        return false;
    }
}