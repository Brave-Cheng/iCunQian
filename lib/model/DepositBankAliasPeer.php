<?php

/**
 * Subclass for performing query and update operations on the 'deposit_bank_alias' table.
 *
 * 
 *
 * @package lib\model
 */ 
class DepositBankAliasPeer extends BaseDepositBankAliasPeer
{

    /**
     * Get bank id from alias name
     *
     * @param string $aliasName alias name
     *
     * @return mixed
     *
     * @issue  2614
     */
    public static function getBankIdByAliasName($aliasName) {
        if (empty($aliasName)) {
            return;
        }
        $criteria = new Criteria();
        $criteria->add(DepositBankAliasPeer::NAME, $aliasName, Criteria::LIKE);
        $bankAlias = DepositBankAliasPeer::doSelectOne($criteria);
        if ($bankAlias) {
            return $bankAlias->getDepositBankId();
        } else {
            $bank = DepositBankPeer::saveBank($aliasName);
            self::saveBankName($aliasName, $bank->getId());   
            self::saveAliasPartName($aliasName, $bank->getId());
            return $bank->getId();
        }
    }

    /**
     * Save bank name
     *
     * @param string $aliasName alias name
     * @param string $bankId    bank id
     *
     * @return mixed
     *
     * @issue 2614
     */
    public static function saveBankName($aliasName, $bankId) {
        try {
            $bankAlias = new DepositBankAlias();
            $bankAlias->setName($aliasName);
            $bankAlias->setDepositBankId($bankId);
            $bankAlias->save();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Save alias part name
     *
     * @param string $aliasName alias name
     * @param string $bankId    bank id
     * 
     * @return string
     * 
     * @issue 2614
     */
    public static function saveAliasPartName($aliasName, $bankId) {
        try {
            $aliasName = substr($aliasName, 0, -3);
            $bankAlias = new DepositBankAlias();
            $bankAlias->setName($aliasName);
            $bankAlias->setDepositBankId($bankId);
            $bankAlias->save();
        } catch (Exception $e) {
            throw $e;
        }
    }   
}
