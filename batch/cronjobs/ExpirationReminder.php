<?php

/**
 * @package batch\cronjobs
 */

/**
 * @copyright Expacta Inc
 * @author  brave.cheng <brave.cheng@expacta.com.cn>
 */
define('SF_ROOT_DIR', realpath(dirname(dirname(__FILE__)) . '/..'));
define('SF_APP', 'backend');
define('SF_ENVIRONMENT', 'prod');
define('SF_DEBUG', false);

define('DEADLINE', "请注意，您购买的理财产品：%s 快要到期了，请及时处理。要实现您的财富连续增值吗？请看看我们的其他推荐吧。");
define("EXCEP", "不存在满足条件的理财产品！");

$priv = array(
    'deadline',
    'send'
);

// set magic_quotes_runtime to off
ini_set('magic_quotes_runtime', 'Off');

require_once(SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'apps' . DIRECTORY_SEPARATOR . SF_APP . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php');

$startTime = date('Y-m-d H:i:s');

$argv = $_SERVER['argv'];

$jumpOut = isset($argv[1]) ? $argv[1] : false;

if ($jumpOut === false || !in_array($jumpOut, $priv)) {
    showHelp();
}

//set memory limit
set_time_limit(0);
ini_set ('memory_limit', '256M');  

//connection database
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

 
try {
    switch ($jumpOut) {
        case 'deadline':
                checkDeadlineProducts();
            break;
        case 'send':
                pushDeadlineMessage();
            break;
    }

} catch (Exception $exc) {
    echo $exc->getMessage();
    die();
}

/**
 * Check deadline 
 *
 * @return void
 *
 * @issue 2662
 */
function checkDeadlineProducts() {
    $queryFields = array(
        DepositFinancialProductsPeer::NAME,
        DepositFinancialProductsPeer::ID . ' AS PRODUCT_ID',
        DepositMembersDevicePeer::ID
    );
    $sql = sprintf("SELECT %s FROM %s", implode(',', $queryFields), DepositPersonalProductsPeer::TABLE_NAME);
    $sql .= sprintf(' LEFT JOIN %s ON %s = %s', DepositMembersDevicePeer::TABLE_NAME, DepositMembersDevicePeer::DEPOSIT_MEMBERS_ID, DepositPersonalProductsPeer::DEPOSIT_MEMBERS_ID);
    $sql .= sprintf(' LEFT JOIN %s ON %s = %s', DepositFinancialProductsPeer::TABLE_NAME, DepositFinancialProductsPeer::ID, DepositPersonalProductsPeer::DEPOSIT_FINANCIAL_PRODUCTS_ID);
    $sql .= " WHERE 1";
    $sql .= sprintf(" AND %s = '%s'", DepositMembersDevicePeer::IS_VALID, DepositMembersPeer::YES);
    $sql .= sprintf(" AND %s = '%s'", DepositPersonalProductsPeer::IS_VALID, DepositMembersPeer::YES);
    $sql .= sprintf(" AND (UNIX_TIMESTAMP(%s) - UNIX_TIMESTAMP(NOW())) < 259200 ", DepositFinancialProductsPeer::DEADLINE);

    $sql .= sprintf(" GROUP BY %s", DepositFinancialProductsPeer::NAME);
    $connection = Propel::getConnection();
    $statement = $connection->prepareStatement($sql);
    $resultset = $statement->executeQuery();
    $exist = false;
    while ($resultset->next()) {
        $exist = true;
        $rows = $resultset->getRow();
        $message = sprintf(DEADLINE, $rows['NAME']);
        PushMessagesPeer::messageEnqueue($message, $rows['ID'], PushMessagesPeer::TYPE_ACOUNT, $rows['PRODUCT_ID']);
    }
    if ($exist == false) {
        throw new Exception(EXCEP);
    }
}

/**
 * Push message before 3 deadline 
 *
 * @return void
 *
 * @issue 2662
 */
function pushDeadlineMessage() {
    $sql = sprintf("SELECT %s FROM %s", implode(',', PushMessagesPeer::getFieldNames(BasePeer::TYPE_COLNAME)), PushMessagesPeer::TABLE_NAME);
    $sql .= sprintf(' LEFT JOIN %s ON %s = %s', DepositMembersDevicePeer::TABLE_NAME, DepositMembersDevicePeer::ID, PushMessagesPeer::PUSH_DEVICES_ID);
    $sql .= sprintf(' LEFT JOIN %s ON %s = %s', DepositMembersPeer::TABLE_NAME, DepositMembersPeer::ID, DepositMembersDevicePeer::DEPOSIT_MEMBERS_ID);
    $sql .= " WHERE 1";
    $sql .= sprintf(" AND %s = '%s'", DepositMembersPeer::IS_LOGIN, DepositMembersPeer::YES);
    $sql .= sprintf(" AND %s = '%s'", PushMessagesPeer::TYPE, PushMessagesPeer::TYPE_ACOUNT);
    $sql .= sprintf(" AND %s = '%s'", PushMessagesPeer::STATUS, PushMessagesPeer::STATUE_QUEUED);
    $connection = Propel::getConnection();
    $statement = $connection->prepareStatement($sql);
    $resultset = $statement->executeQuery();
    $exist = false;
    $error = array();
    $i = 0;
    while ($resultset->next()) {
        $exist = true;
        $rows = $resultset->getRow();
        $memberDevice = DepositMembersDevicePeer::validateMemberDevice($rows['PUSH_DEVICES_ID']);
        $result = util::pushApnsMessage($rows['ID'], $memberDevice->getToken(), $rows['MESSAGE'], 'sandbox', 1, 'default', array('acme1'=> $rows['DEPOSIT_FINANCIAL_PRODUCTS_ID']));

        if (is_null($result->getStatus()) && is_null($result->getFeedback())) {
            PushMessagesPeer::setPushedMessageFeedback($rows['ID'], time(), PushMessagesPeer::STATUS_DELIVERED);
        }
        if ($result->getStatus()) {
            PushMessagesPeer::setPushedMessageFeedback($rows['ID'], time(), PushMessagesPeer::STATUS_FAILED, $result->getStatus());
            $error[] = sprintf('bacase %s', $result->getStatus());

        }
        if ($result->getFeedback()) {
            $memberDevice->setIsValid(DepositMembersPeer::NO);
            $memberDevice->save();
            $error[] = sprintf('Push feedback: %s', $result->getFeedback());
        }
        $i++;
    }
    if ($error) {
        $str = sprintf("Total send %s, fail %s", $i, count($error));
        throw new Exception($str);
    }
    if ($exist == false) {
        throw new Exception(EXCEP);
    }
}


/**
 * show help
 * 
 * @issue 2662
 * 
 * @return void
 */
function showHelp() {
    echo " usage: php ExpirationReminder.php [reminder] 
    [reminder] - if the value is 'deadline', which regularly check the condition of financial products.
    [reminder] - if the valid is 'send', which equipment to meet the conditions of the push message." . PHP_EOL;
    die();
}
