<?php
/**
 * @package batch
 */
define('SF_ROOT_DIR', realpath(dirname(__FILE__) . '/..'));
define('SF_APP', 'backend');
define('SF_ENVIRONMENT', 'prod');
define('SF_DEBUG', false);
require_once(SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'apps' . DIRECTORY_SEPARATOR . SF_APP . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php');

$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();
$connection = Propel::getConnection();

$sql = "SHOW tables";
$statement = $connection->prepareStatement($sql);
$result = $statement->executeQuery();
$tablesName = array();
$modifySqls = array();
while($result->next()){
    $row = $result->getRow();
    $tablesName[] = $row['Tables_in_deposit_trunk'];
}
$count = count($tablesName);


$filedsType = array();
for($i=0;$i<$count; $i++){
    $filedsSql = "SHOW fields FROM " . $tablesName[$i];
    $statement = $connection->prepareStatement($filedsSql);
    $fieldsResult = $statement->executeQuery();
    $modifySql = "ALTER TABLE `". $tablesName[$i] ."` ";
    while($fieldsResult->next()){
        $field = $fieldsResult->getRow();
        $type = explode('(', $field['Type']);
        if( in_array($type[0], array('text', 'longtext', 'varchar', 'char', 'tinytext')) ){
            $modifySql .= "MODIFY COLUMN `". $field['Field'] ."` " . $field['Type'] . " CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ";
            if( $field['Null'] == 'NO' ){
                $modifySql .= " NOT NULL ";
            }else{
                $modifySql .= " NULL ";
            }
            if(!is_null($field['Default'])){
                $modifySql .= " DEFAULT '". $field['Default']."'";
            }
            $modifySql .= "%s ";
        }
    }
    $modifySql .= "DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    $modifySql = str_replace('%s', ',', $modifySql);
    $modifySqls[] = $modifySql;
}
$count = count($modifySqls);
for($i=0; $i<$count; $i++){
    try{
        $statement = $connection->prepareStatement($modifySqls[$i]);
        $result = $statement->executeQuery();
    }catch(Exception $e){
        var_dump($e);
    }

}
?>