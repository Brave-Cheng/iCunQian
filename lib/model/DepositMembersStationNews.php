<?php

/**
 * Subclass for representing a row from the 'deposit_members_station_news' table.
 *
 * 
 *
 * @package lib\model
 */ 
class DepositMembersStationNews extends BaseDepositMembersStationNews
{
    /**
     * Re-write get status
     *
     * @return string
     *
     * @issue 2706
     */
    public function getFormatStatus() {
        $status = DepositStationNewsPeer::getStationNewsStatus();
        return $status[parent::getStatus()];
    }
}
