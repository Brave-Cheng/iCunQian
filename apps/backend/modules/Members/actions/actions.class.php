<?php

/**
 * @package apps\modules\Members
 */

/**
 * Members actions.
 *
 * @package    apps
 * @subpackage Members
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class MembersActions extends DepositActions
{
    /**
     * Executes index action
     *
     * @return void
     *
     * @issue 2705
     */
    public function executeIndex() {
        $this->membersParameters();
        $this->filter();
        if ($this->getRequest()->getMethod() == sfRequest::POST) {
            $this->redirect("Members/index?" . util::buildUriQuery("sid", "sort", "sortBy", "pager", "smobile", "snickname", 'sregistrationcomplete'));    
        }
    }

    /**
     * filter action
     *
     * @return void
     *
     * @issue 2705
     */
    public function filter() {
        $filter = array();
        $pieces = DepositMembersPeer::getFieldNames(BasePeer::TYPE_COLNAME);
        $where = ' WHERE 1';

        $sql = sprintf(
            'SELECT %s FROM %s ',
            implode(',', $pieces),
            DepositMembersPeer::TABLE_NAME
        );

        $sql .= $where;

        if ($this->smobile) {
            $sql .= sprintf(" AND %s LIKE ?", DepositMembersPeer::MOBILE);
            $filter[] = "%" . $this->smobile . "%";
        }

        if ($this->snickname) {
            $sql .= sprintf(" AND %s LIKE ?", DepositMembersPeer::NICKNAME);
            $filter[] = "%" . $this->snickname . "%";
        }


        if ($this->sid) {
            $sql .= sprintf(' AND %s = ?', DepositMembersPeer::ID);
            $filter[] = $this->sid;
        }
        
        switch ($this->sregistrationcomplete) {
            case DepositMembersPeer::YES:
                $sql .= sprintf(" AND %s = '%s'", DepositMembersPeer::REGISTRATION_COMPLETE, DepositMembersPeer::REGISTRATION_STEP_3);
                break;
            case DepositMembersPeer::NO:
                $sql .= sprintf(" AND %s < '%s'", DepositMembersPeer::REGISTRATION_COMPLETE, DepositMembersPeer::REGISTRATION_STEP_3);
                break;
        }

        $sql .= $this->querySqlBySort($sql, sprintf("CONVERT(%s USING gbk)", DepositMembersPeer::NICKNAME), array(
            DepositMembersPeer::MOBILE,
            DepositMembersPeer::EMAIL,
            DepositMembersPeer::MOBILE_ACTIVE,
            DepositMembersPeer::EMAIL_ACTIVE,
        ), sprintf(" %s %s", DepositMembersPeer::REGISTRATION_TIME, 'DESC'));

        $countSql = str_replace(implode(',', $pieces), 'COUNT(*) AS count ', $sql);
        $this->pager = DBUtil::pagerSql($sql, $filter, 'DepositMembersPeer', $countSql);
    }

    /**
     * Execute members page parameters
     *
     * @return void
     *
     * @issue 2705
     */
    protected function membersParameters() {
        $this->smobile = $this->getRequestParameter('smobile');
        $this->snickname = $this->getRequestParameter('snickname');
        $this->sregistrationcomplete = $this->getRequestParameter('sregistrationcomplete');
        $this->commonParameters();
    }

}
