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
 * @version    SVN: $Id: sfGuardPermissionPeer.php 7633 2008-02-27 17:54:50Z fabien $
 */
class sfGuardPermissionPeer extends PluginsfGuardPermissionPeer
{
    /**
     * getPermissions - Get all permissions
     * @return array - Permissions array of objects
     * @author hang.lu <hang.lu@expacta.com.cn>
     * #issue 2347 - Permission management
     */
    public static function getPermissions($isSpecial=true){
        $c = new Criteria();
        $c->addAscendingOrderByColumn(sfGuardPermissionPeer::SORT_ORDER);
        if($isSpecial){
            $c->add(sfGuardPermissionPeer::ACTION_NAME, null);
        }
        $permissions = sfGuardPermissionPeer::doSelect( $c );
        return $permissions;
    }
    public static function getPermission(){
        $c = new Criteria();
        $c->addAscendingOrderByColumn(sfGuardPermissionPeer::SORT_ORDER);
        $permissions = sfGuardPermissionPeer::doSelect( $c );
        $permissionName = array();
        foreach ($permissions as $permission){
            $permissionName[] = $permission->getModuleName();
        }
        $permissionName[] = sfConfig::get('sf_default_module');
        return $permissionName;
    }

    public static function getAllSpecialPermissions(){
        $c = new Criteria();
        $c->add(sfGuardPermissionPeer::ACTION_NAME, null, Criteria::NOT_EQUAL);
        return sfGuardPermissionPeer::doSelect($c);
    }

    public static function getSpecialPermissionIdsByGroupId($groupId){
        $c = new Criteria();
        $c->addJoin(sfGuardPermissionPeer::ID,sfGuardGroupPermissionPeer::PERMISSION_ID, Criteria::LEFT_JOIN);
        $c->add(sfGuardPermissionPeer::ACTION_NAME, null, Criteria::NOT_EQUAL);
        $c->add(sfGuardGroupPermissionPeer::GROUP_ID, $groupId);
        $ids =array();
        $groupSpecialPermissions = sfGuardPermissionPeer::doSelect($c);
        foreach($groupSpecialPermissions as $groupSpecialPermission){
            $ids[] = $groupSpecialPermission->getId();
        }
        return $ids;
    }
    
    /**
     * 
     * @param string $specialPermission
     * @return boolean
     * @issue 2347
     * @author brave
     */
    public static function checkUserSpecialPermission($specialPermission) {
        $permissionList = array();
        $allPermission = sfContext::getInstance()->getUser()->getGuardUser()->getAllPermissions();
        foreach ($allPermission as $permission) {
            if ($permission->getActionName()) {
                $permissionList[] = $permission->getActionName();
            }
        }
        return in_array($specialPermission, $permissionList);
    }

    public static function getSpecialPermissionNames(){
        $specialPermissions = sfGuardPermissionPeer::getAllSpecialPermissions();
        $specialPermissionNames = array();
        if(!empty($specialPermissions)){
            foreach($specialPermissions as $specialPermission){
                $specialPermissionNames[] = $specialPermission->getName();
            }
        }
        return $specialPermissionNames;
    }
}
