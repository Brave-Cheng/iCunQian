<?php

/**
 * Subclass for performing query and update operations on the 'department_sf_guard_user' table.
 *
 * 
 *
 * @package lib.model
 */ 
class DepartmentSfGuardUserPeer extends BaseDepartmentSfGuardUserPeer
{
    /**
     * getDepartmentSfUserBySfGuardUserId - By user_id get user's department
     * @param  number $sfGuardUserId
     * @return object DepartmentSfGuardUserObject or null
     * @author hang.lu <hang.lu@expacta.com.cn>
     */
    public static function getDepartmentSfUserBySfGuardUserId( $sfGuardUserId ){
        $c = new Criteria();
        $c->add(DepartmentSfGuardUserPeer::SF_GUARD_USER_ID, $sfGuardUserId);
        $departmentSfUser = DepartmentSfGuardUserPeer::doSelectOne( $c );
        if($departmentSfUser){
            return $departmentSfUser;
        }else{
            return null;
        }
    }
}
