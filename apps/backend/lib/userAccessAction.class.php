<?php

/**
 * class userAccessAction
 * This class is used to configure different permissions to access the action CURD array.
 * Method Naming：
 *   Must get + ModuleName + ActionName composition.
 *   ActionName by sfGuardUserProfile under the category of static variables 
 *   [CREATE_ACTION] [UPDATE_ACTION] [READ_ACTION] [DELETE_ACTION] decision.
 * If you added a getModuleNameActionName in such methods, when determining the user [add] [update] [read] [delete] operation, 
 * return the corresponding action.
 * Examples of methods:
 *   public function getDashboardAdd(){
 *       return array('insert','add');
 *   }
 */
class userAccessAction {

    public static function getUserAdd() {
        return array('leaveCheck', 'add');
    }

    public static function getMonitorAddressUpdate(){
        return array('edit', 'update');
    }

    public static function getDailyReportAdd() {
        return array('selectProject', 'add', 'insert', 'checkDailyReport');
    }

    public static function getDailyReportRead() {
        return array('list', 'read');
    }

    public static function getDocumentRead() {
        return array('exportcsv', 'read');
    }

    public static function getDocumentAdd() {
        return array('add', 'insert');
    }

    public static function getDocumentUpdate() {
        return array('edit', 'update', 'checkDocument', 'validateDocumentNumber','validateProjectPhase');
    }

    public static function getProjectDocumentUpdate() {
        return array('edit', 'update', 'checkDocument', 'validateDocumentNumber');
    }

    /**
     * get group permission of the project add method
     * @return array
     * @issue 2326
     * @author brave
     */
    public static function getProjectAdd() {
        return array(
            'add',
            'createProjectType',
            'addProjectMember',
            'insertProjectMember',
            'addDocument',
            'insertDocument',
            'addMilestone',
            'insertMilestone',
            'checkProject',
            'checkComplete',
            'checkType',
            'selectTender',
            'insertProjectType',
            'addSelectTender',
            'insert',
            'checkProjectMember'
        );
    }

    /**
     * get group permission of the project update method
     * @return array
     * @issue 2326
     * @author brave
     */
    public static function getProjectUpdate() {
        return array(
            'update',
            'edit',
            'completeProject',
            'completeTender',
            'updateCompleteTender',
        );
    }

    /**
     * get group permission of the projectmember update method
     * @return array
     * @issue 2326
     * @author brave
     */
    public static function getProjectMemberUpdate() {
        return array(
            'update',
            'edit',
            'checkMember',
            'checkProjectMember'
        );
    }

    /**
     * get group permission of the tender add method
     * @return array
     * @issue 2326
     * @author brave
     */
    public static function getTenderAdd() {
        return array(
            'add',
            'updateCompleteTender',
        );
    }

    /**
     * get group permission of the ProjectMilestone add method
     * @return array
     * @issue 2326
     * @author brave
     */
    public static function getProjectMilestoneAdd() {
        return array(
            'add',
            'insert',
        );
    }

    /**
     * get group permission of the ProjectMilestone update method
     * @return array
     * @issue 2326
     * @author brave
     */
    public static function getProjectMilestoneUpdate() {
        return array(
            'update',
            'setComplete',
            'setMilestonesComplete',
            'edit',
        );
    }

    public static function getProjectMilestoneRead() {
        return array(
            'read',
            'checkMilestone',
            'setComplete',
        );
    }

    public static function getProjectRead() {
        return array(
            'viewMilestone',
            'read',
            'completeTender',
            'completeProject',
            'updateCompleteProject',
        );
    }

    public static function getProjectStatisticsRead() {
        return array(
            'read',
        );
    }

    public static function getProjectHistoryRead() {
        return array(
            'read',
        );
    }

    public static function getProjectMilestoneDelete() {
        return array('delete', '');
    }

    public static function getSignInRead() {
        return array('read', 'statisticList');
    }

    /**
     * get method sets of commitApproval add
     * @return array
     * @issue 2337
     * @author brave
     */
    public static function getCommitApprovalAdd() {
        return array(
            'add',
            'selectApprovalType',
            'insertApprovalType',
        );
    }
    
     /**
     * get method sets of commitApproval update
     * @return array
     * @issue 2337
     * @author brave
     */
    public static function getCommitApprovalUpdate() {
        return array(
            'update',
            'updateApplication',
        );
    }

    /**
     * get method sets of engineeringSummary add
     * @return array
     * @issue 2337
     * @author brave
     */
    public static function getEngineeringSummaryAdd() {
        return array(
            'add',
            'create',
        );
    }

    public static function getEngineeringSummaryRead() {
        return array(
                'read',
                'print',
        );
    }
    /**
     * get method sets of engineeringSummary update
     * @return array
     * @issue 2337
     * @author brave
     */
    public static function getEngineeringSummaryUpdate() {
        return array(
            'update',
            'edit',
            'checkEngineeringSummary',
        );
    }

    /**
     * getEngineeringSettlementAdd 
     * @author hang.lu <hang.lu@expacta.com.cn>
     */
    public static function getEngineeringSettlementAdd() {
        return array(
            'add',
            'update',
            'leaveCheck',
        );
    }

    public static function getEngineeringSettlementRead() {
        return array(
                'read',
                'print',
        );
    }
    
    public static function getEngineeringSettlementUpdate(){
        return array(
            'edit',
            'update',
            'leaveCheck',
            );
    }

    /**
     * delete engineering summary items
     * @return array
     * @issue 2337
     * @author brave
     */
    public static function getEngineeringSummaryDelete() {
        return array(
            'delete',
            'ajaxDelete',
        );
    }
    /**
     * getEngineeringMaterialsAdd
     * @author wuyou
     */
    public static function getEngineeringMaterialsAdd() {
        return array(
            'add',
            'insert',
            'checkContractSection',
            'checkNumber'
        );
    }
        /**
     * getEngineeringMaterialsUpdate
     * @author wuyou
     */
    public static function getEngineeringMaterialsUpdate() {
        return array(
            'edit',
            'update',
            'checkContractSection',
            'checkNumber',
            'checkEngineeringMaterials',
        );
    }
    public static function getEngineeringMaterialsRead() {
        return array(
                'read',
                'print',
        );
    }
    /**
     * getEngineeringGoodsAdd
     * @author wuyou
     */
    public static function getEngineeringGoodsAdd() {
        return array(
            'add',
            'insert',
            'checkEngineeringGoods'
        );
    }
    public static function getEngineeringGoodsRead() {
        return array(
             'read',
             'print',
        );
    }
    public static function getEngineeringGoodsUpdate() {
        return array(
              'edit',
               'update',
        );
    }
    
    public static function getHelpManualRead() {
        return array(
              'nav',
              'content',
        );
    }

}

?>