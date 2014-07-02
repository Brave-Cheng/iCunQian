<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Approve
 *
 * @author Administrator
 */
interface ApproveMessage {

    const NOSTEP = '当前审批类型没有设置审批流程';
    const NONEXTSTEP = '当前审批步骤已经结束';

}

abstract class BaseApprove implements ApproveMessage {

    abstract public function checkApprovalIsComplete();

    abstract public function commitFirstApproval();

    abstract public function commitCurrentApproval();
}
