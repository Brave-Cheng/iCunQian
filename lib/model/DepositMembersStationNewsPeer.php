<?php

/**
 * Subclass for performing query and update operations on the 'deposit_members_station_news' table.
 *
 * 
 *
 * @package lib\model
 */ 
class DepositMembersStationNewsPeer extends BaseDepositMembersStationNewsPeer
{

    const STATUS_0 = '0';
    const STATUS_1 = '1';
    const STATUS_2 = '2';

    const FORM_POST_SELECTED    = 'selected';
    const FORM_POST_WHOLE       = 'whole';

    const API_LETTER_ID     = 'letter_id';
    const API_TITLE         = 'title';
    const API_CONTENT       = 'content';
    const API_SEND_TIME     = 'send_time';
    const API_TYPE          = 'types';
    const API_STATUS        = 'status';
    const API_UPDATED_AT    = 'updated_at';


    /**
     * Get form post types
     *
     * @return array
     *
     * @issue  2706
     */
    public static function getFormPostType() {
        return array(
            self::FORM_POST_WHOLE       => self::FORM_POST_WHOLE,
            self::FORM_POST_SELECTED    => self::FORM_POST_SELECTED,
        );
    }

    /**
     * Add station news for member
     *
     * @param int $accountId deposit members id
     * @param int $letterId  deposit station news id
     * @param int $status    status
     *
     * @return void
     * 
     * @issue 2706
     */
    public static function addMemberStationNews($accountId, $letterId, $status = DepositMembersStationNewsPeer::STATUS_0) {

        $memberStationNews = new DepositMembersStationNews();
        $memberStationNews->setDepositStationNewsId($letterId);
        $memberStationNews->setDepositMembersId($accountId);
        $memberStationNews->setStatus($status);
        $memberStationNews->save();

        return $memberStationNews;
    }

    /**
     * Retrieve letters by account
     *
     * @param int $accountId deposit members id
     * @param int $offset    offset 
     * @param int $limit     limit
     *
     * @return object
     *
     * @issue 2713
     */
    public static function retrieveLettersByAccount($accountId, $offset = 1, $limit = 100) {
        $depositMembersStationNews = DepositMembersStationNewsPeer::doSelect(self::filter($accountId, $offset, $limit));
        $lists = array();
        if ($depositMembersStationNews) {
            foreach ($depositMembersStationNews as $key => $news) {
                $lists[$key]['letter_id']     = $news->getId();
                $lists[$key]['title']         = $news->getDepositStationNews()->getTitle();
                $lists[$key]['content']       = $news->getDepositStationNews()->getContent();
                $lists[$key]['send_time']     = $news->getDepositStationNews()->getSendTime();
                $lists[$key]['type']          = $news->getDepositStationNews()->getType();
                $lists[$key]['status']        = $news->getStatus();
            }
        }
        return $lists;
    }


    /**
     * Get letters by account
     *
     * @param int $accountId account id
     * @param int $since     timestamp
     * @param int $limit     limit 
     *
     * @return string sql
     *
     * @issue 2713
     */
    public static function getLettersByAccount($accountId, $since = null, $limit = 100) {

        $sql = self::originFilter($accountId, false, $since, $limit);

        $total = DepositFinancialProductsPeer::getTotal(self::originFilter($accountId, true));

        $lists = $rows = array();

        $typeLists = DepositStationNewsPeer::getTypes();

        $con = Propel::getConnection();
        $statement = $con->prepareStatement($sql);
        $resultsets = $statement->executeQuery();        
        while ($resultsets->next()) {
            $row = $resultsets->getRow();
            $lists[DepositMembersStationNewsPeer::API_LETTER_ID]     = $row['ID'];
            $lists[DepositMembersStationNewsPeer::API_TITLE]         = $row['TITLE'];
            $lists[DepositMembersStationNewsPeer::API_CONTENT]       = $row['CONTENT'];
            $lists[DepositMembersStationNewsPeer::API_SEND_TIME]     = $row['SEND_TIME'];
            $lists[DepositMembersStationNewsPeer::API_TYPE]          = array('type' => array_search($row['TYPE'], $typeLists), 'key' => $row['DEPOSIT_FINANCIAL_PRODUCTS_ID']);
            $lists[DepositMembersStationNewsPeer::API_STATUS]        = $row['STATUS'];
            $lists[DepositMembersStationNewsPeer::API_UPDATED_AT]    = $row['UPDATED_AT'];
            $rows[] = $lists;    
        }
        return array('list' => $rows, 'total' => $total);
    }

    /**
     * Make origin sql filter
     *
     * @param int     $accountId account id
     * @param boolean $total     is get total
     * @param int     $since     timestamp
     * @param int     $limit     limit 
     *
     * @return string sql
     *
     * @issue 2713
     */
    public static function originFilter($accountId, $total = false, $since = null, $limit = 100) {
        $queryPieces = array(
            DepositMembersStationNewsPeer::ID,
            DepositMembersStationNewsPeer::DEPOSIT_STATION_NEWS_ID,
            DepositMembersStationNewsPeer::DEPOSIT_MEMBERS_ID,
            DepositStationNewsPeer::TITLE,
            DepositStationNewsPeer::CONTENT,
            DepositStationNewsPeer::SEND_TIME,
            DepositStationNewsPeer::TYPE,
            DepositStationNewsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID,
            DepositMembersStationNewsPeer::STATUS,
            DepositMembersStationNewsPeer::UPDATED_AT,
        );

        if ($total) {
            $pieces = " COUNT(*) AS total";
        } else {
            $pieces = implode(',', $queryPieces);
        }   

        $sql = sprintf("SELECT %s FROM %s", $pieces, DepositMembersStationNewsPeer::TABLE_NAME);
        $sql .= sprintf(" LEFT JOIN %s ON %s = %s", DepositStationNewsPeer::TABLE_NAME, DepositStationNewsPeer::ID, DepositMembersStationNewsPeer::DEPOSIT_STATION_NEWS_ID);
        $sql .= " WHERE 1";
        $sql .= sprintf(" AND %s = %s", DepositMembersStationNewsPeer::DEPOSIT_MEMBERS_ID, $accountId);

        $sql .= sprintf(" AND %s != '%s'", DepositMembersStationNewsPeer::STATUS, DepositMembersStationNewsPeer::STATUS_2);

        if ($since) {
            $sql .= " AND " . DepositMembersStationNewsPeer::UPDATED_AT . " > FROM_UNIXTIME(" . $since . ", '%Y-%m-%d %H:%i:%s')";
        }
        $orderBy = sprintf(" ORDER BY %s ASC", DepositMembersStationNewsPeer::UPDATED_AT);

        if ($total) {
            return $sql;
        }

        $limit = sprintf(" LIMIT %s", $limit);

        return $sql . $orderBy . $limit;
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
     * @issue 2713
     */
    public static function filter($accountId, $offset = 1, $limit = 100) {
        $criteria = new Criteria();
        if ($accountId) {
            $criteria->add(DepositMembersStationNewsPeer::DEPOSIT_MEMBERS_ID, $accountId);
        }
        $criteria->setOffset($offset);
        $criteria->setLimit($limit);
        return $criteria;
    }

    /**
     * Set letters read
     *
     * @param int $memberStationId priamary key
     * @param int $status          status
     *
     * @return object
     *
     * @issue 2713
     */
    public static function makeLetterRead($memberStationId, $status) {
        $criteria = new Criteria();
        $criteria->add(DepositMembersStationNewsPeer::ID, $memberStationId);
        $memberStationNews = DepositMembersStationNewsPeer::doSelectOne($criteria);

        if (!$memberStationNews) {
            throw new ObjectsException(ObjectsException::$error2000, sprintf(util::getMultiMessage('%s is not subscribed.'), $subscribeId));
        }

        if ($memberStationNews) {
            $memberStationNews->setStatus($status);
            $memberStationNews->save();
        }
        return $memberStationNews;
    }

    /**
     * Add a message to an individual station
     *
     * @param string $title     title
     * @param string $content   content
     * @param string $type      type string 
     * @param int    $accountId deposit members id 
     * @param int    $productId deposit financial products id
     *
     * @return object
     *
     * @issue 2706
     *
     */
    public static function addIndividualLetter($title, $content, $type, $accountId, $productId = 0) {
        $news = DepositStationNewsPeer::addStationNews($title, $content, $type, $productId);
        return self::addMemberStationNews($accountId, $news->getId());
    }
}
