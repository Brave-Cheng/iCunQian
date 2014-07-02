<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Approver
 *
 * @author brave
 */
class Approver {

    public static function createApprover($approver = 1) {
        switch ($approver) {
            case 2:
                return new TwoApprover();
                break;
            default:
                return new SimpleApprover();
                break;
        }
    }

}