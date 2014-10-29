<?php

/**
 * @package apps\backend\modules\Station\actions
 */

/**
 * Station actions.
 *
 * @package    apps
 * @subpackage Station
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class StationActions extends DepositActions
{
    /**
     * Executes index action
     *
     * @return void
     *
     * @issue 2706
     */
    public function executeIndex() {
        $this->stationParameters();
        $this->filter();
        if ($this->getRequest()->getMethod() == sfRequest::POST) {
            $this->redirect("Station/index?" . util::buildUriQuery("sid", "sort", "sortBy", "pager", "sNickname", "sTitle")); 
        }
    }

    /**
     * filter action
     *
     * @return void
     *
     * @issue 2706
     */
    public function filter() {
        $filter = array();
        $pieces = DepositMembersStationNewsPeer::getFieldNames(BasePeer::TYPE_COLNAME);
        $where = ' WHERE 1';

        $sql = sprintf(
            'SELECT %s FROM %s ',
            implode(',', $pieces),
            DepositMembersStationNewsPeer::TABLE_NAME
        );

        $sql .= sprintf(" LEFT JOIN %s ON %s = %s ", DepositMembersPeer::TABLE_NAME, DepositMembersPeer::ID, DepositMembersStationNewsPeer::DEPOSIT_MEMBERS_ID);
        $sql .= sprintf(" LEFT JOIN %s ON %s = %s ", DepositStationNewsPeer::TABLE_NAME, DepositStationNewsPeer::ID, DepositMembersStationNewsPeer::DEPOSIT_STATION_NEWS_ID);

        $sql .= $where;

        if ($this->sNickname) {
            $sql .= sprintf(" AND %s LIKE ?", DepositMembersPeer::NICKNAME);
            $filter[] = "%" . $this->sNickname . "%";
        }

        if ($this->sTitle) {
            $sql .= sprintf(" AND %s LIKE ?", DepositStationNewsPeer::TITLE);
            $filter[] = "%" . $this->sTitle . "%";
        }


        if ($this->sid) {
            $sql .= sprintf(' AND %s = ?', DepositMembersStationNewsPeer::ID);
            $filter[] = $this->sid;
        }

        $sql .= $this->querySqlBySort($sql, DepositMembersStationNewsPeer::ID, array(
            DepositMembersPeer::MOBILE,
            DepositMembersPeer::EMAIL,
            DepositMembersPeer::MOBILE_ACTIVE,
            DepositMembersPeer::EMAIL_ACTIVE,
        ));
        $countSql = str_replace(implode(',', $pieces), 'COUNT(*) AS count ', $sql);
        $this->pager = DBUtil::pagerSql($sql, $filter, 'DepositMembersStationNewsPeer', $countSql);
    }

    /**
     * Execute station letter
     *
     * @return void
     *
     * @issue 2706
     */
    public function executeSendLetter() {
        if ($this->getUser()->hasAttribute('sendMessageType')) {
            $sendMessageTypeSession = $this->getUser()->getAttribute('sendMessageType');
        } else {
            if ($this->getRequest()->getMethod() != sfRequest::POST) {
                $this->forward404();
            }    
        }

        $this->sendMessageType = $this->getRequestParameter('postType') ? $this->getRequestParameter('postType') : $this->getRequestParameter('sendMessageType');

        if (!$this->sendMessageType) {
            $this->sendMessageType = $sendMessageTypeSession;
            $this->getUser()->getAttributeHolder()->remove('sendMessageType');
        }

        if (!in_array($this->sendMessageType, DepositMembersStationNewsPeer::getFormPostType())) {
            $this->forward404();
        }

        $this->selectedHuman = $this->getRequestParameter('selectIds[]') ? $this->getRequestParameter('selectIds[]') :  explode(',', $this->getRequestParameter('personList'));
        
        $this->selectedUsers = implode(',', $this->selectedHuman);

        $this->users = DepositMembersPeer::retrieveByPKs($this->selectedHuman);
    }

    /**
     * Execute doSendLetter
     *
     * @return void
     *
     * @issue 2706
     */
    public function executeDoSendLetter() {
        if ($this->getRequest()->getMethod() != sfRequest::POST) {
            $this->forward404();    
        }

        $sendMessageType    = $this->getRequestParameter('sendMessageType');
        $title              = $this->getRequestParameter('title');
        $content            = $this->getRequestParameter('content');

        switch ($sendMessageType) {
            case DepositMembersStationNewsPeer::FORM_POST_WHOLE:
                    $personLists = array_keys(DepositMembersPeer::getMemberLists());
                    array_shift($personLists);
                break;
            case DepositMembersStationNewsPeer::FORM_POST_SELECTED:
                    $personLists = explode(',', $this->getRequestParameter('personList'));
                break;
        }
        $this->setFlash('sendMessageType', $sendMessageType);
        $this->setFlash('title', $title);
        $this->setFlash('content', $content);
        $this->setFlash('users', DepositMembersPeer::retrieveByPKs($personLists));

        $stationNews = DepositStationNewsPeer::addStationNews($title, $content);

        $persons = array(
            'stationNewsId' => $stationNews->getId(),
            'persons'       => $personLists,
        );

        shell_exec("/usr/local/php5.2/bin/php  /data/testsites/deposit/devel/batch/cronjobs/SendStationLetters.php " . DepositStationNewsPeer::SEND_LETTER . " " . base64_encode(json_encode($persons)));        

        // shell_exec("/usr/local/php5.2/bin/php  /data/testsites/deposit/trunk/batch/cronjobs/SendStationLetters.php " . DepositStationNewsPeer::SEND_LETTER . " " . base64_encode(json_encode($persons)));
        
        // shell_exec('D:\upupw\PHP5\php.exe D:\Usr\Local\Web\Deposit\trunk\batch\cronjobs\SendStationLetters.php ' . DepositStationNewsPeer::SEND_LETTER . " " . base64_encode(json_encode($persons)));

        $this->getUser()->setAttribute('sendMessageType', $sendMessageType);
        $this->redirect("Station/SendLetter?rmsg=0");
        // $this->forward('Station', 'SendLetter');
    }

    /**
     * Execute doSendLetter
     *
     * @return void
     *
     * @issue 2706
     */
    public function handleErrorDoSendLetter() {

        $this->setFlash('sendMessageType', $this->getRequestParameter('sendMessageType'));

        // var_dump($this->getRequest()->getErrors());

        $this->forward('Station', 'SendLetter');
    }

    /**
     * Validate doSendLetter
     *
     * @return void
     *
     * @issue 2706
     */
    public function validateDoSendLetter() {

        $personLists = $this->getRequestParameter('personList');
        $sendMessageType = $this->getRequestParameter('sendMessageType');
        if ($sendMessageType == DepositMembersStationNewsPeer::FORM_POST_SELECTED) {
            if (!$personLists) {
                $this->getRequest()->setError('sendMessageType', util::getMultiMessage('Specify the recipient can not be empty!'));
                return false;
            }

            if (strpos($personLists, ',') === false) {
                if (!is_numeric($personLists)) {
                    $this->getRequest()->setError('sendMessageType', util::getMultiMessage('Specify the recipient can not be modified!'));
                    return false;
                }
            } else {
                foreach (explode(',', $personLists) as $pk) {
                    if (!is_numeric($pk)) {
                        $this->getRequest()->setError('sendMessageType', util::getMultiMessage('Specify the recipient can not be modified!'));
                        return false;
                    }
                    if (is_null(DepositMembersPeer::retrieveByPk($pk))) {
                        $this->getRequest()->setError('sendMessageType', util::getMultiMessage('Specify the recipient can not be modified!'));
                        return false;
                    }
                }
            }
        }

        return true;
    }


    /**
     * Get station parameters
     *
     * @return void
     *
     * @issue 2706
     */
    protected function stationParameters() {
        $this->sNickname    = $this->getRequestParameter('sNickname');
        $this->sTitle       = $this->getRequestParameter('sTitle');
        $this->commonParameters();
    }
}
