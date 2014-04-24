<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OneApprover
 *
 * @author brave
 */
class SimpleApprover extends BaseApprove {

    //set current application 
    public $application = null;
    //set current application
    public $workflow = null;
    //current approve advice
    public $approveAdvice = '';
    public $approveStatus = 0;

    public function setApplication($application) {
        $this->application = $application;
    }

    public function setWorkflow($workflow) {
        $this->workflow = $workflow;
    }

    public function setApproveAdvice($approveAdvice) {
        $this->approveAdvice = $approveAdvice;
    }

    public function setApproveStatus($approveStatus) {
        $this->approveStatus = $approveStatus;
    }

    /**
     * 
     * @issue 2337
     * @author brave
     */
    public function commitCurrentApproval() {
        $currentApprover = WorkflowPeer::getCurrentStepApprover($this->workflow->getId(), $this->application->getProjectId(), $this->application->getDepartmentId());
        if ($currentApprover) {
            if ($this->checkApprovalIsComplete()) {
                $this->approveStatus = $this->approveStatus == 1 ? 3 : $this->approveStatus;
            }
            if ($this->approveStatus != 2) {
                try {
                    $this->commitNextApproval();
                } catch (Exception $exc) {
                    throw new Exception($exc->getMessage());
                }
            }
            //ApplicationPeer::updateApplicationStatus($this->application->getId(), (int) $this->approveStatus);
            try {
                ApplicationWorkFlowPeer::insertApplicationWorkflow(
                        $this->application->getId(), $this->workflow->getId(), $currentApprover->getId(), $this->approveStatus, $this->approveAdvice
                );
            } catch (Exception $ex) {
                throw new Exception($ex->getMessage());
            }
            ApplicationPeer::updateApplicationStatus($this->application->getId(), (int) $this->approveStatus);
        } else {
            throw new Exception(self::NONEXTSTEP);
        }
    }

    /**
     * insert next application workflow, update the application status if the application step is end
     * @issue 2337
     * @author brave
     */
    public function commitNextApproval() {
        $nextWorkflowId = 0;
        $nextApprover = WorkflowPeer::getNextApprover($this->workflow->getId(), $this->application->getApprovalId(), $this->application->getProjectId(), $this->application->getDepartmentId(), $nextWorkflowId);
        if ($nextApprover) {
            try {
                ApplicationWorkFlowPeer:: insertApplicationWorkflow($this->application->getId(), $nextWorkflowId, $nextApprover->getId());
            } catch (Exception $exc) {
                throw new Exception($exc->getMessage());
            }
        } else {
            if ($this->checkApprovalIsComplete()) {
                ApplicationPeer::updateApplicationStatus($this->application->getId(), $this->approveStatus);
            }
        }
    }

    /**
     * @issue 2337
     * @author brave
     */
    public function checkApprovalIsComplete() {
        $nextApprover = WorkflowPeer::getNextApprover($this->workflow->getId(), $this->application->getApprovalId(), $this->application->getProjectId(), $this->application->getDepartmentId());
        if ($nextApprover) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * commit the first application
     * @throws Exception
     * @issue 2337
     * @author brave
     */
    public function commitFirstApproval($departmentId=0) {
        if (WorkflowPeer::getTotalStepOfApproval($this->application->getApprovalId()) === 0) {
            throw new Exception(self::NOSTEP);
        }

        if (ApplicationWorkFlowPeer::checkApplicationWorkflowStepExist($this->application->getId()) === 0) {
            $firstApprover = WorkflowPeer::getFirstApprover($this->application->getApprovalId(), $this->application->getProjectId(), $this->application->getDepartmentId());
            if ($firstApprover) {
                ApplicationWorkFlowPeer:: insertApplicationWorkflow($this->application->getId(), $this->workflow->getId(), $firstApprover->getId());
                if ($this->application->getProject()) {
                    $firstTitleContent = $this->application->getProject()->getName() . '项目的 ' . $this->application->getName() . '审批';
                } else {
                    $firstTitleContent = $this->application->getName() . '审批';
                }
                sfLoader::loadHelpers('Url');
                $linkUrl = url_for(ApplicationPeer::getRedirectPageByApproval($this->application->getApprovalId(), $this->application->getId(), true));
                $createrInfo = $this->application->getSfGuardUser()->getProfile();
                //send message to firstApprover
                $sfUserDepartment = DepartmentSfGuardUserPeer::getDepartmentSfUserBySfGuardUserId($createrInfo->getUserId());
                $notificationId = util::addNotification(0, '您有由 ' . $sfUserDepartment->getDepartment()->getName() . ' ' . $createrInfo->getLastName() . $createrInfo->getFirstName() . ' 提交的新审批', $firstTitleContent . '，需要您的审批。<br/> <a class="read" href="' . $linkUrl . '">跳转到审批</a>');
                util::addNotificationRelation($notificationId, $firstApprover->getProfile()->getUserId());
                //send short message
                $smsQueue = new oaQueue();
                $smsQueue->enqueue($firstApprover->getProfile()->getTelephone(), '您有由 ' . $sfUserDepartment->getDepartment()->getName() . $createrInfo->getLastName() . $createrInfo->getFirstName() . ' 提交的新审批，需要您的审批。', $notificationId);
            }
        }
    }

}

