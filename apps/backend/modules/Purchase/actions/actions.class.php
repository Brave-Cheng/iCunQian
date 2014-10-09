<?php

/**
 * @package apps\modules\Purchase
 */

/**
 * Purchase actions.
 *
 * @package    apps
 * @subpackage Purchase
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class PurchaseActions extends DepositActions
{
    /**
     * Execute list action
     *
     * @return void
     *
     * @issue 2678
     */
    public function executeList() {
        $this->purchaseParameters();
        $this->filter();
        if ($this->getRequest()->getMethod() == sfRequest::POST) {
            $this->redirect("Purchase/list?" . util::buildUriQuery("sid", "sort", "sortBy", "pager", "sAccount", "sProductName", "sExpectedRate", "sAmount"));    
        }
    }


    /**
     * Filter query
     *
     * @return void
     *
     * @issue 2678
     */
    protected function filter() {
        $where = ' WHERE 1 ';
        $filter = array();
        $pieces = DepositPersonalProductsPeer::getFieldNames(BasePeer::TYPE_COLNAME);
        $queryFields = array(DepositFinancialProductsPeer::NAME, DepositMembersPeer::NICKNAME);
        $pieces = array_merge($pieces, $queryFields);
        $sql = sprintf('SELECT %s FROM %s', implode(',', $pieces), DepositPersonalProductsPeer::TABLE_NAME);
        $sql .= sprintf(' LEFT JOIN %s ON %s = %s', DepositMembersPeer::TABLE_NAME, DepositMembersPeer::ID, DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID);
        $sql .= sprintf(' LEFT JOIN %s ON %s = %s', DepositFinancialProductsPeer::TABLE_NAME, DepositFinancialProductsPeer::ID, DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID);
        $sql .= $where;

        if ($this->sAccount) {
            $sql .= sprintf(' AND %s LIKE ?', DepositMembersPeer::NICKNAME);
            $filter[] = "%{$this->sAccount}%";
        }
        if ($this->sProductName) {
            $sql .= sprintf(' AND %s LIKE ?', DepositFinancialProductsPeer::NAME);
            $filter[] = "%{$this->sProductName}%";
        }

        if ($this->sExpectedRate) {
            $sql .= parent::createExpectedRateFilterSql(DepositPersonalProductsPeer::EXPECTED_RATE);
        }
        
        if ($this->sAmount) {
            $sql .= parent::createAmountFilterSql(DepositPersonalProductsPeer::AMOUNT);
        }

        if ($this->sid) {
            $sql .= sprintf(' AND %s = ?', DepositPersonalProductsPeer::ID);
            $filter[] = $this->sid;
        }
        
        $sql .= sprintf(" AND %s != '%s'", DepositPersonalProductsPeer::SYNC_STATUS, 2);

        $sql .= $this->querySqlBySort($sql, DepositPersonalProductsPeer::ID, array(DepositPersonalProductsPeer::AMOUNT, DepositPersonalProductsPeer::EXPECTED_RATE, DepositPersonalProductsPeer::BUY_DATE, DepositPersonalProductsPeer::EXPIRY_DATE, DepositPersonalProductsPeer::CREATED_AT, DepositPersonalProductsPeer::UPDATED_AT));
        
        $countSql = str_replace(implode(',', $pieces), 'COUNT(*) AS count ', $sql);
        $this->pager = DBUtil::pagerSql($sql, $filter, 'DepositPersonalProductsPeer', $countSql);
    }

    /**
     * Get purchase parameters
     *
     * @return string
     *
     * @issue 2678
     */
    protected function purchaseParameters() {
        $this->sBankName        = $this->getRequestParameter('sBankName');
        $this->sProfitType      = $this->getRequestParameter('sProfitType');
        $this->sAccount         = $this->getRequestParameter('sAccount');
        $this->sProductName     = $this->getRequestParameter('sProductName');
        $this->sExpectedRate    = $this->getRequestParameter('sExpectedRate');
        $this->sAmount          = $this->getRequestParameter('sAmount');
        $this->commonParameters();
    }

    /**
     * Execute statistics action
     *
     * @return void
     *
     * @issue 2678
     */
    public function executeStatistics() {
        $this->statisticsParameters();
        
        $this->statisticsfilter();
        $this->attributes = DepositAttributesPeer::fetchStandardAdapterList(true);
        array_unshift($this->attributes['profit_type'], util::getMultiMessage('--Select--'));
        if ($this->getRequest()->getMethod() == sfRequest::POST) {
            $this->clearSearch();
        }
    }

    /**
     * Clear search condtion
     *
     * @return void
     *
     * @issue 2678
     */
    protected function clearSearch() {
        switch ($this->sFilter) {
            case 1:
                $this->sProfitType = $this->sAmount = $this->sExpectedRate = '';
                break;
            case 2:
                $this->sBankName = $this->sAmount = $this->sExpectedRate = '';
                break;
            case 3:
                $this->sBankName = $this->sProfitType = $this->sExpectedRate = '';
                break;
            case 4:
                $this->sProfitType = $this->sAmount = $this->sBankName = '';
                break;
            
        }
    }

    /**
     * Get statistics parameters
     *
     * @return string
     *
     * @issue 2678
     */
    protected function statisticsParameters() {
        $this->sFilter = $this->getRequestParameter('sFilter') ? $this->getRequestParameter('sFilter') : 1;
        $this->purchaseParameters();
    }

    /**
     * Filter query
     *
     * @return void
     *
     * @issue 2678
     */
    protected function statisticsfilter() {
        $where = ' WHERE 1 ';
        $filter = array();
        $groupBy = $this->createGroupBy();
        $queryFields = array(
            DepositFinancialProductsPeer::NAME,
        );
        if ($this->queryCount) {
            $queryFields = array_merge($queryFields, $this->queryCount);    
        }

        $sql = sprintf('SELECT %s FROM %s', implode(',', $queryFields), DepositPersonalProductsPeer::TABLE_NAME);

        $sql .= sprintf(' LEFT JOIN %s ON %s = %s', DepositMembersPeer::TABLE_NAME, DepositMembersPeer::ID, DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID);

        $sql .= sprintf(' LEFT JOIN %s ON %s = %s', DepositFinancialProductsPeer::TABLE_NAME, DepositFinancialProductsPeer::ID, DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID);
        $sql .= sprintf(' LEFT JOIN %s ON %s = %s', DepositBankPeer::TABLE_NAME, DepositBankPeer::ID, DepositFinancialProductsPeer::BANK_ID);

        $sql .= $where;

        if ($this->sBankName) {
            $sql .= " AND " . DepositBankPeer::NAME . " LIKE '%" . $this->sBankName . "%'";
        }

        if ($this->sProfitType) {
            $sql .= " AND " . DepositFinancialProductsPeer::PROFIT_TYPE . " = '" . $this->sProfitType . "'";
        }

        if ($this->sExpectedRate) {
            $sql .= parent::createExpectedRateFilterSql(DepositPersonalProductsPeer::EXPECTED_RATE);
        }
        
        if ($this->sAmount) {
            $sql .= parent::createAmountFilterSql(DepositPersonalProductsPeer::AMOUNT);
        }

        $sql .= $groupBy;

        $sql .= $this->querySqlBySort($sql, DepositPersonalProductsPeer::ID);
        
        $countSql = sprintf("SELECT COUNT(1) AS count FROM (%s) total", $sql); 
        $this->pager = DBUtil::pagerSql($sql, $filter, 'DepositPersonalProductsPeer', $countSql, true);
    }

    /**
     * Create group by sql
     *
     * @return void
     *
     * @issue 2678
     */
    protected function createGroupBy() {
        if ($this->sFilter) {
            switch ($this->sFilter) {
                case PushDevicesPeer::FINANCIAL_CYCLE_1:
                    $by = DepositFinancialProductsPeer::BANK_ID;
                    break;
                case PushDevicesPeer::FINANCIAL_CYCLE_2:
                    $by = DepositFinancialProductsPeer::PROFIT_TYPE;
                    break;
                case PushDevicesPeer::FINANCIAL_CYCLE_3:
                    //Range query
                    $by = " ELT(INTERVAL(" . DepositPersonalProductsPeer::AMOUNT . ", 0, 5000, 10000, 20000, 50000, 100000), 'less5000', '5000to10000', '10000to20000', '20000to50000', '50000to100000', 'more100000')";
                    break;
                case PushDevicesPeer::FINANCIAL_CYCLE_4:
                    //Range query
                    $by = " ELT(INTERVAL(" . DepositPersonalProductsPeer::EXPECTED_RATE . ", 0, 3, 5, 10), 'less3', '3to5', '5to10', 'more10')";
                    break;
                default:
                    $this->forward404();
                    break;
            }
            $this->queryCount = array(
                'COUNT('. DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID .') AS members',
                'SUM( ' . DepositPersonalProductsPeer::AMOUNT . ') AS amounts',
            );
            return ' GROUP BY ' . $by . ', ' . DepositFinancialProductsPeer::NAME;
        }
    }

}
