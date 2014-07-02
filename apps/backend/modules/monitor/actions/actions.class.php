<?php

/**
 * monitor actions.
 *
 * @package    oa
 * @subpackage monitor
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class monitorActions extends BaseBackends
{
    public function preExecute(){
        parent::preExecute();
        $userProfile = $this->getUser()->getGuardUser()->getProfile();
        $this->accessCreate = $userProfile->moduleAccess($this->getModuleName(), 'add');
        $this->accessUpdate = $userProfile->moduleAccess($this->getModuleName(), 'update');
        $this->accessRead = $userProfile->moduleAccess($this->getModuleName(), 'read');
        $this->accessDelete = $userProfile->moduleAccess($this->getModuleName(), 'delete');
    }

    public function executeIndex(){

        $this->monitoringAddress = MonitoringAddressPeer::retrieveByPK( $this->getRequestParameter('id') );
        $this->forward404Unless($this->monitoringAddress);
        $sql = "SELECT * FROM %%monitor%% AS monitor 
                LEFT JOIN %%monitoring_address%% AS monitoring_address ON (monitor.monitoring_address_id = monitoring_address.id) 
                WHERE monitoring_address.id = ? 
                ORDER BY monitor.id ";
        $p = array($this->getRequestParameter('id'));
        $tapMap = array(
            '%%monitor%%'            => MonitorPeer::TABLE_NAME,
            '%%monitoring_address%%' => MonitoringAddressPeer::TABLE_NAME,
        );
        $sql = strtr( $sql, $tapMap );
        $this->pager = DBUtil::pagerSql( $sql, $p , 'MonitorPeer');
    }

    public function executeAdd(){
        $this->monitoringAddress =  MonitoringAddressPeer::retrieveByPK( $this->getRequestParameter('id') );
        $this->forward404Unless($this->monitoringAddress);
        $this->monitor = null;
        $this->setTemplate('edit');
    }

    public function executeUpdate(){
        $monitoringAddress = MonitoringAddressPeer::retrieveByPK( $this->getRequestParameter('monitoringAddressId') );
        $this->forward404Unless($monitoringAddress);
        $monitor = MonitorPeer::retrieveByPK( $this->getRequestParameter('id') );
        if(!$monitor){
            $monitor = new Monitor();
        }
        $monitor->setMonitoringAddressId( $this->getRequestParameter('monitoringAddressId') );
        $monitor->setDescription( $this->getRequestParameter('description') );
        $monitor->setIp($this->getRequestParameter('ip'));
        $monitor->save();
        $this->setFlash("msg",1);
        return $this->redirect('monitor/index?id=' . $this->getRequestParameter('monitoringAddressId'));
    }

    public function executeDelete(){
        $ids = $this->getRequestParameter('deleteId');
        $monitors = MonitorPeer::retrieveByPKs( $ids );
        if( !empty( $monitors ) ){
            foreach( $monitors as $monitor ){
                if( $monitor ){
                    $monitor->delete();
                }
            }
            $this->setFlash("msg",2);
            return $this->redirect( 'monitor/index?id=' . $this->getRequestParameter('monitoringAddressId') );
        }
        $this->setFlash("msg",0);
        return $this->redirect( 'monitor/index?id=' . $this->getRequestParameter('monitoringAddressId') );
    }

    public function executeEdit(){
        $this->monitor = MonitorPeer::retrieveByPK( $this->getRequestParameter('id') );
        $this->monitoringAddress = MonitoringAddressPeer::retrieveByPK( $this->getRequestParameter('monitoringAddressId') );
        $this->forward404Unless( $this->monitoringAddress );
    }

    public function handleErrorUpdate(){

        return $this->forward("monitor", "edit");
    }

    public function executeLeaveCheck(){
        $isModified = false;
        $monitoringAddress = MonitoringAddressPeer::retrieveByPK( $this->getRequestParameter('monitoringAddressId') );
        $this->forward404Unless($monitoringAddress);
        $monitor = MonitorPeer::retrieveByPK( $this->getRequestParameter('id') );
        if($monitor){
            $monitor->setMonitoringAddressId( $this->getRequestParameter('monitoringAddressId') );
            $monitor->setDescription( $this->getRequestParameter('description') );
            $monitor->setIp($this->getRequestParameter('ip'));
            if($monitor->isModified()){
                $isModified = true;
            }
        }else{
            if($this->getRequestParameter('monitoringAddressId') != "" && $this->getRequestParameter('description') != ""){
                $isModified = true;
            }
        }
        echo $isModified ? '1' : '0';
        exit;
    }
}
