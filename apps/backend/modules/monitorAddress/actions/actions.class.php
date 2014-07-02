<?php

/**
 * monitorAddress actions.
 *
 * @package    oa
 * @subpackage monitorAddress
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class monitorAddressActions extends sfActions
{

    public function preExecute(){
        parent::preExecute();
        $userProfile = $this->getUser()->getGuardUser()->getProfile();
        $this->accessCreate = $userProfile->moduleAccess($this->getModuleName(), 'add');
        $this->accessUpdate = $userProfile->moduleAccess($this->getModuleName(), 'update');
        $this->accessRead = $userProfile->moduleAccess($this->getModuleName(), 'read');
        $this->accessDelete = $userProfile->moduleAccess($this->getModuleName(), 'delete');
    }
  /**
   * Executes index action
   *
   */
    public function executeIndex()
    {
        $sql = 'SELECT * FROM %%monitoring_address%% AS monitoring_address ORDER BY monitoring_address.id';
        $p = array();
        $tapMap = array(
            '%%monitoring_address%%' => MonitoringAddressPeer::TABLE_NAME,
        );
        $sql = strtr( $sql, $tapMap );
        $this->pager = DBUtil::pagerSql( $sql, $p , 'MonitoringAddressPeer');
    }


    public function executeEdit(){
        if( $id = $this->getRequestParameter( 'id' ) ){
            $this->monitoringAddress = MonitoringAddressPeer::getMonitoringAddressById( $id );
            $this->forward404Unless( $this->monitoringAddress );
            $this->monitor = MonitoringAddressPeer::getMonitoriByMonitorAddress( $this->monitoringAddress );
        }else{
            $this->monitoringAddress = null;
        }
    }

    public function executeAdd(){
        $this->monitoringAddress = null;
        $this->setTemplate( 'edit' );
    }

    public function executeUpdate(){
        if( $id = $this->getRequestParameter( 'id' ) ){
            $monitoringAddress = MonitoringAddressPeer::getMonitoringAddressById( $id );
        }else{
            $monitoringAddress = new MonitoringAddress();
        }
        $monitoringAddress->setOfficeOfTheCompanyName( $this->getRequestParameter( 'office_of_the_company_name' ) );
        $monitoringAddress->setAddress( $this->getRequestParameter( 'address' ) );
        $monitoringAddress->save();
        $this->setFlash("msg",1);
        $this->redirect( 'monitorAddress/index' );
    }

    public function handleErrorUpdate(){
        return $this->forward("monitorAddress", "edit");
    }
    
    public function executeDelete(){
        $id = $this->getRequestParameter( 'deleteId' );
        $monitoringAddresses = MonitoringAddressPeer::retrieveByPKs( $id );
        if( !empty( $monitoringAddresses ) ){
            foreach( $monitoringAddresses as $monitoringAddress ){
                if( $monitoringAddress ){
                    $monitoringAddress->delete();
                }
            }
            $this->setFlash("msg",2);
            return $this->redirect( 'monitorAddress/index' );
        }
        $this->setFlash("msg",0);
        return $this->redirect( 'monitorAddress/index' );
    }

    public function executeLeaveCheck(){
        $isModified = false;
        if( $id = $this->getRequestParameter( 'id' ) ){
            $monitoringAddress = MonitoringAddressPeer::getMonitoringAddressById( $id );
            $monitoringAddress->setOfficeOfTheCompanyName( $this->getRequestParameter( 'office_of_the_company_name' ) );
            $monitoringAddress->setAddress( $this->getRequestParameter( 'address' ) );
            if($monitoringAddress->isModified()){
                $isModified = true;
            }
        }else{
            if($this->getRequestParameter( 'office_of_the_company_name' ) != "" || $this->getRequestParameter( 'address' ) != ""){
                $isModified = true;
            }
        }
        echo $isModified ? '1' : '0';
        exit;
    }
}
