<?php

/**
 * Subclass for representing a row from the 'application_work_flow' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ApplicationWorkFlow extends BaseApplicationWorkFlow
{
     /**
     * rewrite save
     * wuyou <you.wu@expacta.com.cn>
     */
    const HAVE_APPROVAL_MSG = "该审批已经被审批过了。你不能再进行审批操作了。";
    public function save($con = null){
        //var_dump($this->getId());exit;
        $applicationWorkFolw = ApplicationWorkFlowPeer::retrieveByPK($this->getId());
        //var_dump($applicationWorkFolw);exit;
        if( $applicationWorkFolw && $applicationWorkFolw->getApprovalResult() > 0){
            throw new PropelException(self::HAVE_APPROVAL_MSG);
        }
        return parent::save($con);
    }
}
