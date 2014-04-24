<?php
/**
 * signIn actions - view sign in information
 * @package    oa
 * @subpackage signIn
 * @author     you.wu <you.wu@expacta.com.cn>
 * @issue - 2339 - Sign in to view and statistics
 */
class signInActions extends BaseBackends
{
    public function preExecute(){
        parent::preExecute();
    }
    /**
     * executeIndex - get all signIn information
     * @return page - signIn information list
     * @author you.wu <you.wu@expacta.com.cn>
     * @issue - 2339 - Sign in to view and statistics
     */
    public function executeIndex(){
        $sql = 'SELECT DISTINCT sign_in.* FROM %%sign_in%% AS sign_in 
                LEFT JOIN %%sf_guard_user%% AS sf_guard_user ON (sign_in.sf_guard_user_id = sf_guard_user.id)
                LEFT JOIN %%sf_guard_user_profile%% AS sf_guard_user_profile ON (sf_guard_user .id = sf_guard_user_profile . user_id)
                LEFT JOIN %%project%% as project ON (sign_in.project_id = project.id ) WHERE 1=1';
        $p = array();
        $keyWords = urldecode(trim($this->getRequestParameter('keywords')));
        $keyWords = util::replaceSpecialChar($keyWords);
        $andArray = array();

        $this->startTime = $startTime = $this->getRequestParameter('startTime');
        $this->endTime   = $endTime = $this->getRequestParameter('endTime'); 

        if($this->getRequestParameter('user')){
            $sql .= ' AND sign_in . sf_guard_user_id = ' . $this->getRequestParameter('user');
        }
        if($this->getRequestParameter('project')){
            $sql .= ' AND sign_in . project_id = ' . $this->getRequestParameter('project');
        }
        if(strlen($keyWords)){
            $andArray[] = " CONCAT(sf_guard_user_profile .  last_name, sf_guard_user_profile .  first_name) LIKE ?";
            $p[] = "%$keyWords%";
            $andArray [] = ' project . name LIKE ?';
            $p[] = "%$keyWords%";
        }
        if($andArray){
            $sql .= ' AND (' . implode(' OR ', $andArray) . ')';
        }

        if($startTime && !$endTime){
            $sql .= " AND DATE_FORMAT(sign_in.sign_in_time, '%Y-%m-%d') >= '$startTime'";

        }elseif($endTime && !$startTime){
            $sql .= " AND DATE_FORMAT(sign_in.sign_in_time, '%Y-%m-%d') <= '$endTime'";
        }elseif($startTime && $endTime){
            if($startTime > $endTime) $this->title = 1;
            $sql .= " AND DATE_FORMAT(sign_in.sign_in_time, '%Y-%m-%d') BETWEEN  '$startTime' AND  '$endTime' ";
        }
        if(!$this->hasRequestParameter("sortBy")){
            $sql .= " ORDER BY sign_in . sign_in_time DESC";
        }
        $tapMap = array(
            '%%sign_in%%' => SignInPeer::TABLE_NAME,
            '%%sf_guard_user%%' => sfGuardUserPeer::TABLE_NAME,
            '%%sf_guard_user_profile%%' => sfGuardUserProfilePeer::TABLE_NAME,
            '%%project%%' => ProjectPeer::TABLE_NAME
        );
        $sql = strtr($sql, $tapMap);
        //$countSql = str_replace('DISTINCT sign_in.*', 'COUNT(DISTINCT sign_in.id) as count', $sql);
        $this->pager = DBUtil::execSql($sql, $p, 'SignInPeer');
        $this->projects = SignInPeer::getAllProjects();
        $this->users = SignInPeer::getAllUsers();
        $this->keywords = $this->getRequestParameter('keywords');
        //statistics
        $tmp = array();
        foreach($this->pager as $signInList){
            $tmp[$signInList->getSfGuardUserId()]['projectName'][] = $signInList->getProjectInfo()->getName();
            $addressArr = explode(',', $signInList->getAddress());
            $tmp[$signInList->getSfGuardUserId()]['address'][] = $addressArr[0].$addressArr[1]; 

        }
        $this->signListStatisticsData = $tmp;
    }

    public function executeStatisticList(){
        $this->user = sfGuardUserPeer::retrieveByPk($this->getRequestParameter('userId'));
        $this->forward404Unless($this->user);
        $this->startTime = $startTime = $this->getRequestParameter('startTime');
        $this->endTime   = $endTime = $this->getRequestParameter('endTime'); 
        $sql = 'SELECT sign_in.* FROM %%sign_in%% AS sign_in 
                WHERE sign_in.sf_guard_user_id = ?';
        $p = array($this->user->getId());
        
        if($this->getRequestParameter('project')){
            $sql .= ' AND sign_in . project_id = ' . $this->getRequestParameter('project');
        }

        if($startTime && !$endTime){
            $sql .= " AND DATE_FORMAT(sign_in.sign_in_time, '%Y-%m-%d') >= '$startTime'";
        }elseif($endTime && !$startTime){
            $sql .= " AND DATE_FORMAT(sign_in.sign_in_time, '%Y-%m-%d') <= '$endTime'";
        }elseif($startTime && $endTime){
            if($startTime > $endTime) $this->title = 1;
            $sql .= " AND DATE_FORMAT(sign_in.sign_in_time, '%Y-%m-%d') BETWEEN  '$startTime' AND  '$endTime' ";
        }
        if(!$this->hasRequestParameter("sortBy")){
            $sql .= " ORDER BY sign_in . sign_in_time DESC";
        }
        $sql = str_replace('%%sign_in%%', SignInPeer::TABLE_NAME, $sql);
        $this->pager = DBUtil::pagerSql($sql, $p, 'SignInPeer');
        $this->projects = SignInPeer::getAllProjects();
    }
}
