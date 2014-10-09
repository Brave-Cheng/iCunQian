<?php

/**
 * @package lib\model
 */

/**
 * Subclass for performing query and update operations on the 'deposit_bank' table.
 *
 */

class DepositBankPeer extends BaseDepositBankPeer
{

    /**
     * get bank by bankname
     *
     * @param string $bankname bankname
     *
     * @issue 2568
     * @return object bank
     */
    static public function getBankByBankname($bankname) {
        if (empty($bankname)) {
            return false;
        }
        $criteria = new Criteria();
        $criteria->add(DepositBankPeer::NAME, $bankname);
        $bank = DepositBankPeer::doSelectOne($criteria);
        if ($bank) {
            return $bank;
        }  else {
            return self::saveBank($bankname);
        }
    }

    /**
     * save bank by name
     *
     * @param string $bankname bankname
     *
     * @issue 2568
     * @return object
     */
    static public function saveBank($bankname) {
        $con = Propel::getConnection(DepositBankPeer::DATABASE_NAME);
        try {
            $bank = new DepositBank();
            $bank->setName($bankname);
            $bank->save();
            //send mail
            if (sfConfig::get('sender')) {
                DepositBankAliasPeer::sendNewBankMail(sfConfig::get('sender'), $bankname);
            }
            
            return $bank;
        } catch (PropelException $e) {
            $con->rollback();
        }
    }

    /**
     * get bank gird th head
     *
     * @issue 2568
     * @return array
     */
    static public function getBankGirdHead() {
        return array(
            self::NAME => util::getMultiMessage('Bank Name'),
            self::SHORT_NAME => util::getMultiMessage('Bank Short Name'),
            self::PHONE => util::getMultiMessage('Bank Phone'),
            self::LOGO => util::getMultiMessage('Bank Logo'),
            self::IS_VALID => util::getMultiMessage('Is Valid'),
        );
    }

    /**
     * filter conditopn
     *
     * @param string  $since   datetime
     * @param int     $limit   limit number
     * @param boolean $total   total condtion
     * @param boolean $isValid is valid 
     *
     * @issue 2568
     * @return object Criteria
     */
    public static function filter($since, $limit = 100, $total = false, $isValid = true) {
        $criteria = new Criteria();
        if ($isValid) {
            $criteria->add(DepositBankPeer::IS_VALID, 1);    
        }
        if ($total) {
            return $criteria;
        }
        if ($since) {
            $criteria->add(DepositBankPeer::UPDATED_AT, $since, Criteria::GREATER_THAN);
        }
        $criteria->addAscendingOrderByColumn(DepositBankPeer::UPDATED_AT);
        if ($limit) {
            $criteria->setLimit($limit);    
        }
        return $criteria;
    }


    /**
     * fetch bank data
     *
     * @param int $since timestamp
     * @param int $limit limit number
     *
     * @issue 2568
     * @return array
     */
    public static function fetchBank($since, $limit = 100) {
        $array = array();
        $total = true;
        if ($since) {
            $since = date("Y-m-d H:i:s", $since);
        } else {
            $since = null;
        }
        $criteria = self::filter($since, $limit);
        $lists = DepositBankPeer::doSelect($criteria);
        foreach ($lists as $bank) {
            $array[] = array(
                'id'            => $bank->getId(),
                'name'          => $bank->getName(),
                'short_name'    => $bank->getShortName(),
                'short_char'    => $bank->getShortChar(),
                'phone'         => $bank->getPhone(),
                'sync_status'   => $bank->getSyncStatus(),
                'create_at'     => $bank->getCreatedAt(),
                'update_at'     => $bank->getUpdatedAt(),
            );
        }
        return array('list' => $array, 'total' => DepositBankPeer::doCount(self::filter($since, $limit, $total)));
    }

    /**
     * Update bank logo name
     *
     * @issue 2589
     * @return null
     */
    public static function rebuiltBankLogo() {
        $banks = DepositBankPeer::doSelect(new Criteria());
        foreach ($banks as $bank) {
            $baseName = pathinfo($bank->getLogo(), PATHINFO_BASENAME);
            $delimiter = explode('.', $baseName);
            $logo = str_replace($delimiter[0], $delimiter[0] . '_' . $bank->getId(), $bank->getLogo());
            $bank->setShortChar($delimiter[0] . '_' . $bank->getId());
            $bank->setLogo($logo);
            $bank->save();
        }
    }

    /**
     * Rename the bank logo name
     *
     * @issue 2589
     * @return null
     */
    public static function renameBankLogo() {
        $banks = DepositBankPeer::doSelect(new Criteria());
        foreach ($banks as $bank) {
            $web = SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR ;
            $filename = $web . $bank->getLogo();
            if (file_exists($filename)) {
                $baseName = pathinfo($bank->getLogo(), PATHINFO_BASENAME);
                $delimiter = explode('.', $baseName);
                $logo = str_replace($delimiter[0], $delimiter[0] . '_' . $bank->getId(), $bank->getLogo());
                rename($filename, $logo);
            }
        }
    }

    /**
     * Update bank logo short char
     *
     * @issue 2589
     * @return null
     */
    public static function rebultBankShortChar() {
        $banks = DepositBankPeer::doSelect(new Criteria());
        foreach ($banks as $key => $bank) {
            //pathinfo is a buger
            // $baseName = pathinfo($bank->getLogo());
            if (strpos($bank->getLogo(), "/")) {
                $deli = "/";
            }
            if (strpos($bank->getLogo(), "\\")) {
                $deli = "\\";
            }
            $arr = explode($deli, $bank->getLogo());   
            $baseName = array_pop($arr);
            $delimiter = explode('.', $baseName);
            $bank->setShortChar($delimiter[0]);
            $bank->save();
        }
    }

    /**
     * Get banks
     *
     * @return objects
     *
     * @issue 2614
     */
    public static function getBankList() {
        $criteria = self::filter(false, false, false, false);
        $rows[''] = util::getMultiMessage('--Select--');
        $objects = DepositBankPeer::doSelect($criteria);
        foreach ($objects as $object) {
            $rows[$object->getId()] = $object->getName();
        }
        return $rows;
    }

    /**
     * Has product of bank
     *
     * @param int $bankId bank id
     *
     * @return boolean true is exist product
     *
     * @issue 2553
     */
    public static function hasBankProducts($bankId) {
        $criteria = new Criteria();
        $criteria->add(DepositFinancialProductsPeer::BANK_ID, $bankId);
        $criteria->add(DepositFinancialProductsPeer::SYNC_STATUS, DepositFinancialProductsPeer::SYNC_DELETE, Criteria::NOT_EQUAL);
        return DepositFinancialProductsPeer::doSelectOne($criteria);
    }

}
