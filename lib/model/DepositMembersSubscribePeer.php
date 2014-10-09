<?php

/**
 * Subclass for performing query and update operations on the 'deposit_members_subscribe' table.
 *
 * 
 *
 * @package lib\model
 */ 
class DepositMembersSubscribePeer extends BaseDepositMembersSubscribePeer
{

    const API_ACCOUNT_ID    = 'account_id';
    const API_BANK_ID       = 'bank_id';
    const API_CITY          = 'city';
    const API_PROFIT_TYPE   = 'profit_type';
    const API_EXPECTED_RATE = 'expected_rate';
    const API_INVEST_CYCLE  = 'invest_cycle';
    const API_IS_VALID      = 'is_valid';

    const API_BANK          = 'bank';
    const API_TYPE          = 'type';
    const API_CYCLE         = 'cycle';
    const API_RATE          = 'rate';

    /**
     * Subscribe
     *
     * @param int    $accountId    deposit members id
     * @param int    $bankId       deposit bank id
     * @param string $city         city
     * @param int    $profitType   profit type
     * @param float  $expectedRate expected rate
     * @param int    $investCycle  invest cycle
     * @param string $isValid      is valid
     *
     * @return object DepositMembersSubscribe
     *
     * @issue 2715
     */
    public static function subscribe($accountId, $bankId, $city, $profitType, $expectedRate, $investCycle, $isValid = DepositMembersPeer::YES) {
        $subscribe = DepositMembersSubscribePeer::retrieveByAccountId($accountId);

        if (!$subscribe) {
            $subscribe = new DepositMembersSubscribe();
            $subscribe->setDepositMembersId($accountId);
            $subscribe->setDepositBankId($bankId);
            $subscribe->setCity($city);
            $subscribe->setProfitType($profitType);
            $subscribe->setExpectedRate($expectedRate);
            $subscribe->setInvestCycle($investCycle);
            $subscribe->setIsValid($isValid);
            $subscribe->save();
            return $subscribe;
        }
        $query =  " UPDATE " . DepositMembersSubscribePeer::TABLE_NAME . "
                SET " . DepositMembersSubscribePeer::DEPOSIT_BANK_ID . " = " . $bankId . ",
                 " . DepositMembersSubscribePeer::CITY . " = '" . $city . "', 
                 " . DepositMembersSubscribePeer::PROFIT_TYPE . " = '" . $profitType . "',
                 " . DepositMembersSubscribePeer::EXPECTED_RATE . " = " . $expectedRate . ",
                 " . DepositMembersSubscribePeer::INVEST_CYCLE . " = " .  $investCycle . ",
                 " . DepositMembersSubscribePeer::IS_VALID . " = '" . $isValid . "',
                 " . DepositMembersSubscribePeer::UPDATED_AT . " = '" . date('Y-m-d H:i:s') . "'
                WHERE
                    " . DepositMembersSubscribePeer::ID . " = " . $subscribe->getId() . "";

        $connection = Propel::getConnection();
        $statement = $connection->prepareStatement($query);
        $resultset = $statement->executeQuery();

        return $subscribe;
    }

    /**
     * Unsubscribe
     *
     * @param int $subscribeId subscribe id
     *
     * @return object DepositMembersSubscribe
     *
     * @issue 2715
     */
    public static function unSubscribe($subscribeId) {
        $subscribe = DepositMembersSubscribePeer::retrievePk($subscribeId);
        if ($subscribe->getIsValid() == DepositMembersPeer::NO) {
            // throw new ObjectsException(ObjectsException::$error2001, util::getMultiMessage('The device is unsubscribe.'));
            return $subscribe;
        }
        $subscribe->setIsValid(DepositMembersPeer::NO);
        $subscribe->save();
        return $subscribe;
    }

    /**
     * retrieve by pk 
     *
     * @param int $subscribeId subscribe id
     *
     * @return mixed
     *
     * @issue 2715
     */
    public static function retrievePk($subscribeId) {
        $criteria = new Criteria();
        $criteria->add(DepositMembersSubscribePeer::ID, $subscribeId);
        $subscribe = DepositMembersSubscribePeer::doSelectOne($criteria);
        if (!$subscribe) {
            throw new ObjectsException(ObjectsException::$error2000, sprintf(util::getMultiMessage('%s is not subscribed.'), $subscribeId));
        }
        return $subscribe;
    }   

    /**
     * Retrieve by account id
     *
     * @param int $accountId deposit members id
     *
     * @return mixed
     *
     * @issue 2715
     */
    public static function retrieveByAccountId($accountId) {
        $criteria = new Criteria();
        $criteria->add(DepositMembersSubscribePeer::DEPOSIT_MEMBERS_ID, $accountId);
        return  DepositMembersSubscribePeer::doSelectOne($criteria);
    }

    /**
     * Get subscribe by user
     *
     * @param int $accountId account id
     *
     * @return array
     *
     * @issue  number
     */
    public static function getSubscribeListByUser($accountId) {
        $subscribe = DepositMembersSubscribePeer::retrieveByAccountId($accountId);

        $array = array();

        if ($subscribe) {
            $array[DepositMembersSubscribePeer::API_ACCOUNT_ID]     = $subscribe->getApiDepositMembersId();
            $array[DepositMembersSubscribePeer::API_BANK_ID]        = $subscribe->getApiDepositBankId();
            $array[DepositMembersSubscribePeer::API_BANK]           = $subscribe->getDepositBank() ? $subscribe->getDepositBank()->getShortName() : '';
            $array[DepositMembersSubscribePeer::API_CITY]           = $subscribe->getApiCity();
            $array[DepositMembersSubscribePeer::API_PROFIT_TYPE]    = $subscribe->getApiProfitType();
            $array[DepositMembersSubscribePeer::API_TYPE]           = $subscribe->getProfitType();
            $array[DepositMembersSubscribePeer::API_EXPECTED_RATE]  = $subscribe->getApiExpectedRate();
            $array[DepositMembersSubscribePeer::API_RATE]           = $subscribe->getApiRate();
            $array[DepositMembersSubscribePeer::API_INVEST_CYCLE]   = $subscribe->getApiInvestCycle();
            $array[DepositMembersSubscribePeer::API_CYCLE]          = $subscribe->getApiCycle();
            $array[DepositMembersSubscribePeer::API_IS_VALID]       = $subscribe->getApiIsValid();

        }

        return $array;
    }

    /**
     * Get subscribers
     *
     * @param int    $bankId       deposit bank id
     * @param string $city         city
     * @param int    $profitType   profit type
     * @param int    $expectedRate expected rate
     * @param int    $investCycle  invest cycle
     * @param string $isValid      check is valid
     * @param string $online       check is online 
     *
     * @return mixed
     *
     * @issue 2714
     */
    public static function getSubscribers($bankId, $city, $profitType, $expectedRate, $investCycle, $isValid = DepositMembersPeer::YES, $online = DepositMembersPeer::YES) {
        $sql1 = $sql2 = $sql3 = $sql4 = $sql5 = $sqlOr = '';
        
        $sql = sprintf("SELECT %s FROM %s", implode(',', DepositMembersSubscribePeer::getFieldNames(BasePeer::TYPE_COLNAME)),DepositMembersSubscribePeer::TABLE_NAME
        );

        $sql .= sprintf(" LEFT JOIN %s ON %s = %s", DepositMembersPeer::TABLE_NAME, DepositMembersPeer::ID, DepositMembersSubscribePeer::DEPOSIT_MEMBERS_ID);

        // $sql.= sprintf(" WHERE 1 AND %s = '%s'", DepositMembersPeer::IS_LOGIN, $online);

        $sql .= sprintf(" AND %s = '%s'", DepositMembersSubscribePeer::IS_VALID, $isValid);
        if ($bankId) {
            $sql2 = sprintf(" %s = %s", DepositMembersSubscribePeer::DEPOSIT_BANK_ID, $bankId);
            $sqlOr .= ' OR '. $sql2;
        }
        if ($city) {
            $sql1 =  DepositMembersSubscribePeer::CITY . " LIKE '%{$city}%' "; 
            $sqlOr .= ' OR '. $sql1;
        }
        if ($profitType) {
            $sql3 = sprintf(" %s = '%s'", DepositMembersSubscribePeer::PROFIT_TYPE, $profitType);
            $sqlOr .= ' OR '. $sql3;
        }
        if ($expectedRate) {
            $scope = PushDevicesPeer::getExpectedYields();
            foreach ($scope as $key => $vars) {
                if ($vars[1] == '' && $expectedRate >= $vars[0]) {
                    $expectedRate = $key; continue;
                }
                if($expectedRate >= $vars[0] && $expectedRate < $vars[1]) {
                    $expectedRate = $key; continue;
                }
            }
            $sql4 = sprintf(" %s = %s", DepositMembersSubscribePeer::EXPECTED_RATE, $expectedRate);
            $sqlOr .= ' OR '. $sql4;
        }
        if ($investCycle) {
            $investCycle = PushDevicesPeer::translateFinancialCycle($investCycle);
            $sql5 = sprintf(" %s = %s", DepositMembersSubscribePeer::INVEST_CYCLE, $investCycle);
            $sqlOr .= ' OR '. $sql5;
        }        
        $sql .= sprintf(" AND ( %s ) ", ltrim($sqlOr, 'OR '));
        $con = Propel::getConnection();
        $statement = $con->prepareStatement($sql);
        $resultsets = $statement->executeQuery(array(), ResultSet::FETCHMODE_NUM);
        return DepositMembersSubscribePeer::populateObjects($resultsets);  
    }
}
