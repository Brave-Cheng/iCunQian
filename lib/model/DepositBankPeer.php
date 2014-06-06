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

    const MAIL_CONTENT = '系统刚新增银行【%s】,请登录后台系统再次编辑银行简称，LOGO，电话等信息! ';
    const MAIL_SUBJECT = '新增银行信息修改';

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
                $body = sprintf(self::MAIL_CONTENT, $bankname);
                $mail = Mailer::initialize();
                $mail->Subject = self::MAIL_SUBJECT;
                if (is_array(sfConfig::get('sender'))) {
                    foreach (sfConfig::get('sender') as $sender) {
                        $mail->AddAddress($sender);
                    }
                } else {
                    $mail->AddAddress(sfConfig::get('sender'));
                }
                $mail->MsgHTML($body);
                $mail->send();
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
     * @param string  $since datetime
     * @param int     $limit limit number
     * @param boolean $total total condtion
     *
     * @issue 2568
     * @return object Criteria
     */
    public static function filter($since, $limit = 100, $total = false) {
        $criteria = new Criteria();
        $criteria->add(DepositBankPeer::IS_VALID, 1);
        if ($total) {
            return $criteria;
        }
        if ($since) {
            $criteria->add(DepositBankPeer::UPDATED_AT, $since, Criteria::GREATER_THAN);
        }
        $criteria->addAscendingOrderByColumn(DepositBankPeer::UPDATED_AT);
        $criteria->setLimit($limit);
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
}
