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
 * @version    SVN: $Id: sfGuardGroupPermissionPeer.php 7633 2008-02-27 17:54:50Z fabien $
 */
class sfGuardGroupPermissionPeer extends PluginsfGuardGroupPermissionPeer
{
    public static function getGroupPermissionByPermissionIdGroupId( $permissionId,$groupId ){
        $c = new Criteria();
        $c->add( sfGuardGroupPermissionPeer::PERMISSION_ID, $permissionId );
        $c->add( sfGuardGroupPermissionPeer::GROUP_ID, $groupId );
        $groupPermission = sfGuardGroupPermissionPeer::doSelectOne( $c );
        if($groupPermission == null){
            $groupPermission = new sfGuardGroupPermission();
        }
        //var_dump( $groupPermission );exit;
        return $groupPermission;
    }
}
