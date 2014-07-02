<?php

/**
 * permission actions.
 *
 * @package    oa
 * @subpackage permission
 * @author     hang.lu <hang.lu@expacta.com.cn>
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class permissionActions extends BaseBackends
{
  /**
   * Executes index action
   *
   */
    const KEY = '95be4e2e83c2b622350b8f195e76c639';//EXPACTAoa1314

    public function preExecute(){
        if($this->getUser()->getUsername() != 'admin'){
            return $this->forward404();
        }
    }
    
    public function executeIndex()
    {
        if( !isset( $_SESSION['key'] ) || md5( $_SESSION['key'] ) != self::KEY ){
            if( md5( $this->getRequestParameter( 'key' ) ) != self::KEY ){
                unset( $_SESSION['key'] );
                return $this->redirect('dashboard/index');
            }
            $_SESSION['key'] = $this->getRequestParameter( 'key' );
        }
        $this->permissions = sfGuardPermissionPeer::getPermissions(false);
    }
/**
 * validateKey - Verify that you have access to key
 * @author hang.lu <hang.lu@expacta.com.cn>
 * @issue 2347 - Rights Management
 */
    public function validateKey(){
        if( !isset( $_SESSION['key'] ) || md5( $_SESSION['key'] ) != self::KEY){
            return $this->redirect( 'dashboard/index' );
        }
    }

/**
 * executeEdit - Enter the edit page
 * @author hang.lu <hang.lu@expacta.com.cn>
 * @issue 2347 - Rights Management
 */
    public function executeEdit(){
        $this->validateKey();
        $id = $this->getRequestParameter( 'id' );
        if( $id ){
            $this->sfGuardPermission = sfGuardPermissionPeer::retrieveByPK( $this->getRequestParameter( 'id' ) );
        }else{
            $this->sfGuardPermission = null;
        }
    }

/**
 * executeDelete - Delete data
 * @author hang.lu <hang.lu@expacta.com.cn>
 * @issue 2347 - Rights Management
 */
    public function executeDelete(){
        $this->validateKey();
        $deleteIds = $this->getRequestParameter( 'deleteId' );
        if( !empty($deleteIds) ){
            if(is_array($deleteIds)){
                foreach ($deleteIds as $deleteId) {
                    $permission =  sfGuardPermissionPeer::retrieveByPK( $deleteId );
                    $this->forward404Unless( $permission );
                    $permission->delete();
                }
            }else{
                $permission =  sfGuardPermissionPeer::retrieveByPK( $deleteIds );
                $this->forward404Unless( $deleteIds );
                $permission->delete();
            }
            return $this->redirect( 'permission/index?msg=1' );
        }
        return $this->redirect( 'permission/index?msg=0' );
    }

/**
 * executeUpdate - update data
 * @author hang.lu <hang.lu@expacta.com.cn>
 * @issue 2347 - Rights Management
 */
    public function executeUpdate(){
        $this->validateKey();
        if($this->getRequestParameter( 'id' )){
            $sfGuardPermission = sfGuardPermissionPeer::retrieveByPK( $this->getRequestParameter( 'id' ) );
            $this->forward404Unless($sfGuardPermission);
        }else{
            $sfGuardPermission  = new sfGuardPermission();
        }
        $sfGuardPermission->setName( $this->getRequestParameter( 'name' ) );
        $sfGuardPermission->setDescription( $this->getRequestParameter( 'description' ) );
        $sfGuardPermission->setModuleName( $this->getRequestParameter( 'module_name' ) );
        if( $this->getRequestParameter('action_name') ){
            $sfGuardPermission->setActionName( $this->getRequestParameter('action_name') );
        }else{
            $sfGuardPermission->setActionName(null);
        }
        $sfGuardPermission->setSortOrder( $this->getRequestParameter( 'sortOrder' ) );
        $sfGuardPermission->save();
        return $this->redirect( 'permission/edit?msg=1&id=' . $sfGuardPermission->getId() );
    }

/**
 * executeInsert - Enter the insert page
 * @return [type] [description]
 */
    public function executeInsert(){
        $this->validateKey();
        $this->sfGuardPermission = null;
        $this->setTemplate( 'edit' );
    }

/**
 *  validateUpdate - Updated data validation
 * @author hang.lu <hang.lu@expacta.com.cn>
 * @issue 2347 - Rights Management
 */
    public function validateUpdate(){
        $module_name = $this->getRequestParameter( 'module_name' );
        $modules = array();
        $aplicacion = "backend"; 
        $directorio = opendir("../apps/$aplicacion/modules");
        while($file = readdir($directorio)){
            if($file=="..")continue;
            if($file==".")continue;
            $modules[] = $file;
        }
        if(!in_array($module_name, $modules)){
            $this->getRequest()->setError('module_name', '该模块不存在');
            return false;
        }
        return true;
    }

    public function handleErrorUpdate(){
        return $this->forward("permission", "edit");
    }
}
