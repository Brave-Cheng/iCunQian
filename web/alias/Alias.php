<?php

/**
 * @package web\alias
 */

// define symfony constant
// define('SF_ROOT_DIR', realpath(dirname(dirname(__FILE__)) . '/..'));
define('SF_ROOT_DIR',    realpath(dirname(__FILE__).'/../..'));
define('SF_APP', 'backend');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG', true);

error_reporting(ALL);
// initialize symfony
require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

set_time_limit(0);
ini_set ('memory_limit', '256M');

$args = isset($_REQUEST['get']) ? trim($_REQUEST['get'])  : '';
try {
    //setup database
    $databaseManager = new sfDatabaseManager();
    $databaseManager->initialize();
    $rs = null;
    //create a connection
    $connection = Propel::getConnection();

    switch ($args) {
        case 'update_status':
            // need to add status, process_status to deposit_financial_products
            $rs = updateOldbankStatus();
            break;
        case 'short_name':
            $rs = importBankShortName();   
            break;
        case 'name':
            $rs = importBankName();  
            break;
        case 'part_name':
            $rs = importBankPortionName();
            break;
        case 'update_bankid':
            DepositFinancialProductsPeer::updateOldBankId();
            break;
        default:
            die('Nothing is here!');
            break;
    }
    echo "<pre>";
    var_dump($rs);
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    // die();
}

/**
 * Import bank short name
 *
 * @return null
 *
 * @issue 2614
 */
function updateOldbankStatus() {
    global $connection;
    $error = array();
    $query = "SELECT id, deposit_request_financial_id FROM deposit_financial_products";
    $statement = $connection->prepareStatement($query);
    $resultset = $statement->executeQuery();

    while ($resultset->next()) {
        try {
            $rows = $resultset->getRow();

            $find = "SELECT status FROM deposit_request_financial WHERE id = '" . $rows['deposit_request_financial_id'] . "'";

            $statement = $connection->prepareStatement($find);
            $findResult = $statement->executeQuery();
            while ($findResult->next()) {
                $findRow = $findResult->getRow();

                $sql = "UPDATE `deposit_financial_products` SET `status` = '" . $findRow['status'] . "' WHERE `deposit_financial_products`.`id` = " . $rows['id'] . ";";
                
                $state = $connection->prepareStatement($sql);
                $rs = $state->executeQuery();
            }
            
        } catch (Exception $e) {
            $error[] = $e->getMessage();
        }
    }
    return $error;
}



/**
 * Import bank short name
 *
 * @param string $name short name
 *
 * @return null
 *
 * @issue 2614
 */
function importBankShortName($name = 'short_name') {
    global $connection;
    $error = array();
    $query = "SELECT id, {$name} FROM deposit_bank";
    $statement = $connection->prepareStatement($query);
    $resultset = $statement->executeQuery();

    while ($resultset->next()) {
        try {
            $rows = $resultset->getRow();
            $time = date('Y-m-d H:i:s');
            $sql = "INSERT INTO deposit_bank_alias( id, deposit_bank_id, name, created_at, updated_at ) 
                    VALUES (
                    '',  '" . $rows['id'] . "',  '" . $rows[$name] . "', '" . $time . "', '"  . $time . "'
                    )";
            $state = $connection->prepareStatement($sql);
            $rs = $state->executeQuery();
        } catch (Exception $e) {
            $error[] = $e->getMessage();
        }
    }
    return $error;
}

/**
 * Import bank name
 *
 * @param string $name bank name
 *
 * @return null
 * 
 * @issue 2614
 */
function importBankName($name = 'name') {
    global $connection;
    $error = array();
    $query = "SELECT id, {$name} FROM deposit_bank";
    $statement = $connection->prepareStatement($query);
    $resultset = $statement->executeQuery();

    while ($resultset->next()) {
        try {
                $rows = $resultset->getRow();
                $time = date('Y-m-d H:i:s');
                $sql = "INSERT INTO deposit_bank_alias( id, deposit_bank_id, name, created_at, updated_at ) 
                        VALUES (
                        '',  '" . $rows['id'] . "',  '" . $rows[$name] . "', '" . $time . "', '"  . $time . "'
                        )";
                $state = $connection->prepareStatement($sql);
                $rs = $state->executeQuery();
        } catch (Exception $e) {
            $error[] = $e->getMessage();
        }
    }
    return $error;
    
}

/**
 * Import bank portion name
 *
 * @param string $name bank name
 *
 * @return null
 *
 * @issue 2614
 */
function importBankPortionName($name = 'name') {
    global $connection;
    $error = array();
    $query = "SELECT id, {$name} FROM deposit_bank";
    $statement = $connection->prepareStatement($query);
    $resultset = $statement->executeQuery();

    while ($resultset->next()) {
        try {
            $rows = $resultset->getRow();
            $portionName = substr($rows[$name], 0, -3);
            $time = date('Y-m-d H:i:s');
            $sql = "INSERT INTO deposit_bank_alias( id, deposit_bank_id, name, created_at, updated_at ) 
                    VALUES (
                    '',  '" . $rows['id'] . "',  '" . $portionName . "', '" . $time . "', '"  . $time . "'
                    )";
            $state = $connection->prepareStatement($sql);
            $rs = $state->executeQuery();
        } catch (Exception $e) {
            $error[] = $e->getMessage();
        }
    }

    return $error;
}