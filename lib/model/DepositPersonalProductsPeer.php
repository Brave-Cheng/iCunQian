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
    public static function retrieveByPK($id, $productId = null, $accountId = null, $con = null) {
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
            throw new Exception('The personal product is not exist');
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
    public static function filter($accountId, $isValid = DepositMembersPeer::YES) {
        $criteria = new Criteria();
        if ($accountId) {
            $criteria->add(DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID, $accountId);
        }
        $criteria->add(DepositPersonalProductsPeer::IS_VALID, $isValid);
        return $criteria;
    }


    /**
     * Get personal products by user
     *
     * @param int $accountId account id
     *
     * @return array
     *
     * @issue 2632
     */
    public static function getPersonProductByUser($accountId) {
        $userProducts = DepositPersonalProductsPeer::doSelect(self::filter($accountId));
        if (!$userProducts) {
            throw new Exception("There is no product.");
        }
        $products = array();
        foreach ($userProducts as $key => $userProduct) {
            $products[$key]['account_id']       = $userProduct->getDepositMembersId();
            $products[$key]['product_id']       = $userProduct->getDepositFinancialProductsId();
            $products[$key]['expectet_rate']    = $userProduct->getExpectedRate();
            $products[$key]['amount']           = $userProduct->getAmount();
            $products[$key]['buy_date']         = $userProduct->getBuyDate();
            $products[$key]['expiry_date']      = $userProduct->getExpiryDate();
        }   
        return $products;
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
        $products['buy_date']         = $userProduct->getBuyDate();
        $products['expiry_date']      = $userProduct->getExpiryDate();

        return $products;
    }
}
