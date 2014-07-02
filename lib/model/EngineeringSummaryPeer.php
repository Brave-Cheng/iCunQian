<?php

/**
 * Subclass for performing query and update operations on the 'engineering_summary' table.
 *
 * 
 *
 * @package lib.model
 */
class EngineeringSummaryPeer extends BaseEngineeringSummaryPeer {

    /**
     * 
     * @param int $applicationId
     * @return object
     * @issue 2337
     * @author brave
     */
    public static function getEngineeringSummaryByApplicationId($applicationId) {
        $criteria = new Criteria();
        $criteria->add(EngineeringSummaryPeer::APPLICATION_ID, $applicationId);
        return EngineeringSummaryPeer::doSelectOne($criteria);
    }

}
