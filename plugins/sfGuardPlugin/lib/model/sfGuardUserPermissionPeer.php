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
 * @version    SVN: $Id: sfGuardUserPermissionPeer.php 7633 2008-02-27 17:54:50Z fabien $
 */
class sfGuardUserPermissionPeer extends PluginsfGuardUserPermissionPeer
{
    public static function getSfGuardUserPermissionByPermissionIdUserId($permissonId,$userId){
        $c = new Criteria();
        $c->addJoin(sfGuardUserPermissionPeer::PERMISSION_ID, sfGuardPermissionPeer::ID, Criteria::LEFT_JOIN);
        $c->add(sfGuardUserPermissionPeer::USER_ID, $userId);
        $c->add(sfGuardUserPermissionPeer::PERMISSION_ID, $permissonId);
        $userPermission = sfGuardUserPermissionPeer::doSelectOne( $c );
        return $userPermission;
    }
}
