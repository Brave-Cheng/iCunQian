<?php

/**
 * group actions.
 *
 * @package    oa
 * @subpackage group
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class groupActions extends BaseBackends
{
    public function preExecute(){
        if($this->getUser()->getUsername() != 'admin'){
            return $this->forward404();
        }
    }
  /**
   * Executes index action
   *
   */
    public function executeIndex()
    {
        $this->groups = sfGuardGroupPeer::getGroups();
    }

    public function executeAdd(){
        $this->group = null;
        return $this->setTemplate( 'edit' );
    }

    public function executeEdit(){
        $this->group = sfGuardGroupPeer::retrieveByPK( $this->getRequestParameter( 'id' ) );
        $this->forward404Unless( $this->group );
    }

    public function executeUpdate(){
        if(is_null($this->getRequestParameter( 'id' ))){
          $group = new sfGuardGroup();
        }else{
          $group = sfGuardGroupPeer::retrieveByPK( $this->getRequestParameter( 'id' ) );
        }
        $group->setName( $this->getRequestParameter( 'name' ) );
        $group->setDescription( $this->getRequestParameter( 'description' ) );
        $group->save();
        return $this->redirect('group/index?msg=2');
    }

    public function handleErrorUpdate(){
      return $this->forward('group','edit');
    }

    public function executeDelete(){
        $groups = sfGuardGroupPeer::retrieveByPKs( $this->getRequestParameter('deleteId') );
        if(!empty($groups)){
            foreach( $groups as $group ){
                if($group){
                    $group->delete();
                }
            }
            return $this->redirect('group/index?msg=1');
        }
        return $this->redirect('group/index?msg=0');
    }

    public function executeSetPermission(){
        $this->permissions = sfGuardPermissionPeer::getPermissions();
        $this->group = sfGuardGroupPeer::retrieveByPK( $this->getRequestParameter('id') );
        $this->specialPermissions = sfGuardPermissionPeer::getAllSpecialPermissions();
        $this->groupSpecialPermissionIds = sfGuardPermissionPeer::getSpecialPermissionIdsByGroupId($this->getRequestParameter('id'));
    }

    public function executeUpdateGroupPermission(){
        foreach( sfGuardPermissionPeer::getPermissions() as $permission ){
            $groupPermission = sfGuardGroupPermissionPeer::getGroupPermissionByPermissionIdGroupId( $permission->getId(), $this->getRequestParameter('groupId') );
            if(!is_null($groupPermission)){
                $groupPermission->delete();
            }
            $hasPermission = 'hasPermission_' . $permission->getId();
            if($this->getRequestParameter( $hasPermission ) == '1'){
                $groupPermission = new sfGuardGroupPermission();
                $groupPermission->setGroupId( $this->getRequestParameter('groupId') );
                $groupPermission->setPermissionId( $permission->getId() );
                $param = 'create_' . $permission->getId();
                if( !is_null($this->getRequestParameter($param)) ){
                    $groupPermission->setAccessCreate(1);
                }
                $param = 'update_' . $permission->getId();
                if( !is_null($this->getRequestParameter($param)) ){
                    $groupPermission->setAccessUpdate(1);
                }
                $param = 'read_' . $permission->getId();
                if( !is_null($this->getRequestParameter($param)) ){
                    $groupPermission->setAccessRead(1);
                }
                $param = 'delete_' . $permission->getId();
                if( !is_null($this->getRequestParameter($param)) ){
                    $groupPermission->setAccessDelete(1);
                }
                $groupPermission->save();
            }
        }
        $specialPermissions = sfGuardPermissionPeer::getAllSpecialPermissions();
        $ids = array();
        if(!empty($specialPermissions)){
            foreach($specialPermissions as $specialPermission){
                $c = new Criteria();
                $c->addJoin(sfGuardGroupPermissionPeer::PERMISSION_ID,sfGuardPermissionPeer::ID,Criteria::LEFT_JOIN);
                $c->add(sfGuardGroupPermissionPeer::PERMISSION_ID, $specialPermission->getId());
                $c->add(sfGuardGroupPermissionPeer::GROUP_ID,$this->getRequestParameter('groupId'));
                $groupPermissions = sfGuardGroupPermissionPeer::doSelect($c);
                if(!empty($groupPermissions)){
                    foreach($groupPermissions as $groupPermission){
                        $groupPermission->delete();
                    }
                }
                if($this->getRequestParameter('specialPermission_' . $specialPermission->getId()) == 'checked'){
                    $groupPermission = new sfGuardGroupPermission();
                    $groupPermission->setGroupId($this->getRequestParameter('groupId'));
                    $groupPermission->setPermissionId($specialPermission->getId());
                    $groupPermission->save();
                }
            }
        }
        return $this->redirect('group/setPermission?msg=1&id=' . $this->getRequestParameter('groupId') );
    }
}
