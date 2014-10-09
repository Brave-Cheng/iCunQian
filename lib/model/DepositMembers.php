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

    /**
     * Rewrite getEmail
     *
     * @return string
     *
     * @issue 2705
     */
    public function getEmail() {
        return parent::getEmail() ? parent::getEmail() : DepositMembersPeer::NULL_STRING;
    }

    /**
     * Rewrite getMobile
     *
     * @return string
     *
     * @issue 2705
     */
    public function getMobile() {
        return parent::getMobile() ? parent::getMobile() : DepositMembersPeer::NULL_STRING;
    }

    /**
     * Rewrite getAvatar
     *
     * @return string
     *
     * @issue 2705
     */
    public function getAvatar() {
        return parent::getAvatar() ? DepositMembersPeer::customAvatarDirectory(true) . parent::getAvatar() : DepositMembersPeer::NULL_STRING;
    }

    /**
     * Rewrite getThirdPartyPlatformType
     *
     * @return string
     *
     * @issue 2705
     */
    public function getThirdPartyPlatformType() {

        $tansaltes = DepositMembersPeer::getTranslateThirdPartyPlatforms();

        if (in_array(parent::getThirdPartyPlatformType(), array_keys($tansaltes))) {
            return $tansaltes[parent::getThirdPartyPlatformType()];
        } else {
            return DepositMembersPeer::NULL_STRING;
        }
    }

    /**
     * Rewrite getThirdPartyPlatformAccount
     *
     * @return string
     *
     * @issue 2705
     */
    public function getThirdPartyPlatformAccount() {
        return parent::getThirdPartyPlatformAccount() ? parent::getThirdPartyPlatformAccount() : DepositMembersPeer::NULL_STRING;
    }


}
