<?php

/**
 * Subclass for performing query and update operations on the 'engineering_summary_items' table.
 *
 * 
 *
 * @package lib.model
 */
class EngineeringSummaryItemsPeer extends BaseEngineeringSummaryItemsPeer {

    /**
     * get all engineering summary items
     * @param int $engineeringSummaryId
     * @issue 2337
     * @author brave
     */
    public static function getItemsByEngineeringSummaryId($engineeringSummaryId) {
        $criteria = new Criteria();
        $criteria->add(EngineeringSummaryItemsPeer::ENGINEERING_SUMMARY_ID, $engineeringSummaryId);
        return EngineeringSummaryItemsPeer::doSelect($criteria);
    }

}
