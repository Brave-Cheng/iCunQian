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
        $bankAlias = self::getBankByName($aliasName);
        if ($bankAlias) {
            return $bankAlias->getDepositBankId();
        } else {
            $bank = DepositBankPeer::saveBank($aliasName);
            if ($bank) {
                self::saveBankName($aliasName, $bank->getId());   
                self::saveAliasPartName($aliasName, $bank->getId());

                $mailer = Config::getInstance('CrawlConfig')->getMangingBankSenders();

                self::sendNewBankMail($mailer, $aliasName);

                return $bank->getId();    
            }
            return;
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

    /**
     * Get bank by alias name
     *
     * @param string $name alias name
     *
     * @return mixed DepositBankAlias
     *
     * @issue 2579
     */
    public static function getBankByName($name) {
        $criteria = new Criteria();
        $criteria->add(DepositBankAliasPeer::NAME, $name, Criteria::LIKE);
        $bankAlias = DepositBankAliasPeer::doSelectOne($criteria);
        if ($bankAlias) {
            return $bankAlias;
        }
        return null;
    }
    
    /**
     * Send mail when add new bank 
     *
     * @param mixed  $mailer    mail to 
     * @param string $aliasName bank name
     *
     * @return void
     *
     * @issue 2553
     */
    public static function sendNewBankMail($mailer, $aliasName) {
        $mail = Mailer::initialize();
        $mail->Subject = util::getMultiMessage('New Bank.');
        if (is_array($mailer)) {
            foreach ($mailer as $sender) {
                $mail->AddAddress($sender);
            }
        } else {
            $mail->AddAddress($mailer);
        }
        $body = sprintf(
            util::getMultiMessage('New Bank Content %s %s %s.'), 
            date('Y-m-d H:i'), 
            $aliasName,
            '<a href="' . util::getDomain() .'/backend.php/Bank' . '">' . util::getMultiMessage('Back Manager') . '</a>'
        );
        $mail->MsgHTML($body);
        $mail->send();
    }   
}

