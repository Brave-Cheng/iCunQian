<?php

/**
 * @package apps\backend\modules\Feedback\actions
 */

/**
 * Feedback actions.
 *
 * @package    apps
 * @subpackage Feedback
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class FeedbackActions extends DepositActions
{
    /**
     * Execute List action
     *
     * @return void
     *
     * @issue 2641
     */
    public function executeList() {
        parent::feedbackParameters();
        $this->_filter();
        if ($this->getRequest()->getMethod() == sfRequest::POST) {
            $this->redirect("Feedback/list?" . util::buildUriQuery("sid", "sort", "sortBy", "pager", "semail"));    
        }
    }

    /**
     * Execute filter action
     *
     * @return void
     *
     * @issue 2641
     */
    private function _filter() {
        $where = ' WHERE 1 ';
        $filter = array();
        $pieces = DepositFeedbackPeer::getFieldNames(BasePeer::TYPE_COLNAME);
        $sql = sprintf(
            'SELECT %s FROM %s',
            implode(',', $pieces),
            DepositFeedbackPeer::TABLE_NAME
        );

        if ($this->sNickname) {
            $leftJoin = sprintf(
                ' LEFT JOIN %s ON %s = %s',
                DepositMembersPeer::TABLE_NAME,
                DepositMembersPeer::ID,
                DepositFeedbackPeer::DEPOSIT_MEMBERS_ID
            );
            $sql .= sprintf('%s %s AND %s like ? ', $leftJoin, $where, DepositMembersPeer::NICKNAME);
            $filter[] = "%" . $this->sNickname . "%";
        } else {
            $sql .= $where;
        }

        if ($this->sid) {
            $sql .= sprintf(' AND %s = ?', DepositFeedbackPeer::ID);
            $filter[] = $this->sid;
        }

        if ($this->sEmail) {
            $sql .= sprintf(' AND %s LIKE ?', DepositFeedbackPeer::EMAIL);
            $filter[] = "%" . $this->sEmail . "%";
        }

        $sql .= $this->querySqlBySort($sql, DepositFeedbackPeer::ID);
        
        $countSql = str_replace(implode(',', $pieces), 'COUNT(*) AS count ', $sql);
        $this->pager = DBUtil::pagerSql($sql, $filter, 'DepositFeedbackPeer', $countSql);

    }
}
