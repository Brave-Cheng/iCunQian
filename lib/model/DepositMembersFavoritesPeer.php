<?php

/**
 * Subclass for performing query and update operations on the 'deposit_members_favorites' table.
 *
 * 
 *
 * @package lib\model
 */ 
class DepositMembersFavoritesPeer extends BaseDepositMembersFavoritesPeer
{
    /**
     * Retrieve favorites by user
     *
     * @param int $accountId account id
     * @param int $offset    offset 
     * @param int $limit     limit
     * 
     * @return array
     *
     * @issue 2632
     */
    public static function retrieveFavoritesByUser($accountId, $offset = 1, $limit = 100) {
        $userFavorites = DepositMembersFavoritesPeer::doSelect(DepositMembersFavoritesPeer::filter($accountId, $offset, $limit));

        $products = array();
        foreach ($userFavorites as $key => $userFavorite) {
            $products[$key]['uuid']             = $userFavorite->getUuid();
            $products[$key]['sync_status']      = $userFavorite->getSyncStatus();
            $products[$key]['product']          = (DepositPersonalProductsPeer::getUserProducts($userFavorite->getDepositFinancialProductsId()));
        }   
        return $products;
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
     * @issue 2703
     */
    public static function filter($accountId, $offset = 1, $limit = 100) {
        $criteria = new Criteria();
        if ($accountId) {
            $criteria->add(DepositMembersFavoritesPeer::DEPOSIT_MEMBERS_ID, $accountId);
        }
        $criteria->add(DepositMembersFavoritesPeer::SYNC_STATUS, '2', Criteria::ALT_NOT_EQUAL);
        $criteria->setOffset($offset);
        $criteria->setLimit($limit);
        return $criteria;
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
        $criteria->add(DepositMembersFavoritesPeer::UUID, $uuid);
        return DepositMembersFavoritesPeer::doSelectOne($criteria);
    }

    /**
     * Add a favorite product
     *
     * @param int    $accountId  deposit_members_id
     * @param int    $productId  deposit_financial_products_id
     * @param string $syncStatus sync_status
     * @param string $uuid       uuid
     *
     * @return object DepositMembersFavorites
     * 
     * @issue 2703
     */
    public static function addFavoriate($accountId, $productId, $syncStatus, $uuid) {
        $favorite = new DepositMembersFavorites();
        $favorite->setDepositMembersId($accountId);
        $favorite->setDepositFinancialProductsId($productId);
        $favorite->setSyncStatus($syncStatus);
        $favorite->setUuid($uuid);
        $favorite->save();
        return $favorite;
    }
}
