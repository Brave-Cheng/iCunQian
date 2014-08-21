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
     * @param int   $productId    product id
     * @param int   $accountId    account id
     * @param float $expectedRate expected rate
     * @param float $amount       amount
     * @param date  $buyDate      buy date
     * @param date  $expiryDate   expiry date
     *
     * @return object DepositPersonalProducts
     * 
     * @issue 2632
     */
    public static function addPersonalProduct($productId, $accountId, $expectedRate, $amount, $buyDate, $expiryDate) {

        $criteria = new Criteria();
        $criteria->add(DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID, $productId);
        $criteria->add(DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID, $accountId);
        $criteria->add(DepositPersonalProductsPeer::EXPECTED_RATE, $expectedRate);
        $criteria->add(DepositPersonalProductsPeer::AMOUNT, $amount);
        $criteria->add(DepositPersonalProductsPeer::BUY_DATE, $buyDate);
        $criteria->add(DepositPersonalProductsPeer::EXPIRY_DATE, $expiryDate);

        $personalProduct = DepositPersonalProductsPeer::doSelectOne($criteria);
        if ($personalProduct) {
            return $personalProduct;
        }

        $personalProduct = new DepositPersonalProducts();
        $personalProduct->setDepositFinancialProductsId($productId);
        $personalProduct->setDepositMembersId($accountId);

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
        $personalProduct->setIsValid(DepositMembersPeer::YES);
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
     * @param int    $accountId account id
     * @param string $isValid   valid 
     *
     * @return object Criteria
     *
     * @issue 2632
     */
    
    /**
     * Get filter criteria
     *
     * @param int     $accountId account id
     * @param int     $offset    offset 
     * @param int     $limit     limit
     * @param boolean $isValid   boolean
     *
     * @return object Criteria
     *
     * @issue 2646
     */
    public static function filter($accountId, $offset = 1, $limit = 100,  $isValid = DepositMembersPeer::YES) {
        $criteria = new Criteria();
        if ($accountId) {
            $criteria->add(DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID, $accountId);
        }
        $criteria->add(DepositPersonalProductsPeer::IS_VALID, $isValid);
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

        // if (!$userProducts) {
        //     throw new ObjectsException(ObjectsException::$error2000, $accountId);
        // }


        $products = array();
        foreach ($userProducts as $key => $userProduct) {
            $products[$key]['personal_product_id'] = $userProduct->getId();
            $products[$key]['account_id']       = $userProduct->getDepositMembersId();
            $products[$key]['product_id']       = $userProduct->getDepositFinancialProductsId();
            $products[$key]['expectet_rate']    = $userProduct->getExpectedRate();
            $products[$key]['amount']           = $userProduct->getAmount();
            $products[$key]['buy_date']         = $userProduct->getBuyDate('Y-m-d');
            $products[$key]['expired_date']     = $userProduct->getExpiryDate('Y-m-d');

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

}
