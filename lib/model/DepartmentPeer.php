<?php

/**
 * Subclass for performing query and update operations on the 'department' table.
 *
 * 
 *
 * @package lib.model
 */ 
class DepartmentPeer extends BaseDepartmentPeer
{
    /**
     * getAllDepartments - Get all the departments
     * @return object - Department objects
     * @author hang.lu <hang.lu@expacta.com.cn>
     * @issue - 2322 - User Management
     */
    
    public static function getAllDepartments(){
        $c = new Criteria();
        $c->addAscendingOrderByColumn( DepartmentPeer::ID );
        $departments = DepartmentPeer::doSelect( $c );
        return $departments;
    }

}
