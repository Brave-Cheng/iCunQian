<?php

/**
 * Subclass for performing query and update operations on the 'deposit_station_news' table.
 *
 * 
 *
 * @package lib\model
 */ 
class DepositStationNewsPeer extends BaseDepositStationNewsPeer
{
    const TYPE_DEFAULT      = 'default';
    const TYPE_PUSH         = 'push';
    const TYPE_DEADLINE     = 'deadline';

    const SEND_LETTER = 'sendLetter';

    const STATUS_0 = '0';
    const STATUS_1 = '1';
    const STATUS_2 = '2';



    /**
     * Get station news status
     *
     * @return array
     *
     * @issue 2706
     */
    public static function getStationNewsStatus() {
        return array(
            DepositStationNewsPeer::STATUS_0 => util::getMultiMessage('Unread'),
            DepositStationNewsPeer::STATUS_1 => util::getMultiMessage('BeRead'),
            DepositStationNewsPeer::STATUS_2 => util::getMultiMessage('Delete'),
        );
    }


    /**
     * Add station news
     *
     * @param string $title     title
     * @param string $content   content
     * @param string $type      type
     * @param int    $productId deposit financial products id
     *
     *  @return object DepositStationNews
     * 
     * @issue 2706
     */
    public static function addStationNews($title, $content, $type = DepositStationNewsPeer::TYPE_DEFAULT, $productId = 0) {
        
        $criteria = new Criteria();
        $criteria->add(DepositStationNewsPeer::TITLE, $title);
        $criteria->add(DepositStationNewsPeer::CONTENT, $content);
        $criteria->add(DepositStationNewsPeer::TYPE, $type);
        $stationNews = DepositStationNewsPeer::doSelectOne($criteria);
        if ($stationNews) {
            $stationNews->setSendTime(time());
            $stationNews->save();
            return $stationNews;
        } else {
            $stationNews = new DepositStationNews();
            $stationNews->setTitle($title);
            $stationNews->setContent($content);
            $stationNews->setType($type);
            $stationNews->setSendTime(time());
            $stationNews->setDepositFinancialProductsId($productId);
            $stationNews->save();
            return $stationNews;
        }
    }    

    /**
     * Get Type fields
     *
     * @return string
     *
     * @issue 2706
     */
    public static function getTypes() {
        $types = array(
            self::TYPE_DEFAULT,
            self::TYPE_PUSH,
            self::TYPE_DEADLINE,
        );
        return $types;
    }
}
