<?php

/**
 * Subclass for representing a row from the 'push_devices' table.
 *
 * 
 *
 * @package lib\model
 */ 
class PushDevices extends BasePushDevices
{
    /**
     * Re-write save action
     *
     * @param object $con object
     *
     * @return affectedRows
     *
     * @issue 2715
     */
    public function save($con = null) {
        try {
            return parent::save($con);
        } catch (PropelException $e) {
            
        }
    }
}
