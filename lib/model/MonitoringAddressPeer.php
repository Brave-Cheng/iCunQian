<?php

/**
 * Subclass for performing query and update operations on the 'monitoring_address' table.
 *
 * 
 *
 * @package lib.model
 */ 
class MonitoringAddressPeer extends BaseMonitoringAddressPeer
{
    public static function getMonitoringAddressById( $id ){
        $monitoringAddress = MonitoringAddressPeer::retrieveByPK( $id );
        return $monitoringAddress;
    }

    public static function getMonitoriByMonitorAddress( $monitoringAddress ){
        $monitors = $monitoringAddress->getMonitors();
        if( !empty( $monitors ) ){
            return $monitors[0];
        }else{
            return null;
        }
    }
}
