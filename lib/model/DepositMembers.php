<?php

/**
 * Subclass for representing a row from the 'deposit_members' table.
 *
 * 
 *
 * @package lib\model
 */ 
class DepositMembers extends BaseDepositMembers
{

    /**
     * Re-write getNickname
     *
     * @return string
     *
     * @issue 2678
     */
    public function getNickname() {
        return parent::getNickname() ? parent::getNickname() : DepositMembersPeer::NULL_STRING;
    }
}
