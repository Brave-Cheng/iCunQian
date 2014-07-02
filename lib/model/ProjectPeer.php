<?php

/**
 * Subclass for performing query and update operations on the 'project' table.
 *
 * 
 *
 * @package lib.model
 */
class ProjectPeer extends BaseProjectPeer {

    const INNER_PROJECT = 1;
    const OUTSOURCE_PROJECT = 2;
    const TENDERING_PHASE = 1;
    const PROJECT_PHASE = 2;
    const PROJECT_STOP = 3; //project stop
    const PROJECT_NOT_END = 0;
    const TENDER_PREPARE = 1;
    const COMPETITIVE_TENDER = 2;
    const WIN_THE_BIDDING = 3;

    public static function getTypes() {
        $types = array(
            self::INNER_PROJECT => '公司项目',
            self::OUTSOURCE_PROJECT => '外包项目'
        );
        return $types;
    }

    /**
     * get alll project phases
     * @return array
     * @issue <2326>
     * @modified brave
     */
    public static function getPhases() {
        return array(
            self::TENDERING_PHASE => '投标中',
            self::PROJECT_PHASE => '正式展开',
            self::PROJECT_STOP => '已经终止',
        );
    }

    public static function getTenderingStatus() {
        $status = array(
            self::TENDER_PREPARE => '准备中',
            self::COMPETITIVE_TENDER => '竞标中',
            self::WIN_THE_BIDDING => '中标',
        );
        return $status;
    }

    public static function getYesorNo() {
        $array = array(
            0 => '无',
            1 => '有'
        );
        return $array;
    }

    public static function completeWay() {
        $ways = array(
            1 => '突然中止',
            2 => '项目完成'
        );
        return $ways;
    }

    public static function getProjectMember($userId, $projectId) {
        $criteria = new Criteria();
        $criteria->add(ProjectMemberPeer::PROJECT_ID, $projectId);
        $criteria->add(ProjectMemberPeer::SF_GUARD_USER_ID, $userId);
        $userobj = ProjectMemberPeer::doSelectOne($criteria);
        return $userobj;
    }

    public static function checkIsInProject($userId, $projectId) {
        $userobj = self::getProjectMember($userId, $projectId);
        if (count($userobj)) {
            return true;
        }
        return false;
    }

    public static function checkUserRole($userId, $projectId) {
        $userobj = self::getProjectMember($userId, $projectId);
        if ($userobj) {
            return $userobj->getProjectRoleId();
        }
        return 0;
    }

    public static function getProjectMemberOtherRoleName($userId, $projectId) {
        $userobj = self::getProjectMember($userId, $projectId);
        if ($userobj) {
            return $userobj->getOtherRoleName();
        }
        return '';
    }

    public static function getProjectIsEnds() {
        $user = sfContext::getInstance()->getUser()->getGuardUser();
        $userId = $user->getId();
        $c = new Criteria();
        $c->addJoin(ProjectMemberPeer::PROJECT_ID, ProjectPeer::ID);
        $c->add(ProjectMemberPeer::SF_GUARD_USER_ID, $userId);
        $c->add(ProjectPeer::PHASE, ProjectPeer::PROJECT_PHASE);
        $c->add(ProjectPeer::TYPE, ProjectPeer::INNER_PROJECT);
        $c->add(ProjectPeer::IS_PROJECT_END, ProjectPeer::PROJECT_NOT_END);
        $projects = ProjectPeer::doSelect($c);
        return $projects;
    }

    /**
     * Get all the project information of users
     * @param int $userId
     * @issue 2337
     * @author brave
     */
    public static function getUserCreateAndBelongProjects($userId) {
        $criteria = new Criteria();
        $criteria->addJoin(ProjectMemberPeer::PROJECT_ID, ProjectPeer::ID, Criteria::LEFT_JOIN);
        $criteria->add(ProjectPeer::IS_PROJECT_END, self::PROJECT_NOT_END);
        $criteria1 = $criteria->getNewCriterion(ProjectMemberPeer::SF_GUARD_USER_ID, $userId);
        $criteria2 = $criteria->getNewCriterion(ProjectPeer::ID, null, Criteria::ISNOTNULL);
        $criteria1->addAnd($criteria2);
        $criteria3 = $criteria->getNewCriterion(ProjectPeer::CREATOR, $userId);
        $criteria3->addOr($criteria1);
        $criteria->addAnd($criteria3);
        $criteria->setDistinct();
        return ProjectPeer::doSelect($criteria);
    }

    /**
     * 
     * @param int $projectId
     * @param string $role
     * @issue 2337
     * @author brave
     */
    public static function getProjectRoleUser($projectId, $role) {
        $criteria = new Criteria();
        $criteria->add(ProjectMemberPeer::PROJECT_ID, $projectId);
        $criteria->add(ProjectMemberPeer::PROJECT_ROLE_ID, $role);
        $projectMember = ProjectMemberPeer::doSelectOne($criteria);
        if ($projectMember && $projectMember->getSfGuardUser()->getIsActive()) {
            return $projectMember->getSfGuardUser();
        }
    }

}
