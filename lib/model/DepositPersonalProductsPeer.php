<?php

/**
 * Subclass for performing query and update operations on the 'deposit_personal_products' table.
 *
 * 
 *
 * @package lib\model
 */ 
class DepositPersonalProductsPeer extends BaseDepositPersonalProductsPeer
{

    const SYNC_STATUS_0 = 0;
    const SYNC_STATUS_1 = 1;
    const SYNC_STATUS_2 = 2;

    /**
     * Get sync status list
     *
     * @return void
     *
     * @issue 2706
     */
    public static function getSyncStatus() {
        return array(
            self::SYNC_STATUS_0 => util::getMultiMessage('Sync Status 0'),
            self::SYNC_STATUS_1 => util::getMultiMessage('Sync Status 1'),
            self::SYNC_STATUS_2 => util::getMultiMessage('Sync Status 2'),
        );
    }

    /**
     * Re-write retrieveByPk
     *
     * @param int    $id        primary key
     * @param int    $productId product id
     * @param int    $accountId account id
     * @param object $con       criteria
     *
     * @return object
     *
     * @issue 2632
     */
    public static function retrieveByPK($id, $productId, $accountId, $con = null) {
        if ($productId || $accountId) {
            return parent::retrieveByPK($id, $productId, $accountId, $con);
        } else {
            $criteria = new Criteria();
            $criteria->add(DepositPersonalProductsPeer::ID, $id);
            $v = DepositPersonalProductsPeer::doSelect($criteria, $con);
            return !empty($v) ? $v[0] : null;
        }
    }


    /**
     * Check if personal product is valid
     *
     * @param int $pk primary key
     *
     * @return object DepositPersonalProducts
     *
     * @issue 2632
     */
    public static function verifiyPersonalProduct($pk) {
        $personalProduct = DepositPersonalProductsPeer::retrieveByPK($pk);
        if (!$personalProduct) {
            throw new ObjectsException(ObjectsException::$error2000, $pk);
        }
        return $personalProduct;
    }

    /**
     * Add personal product
     *
     * @param int    $productId        product id
     * @param int    $accountId        account id
     * @param float  $expectedRate     expected rate
     * @param float  $amount           amount
     * @param date   $buyDate          buy date
     * @param date   $expiryDate       expiry date
     * @param string $uuid             uuid string
     * @param int    $syncStatus       sync status
     * @param string $deadlineReminder yes is deadline reminder 
     *
     * @return object DepositPersonalProducts
     * 
     * @issue 2632
     */
    public static function addPersonalProduct($productId, $accountId, $expectedRate, $amount, $buyDate, $expiryDate, $uuid, $syncStatus, $deadlineReminder) {
        $personalProduct = new DepositPersonalProducts();
        $personalProduct->setDepositFinancialProductsId($productId);
        $personalProduct->setDepositMembersId($accountId);
        $personalProduct->setExpectedRate($expectedRate);        
        $personalProduct->setAmount($amount);
        $personalProduct->setBuyDate($buyDate);
        $personalProduct->setExpiryDate($expiryDate);
        $personalProduct->setUuid($uuid);
        $personalProduct->setSyncStatus($syncStatus);
        $personalProduct->setDeadlineReminder($deadlineReminder);
        $personalProduct->save();
        return $personalProduct;
    }


    /**
     * Update a personal product
     *
     * @param int   $pk           primary key
     * @param float $expectedRate expected rate
     * @param float $amount       amount
     * @param date  $buyDate      buy date
     * @param date  $expiryDate   expiry date
     *
     * @return object DepositPersonalProducts
     *
     * @issue 2632
     */
    public static function updatePersonalProduct($pk, $expectedRate, $amount, $buyDate, $expiryDate) {

        $personalProduct = self::verifiyPersonalProduct($pk);
        if ($expectedRate) {
            $personalProduct->setExpectedRate($expectedRate);
        }

        if ($amount) {
            $personalProduct->setAmount($amount);
        }

        if ($buyDate) {
            $personalProduct->setBuyDate($buyDate);
        }
        if ($expiryDate) {
            $personalProduct->setExpiryDate($expiryDate);
        }

        $personalProduct->save();
        return $personalProduct;
    }

    /**
     * Delete personal product
     *
     * @param int $pk primary key
     *
     * @return boolean
     *
     * @issue 2632
     */
    public static function deletePersonalProduct($pk) {
        $personalProduct = self::verifiyPersonalProduct($pk);
        $personalProduct->delete();
        return true;
    }

    /**
     * Get filter criteria
     *
     * @param int $accountId account id
     * @param int $offset    offset 
     * @param int $limit     limit
     *
     * @return object Criteria
     *
     * @issue 2646
     */
    public static function filter($accountId, $offset = 1, $limit = 100) {
        $criteria = new Criteria();
        if ($accountId) {
            $criteria->add(DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID, $accountId);
        }
        $criteria->add(DepositPersonalProductsPeer::SYNC_STATUS, '2', Criteria::ALT_NOT_EQUAL);
        $criteria->setOffset($offset);
        $criteria->setLimit($limit);
        return $criteria;
    }


    /**
     * Get personal products by user
     *
     * @param int $accountId account id
     * @param int $offset    offset 
     * @param int $limit     limit
     * 
     * @return array
     *
     * @issue 2632
     */
    public static function getPersonProductByUser($accountId, $offset = 1, $limit = 100) {
        $userProducts = DepositPersonalProductsPeer::doSelect(self::filter($accountId, $offset, $limit));

        $products = array();
        foreach ($userProducts as $key => $userProduct) {
            $products[$key]['account_id']       = $userProduct->getDepositMembersId();
            $products[$key]['product_id']       = $userProduct->getDepositFinancialProductsId();
            $products[$key]['expectet_rate']    = $userProduct->getExpectedRate();
            $products[$key]['amount']           = $userProduct->getAmount();
            $products[$key]['buy_date']         = $userProduct->getBuyDate('Y-m-d');
            $products[$key]['expired_date']     = $userProduct->getExpiryDate('Y-m-d');
            $products[$key]['uuid']             = $userProduct->getUuid();
            $products[$key]['sync_status']      = $userProduct->getSyncStatus();
            $products[$key]['deadline_reminder'] = $userProduct->getDeadlineReminder();

            $products[$key]['product']          = (self::getUserProducts($userProduct->getDepositFinancialProductsId()));
        }   
        return $products;
    }

    /**
     * Get user products
     *
     * @param int $accountId account id
     *
     * @return array
     *
     * @issue 2646
     */
    public static function getUserProducts($accountId) {
        $sql = sprintf(
            "SELECT %s FROM %s WHERE %s = %s",
            implode(',', DepositFinancialProductsPeer::getFieldNames(BasePeer::TYPE_FIELDNAME)),
            DepositFinancialProductsPeer::TABLE_NAME,
            DepositFinancialProductsPeer::ID,
            $accountId
        );
        $unecessaryField = array(
            'warnings',
            'stop_condition',
            'invest_scope',
            'raise_condition',
            'purchase',
            'profit_desc',
            'invest_scope',
            'feature',
            'cost',
            'announce'
        );

        $product = DepositFinancialProductsPeer::getFormatProduct($sql, $unecessaryField);
        if ($banks = self::getUserProductBanks($product[0]['bank_id'])) {
            $products = array_merge($product[0], $banks);    
        } else {
            $products = $product[0];
        }
        
        return $products;
    }

    /**
     * Get user's product bank info
     *
     * @param int $bankId bank id
     *
     * @return array
     *
     * @issue 2579
     */
    public static function getUserProductBanks($bankId) {
        $bank = DepositBankPeer::retrieveByPK($bankId);
        if (!$bank) {
            return array();
        }
        return array(
            'short_char'            => $bank->getShortChar(),
            'bank_display_name'     => $bank->getShortName(),
            'tel'                   => $bank->getPhone()
        );
    }   

    /**
     * Check if personal product is valid
     *
     * @param int $pk primary key
     *
     * @return object DepositPersonalProducts
     *
     * @issue 2632
     */
    public static function getPersonProductById($pk) {
        $products = array();
        $userProduct = self::verifiyPersonalProduct($pk);
        
        $products['account_id']       = $userProduct->getDepositMembersId();
        $products['product_id']       = $userProduct->getDepositFinancialProductsId();
        $products['expectet_rate']    = $userProduct->getExpectedRate();
        $products['amount']           = $userProduct->getAmount();
        $products['buy_date']         = $userProduct->getBuyDate('Y-m-d');
        $products['expired_date']     = $userProduct->getExpiryDate('Y-m-d');
        $products['uuid']             = $userProduct->getUuid();
        $products['sync_status']      = $userProduct->getSyncStatus();
        $products['deadline_reminder']      = $userProduct->getDeadlineReminder();
        $products['product']          = self::getUserProducts($userProduct->getDepositFinancialProductsId());
        return $products;
    }

    /**
     * Get search lists
     *
     * @return array
     *
     * @issue 2678
     */
    public static function getSearchLists() {
        return array(
            1 => util::getMultiMessage('Product Bank Name'),
            2 => util::getMultiMessage('Product Profit Type'),
            3 => util::getMultiMessage('Purchase Amount'),
            4 => util::getMultiMessage('Product Expected Rate'),
        );
    }

    /**
     * Retrieve object by uuid
     *
     * @param string $uuid string
     *
     * @return mixed
     *
     * @issue 2702
     */
    public static function retrieveByUuid($uuid) {
        $criteria = new Criteria();
        $criteria->add(DepositPersonalProductsPeer::UUID, $uuid);
        return DepositPersonalProductsPeer::doSelectOne($criteria);
    }


    /**
     * Check deadline eg 3 product
     *
     * @return objects
     *
     * @issue 2714
     */
    public static function checkDeadlineProducts() {
        $queryFields = array(
            DepositFinancialProductsPeer::NAME,
            DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID,
            DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID,
            DepositMembersPeer::IS_LOGIN
        );

        $sql = sprintf("SELECT %s FROM %s", implode(',', $queryFields), DepositPersonalProductsPeer::TABLE_NAME);

        $sql .= sprintf(" LEFT JOIN %s ON %s = %s", DepositMembersPeer::TABLE_NAME, DepositMembersPeer::ID, DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID);

        $sql .= sprintf(" LEFT JOIN %s ON %s = %s", DepositFinancialProductsPeer::TABLE_NAME, DepositFinancialProductsPeer::ID, DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID);

        $sql .= sprintf(" WHERE 1 AND %s = '%s'", DepositPersonalProductsPeer::DEADLINE_REMINDER, DepositMembersPeer::YES);

        // $sql .= sprintf(" AND %s = '%s'", DepositMembersPeer::IS_LOGIN, DepositMembersPeer::YES);

        $sql .= " AND UNIX_TIMESTAMP(" . DepositFinancialProductsPeer::DEADLINE .") - UNIX_TIMESTAMP(DATE_FORMAT(NOW(),'%Y-%m-%d')) < 259200";

        $sql .= " AND UNIX_TIMESTAMP(" . DepositFinancialProductsPeer::DEADLINE .") - UNIX_TIMESTAMP(DATE_FORMAT(NOW(),'%Y-%m-%d')) != 0";

        //Fixed can not be send push message which product was deleted
        $sql .= sprintf(" AND %s != '%s' ", DepositPersonalProductsPeer::SYNC_STATUS, 2);

        $connection = Propel::getConnection();
        $statement = $connection->prepareStatement($sql);
        $resultset = $statement->executeQuery();
        
        while ($resultset->next()) {
            $exist = true;
            $rows = $resultset->getRow();
            $message = sprintf(DEADLINE, $rows['NAME']);

            //Add a station news
            DepositMembersStationNewsPeer::addIndividualLetter(SYSTEM_TITLE, $message, DepositStationNewsPeer::TYPE_DEADLINE, $rows['DEPOSIT_MEMBERS_ID'], $rows['DEPOSIT_FINANCIAL_PRODUCTS_ID']);

            if ($rows['IS_LOGIN'] == DepositMembersPeer::YES) {
                PushMessagesPeer::pushMessageEnqueue($rows['DEPOSIT_MEMBERS_ID'], $rows['DEPOSIT_FINANCIAL_PRODUCTS_ID'], $message);    
            }
        }
        if ($exist == false) {
            throw new Exception(EXCEP);
        }

    }

}
