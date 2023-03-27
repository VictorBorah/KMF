<?php session_start();

/* 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 */
  
  
 
include('../dbCon/dbConn.php');
include('common.functions.php');


$coreConn->exec('SET CHARACTER SET utf8');
$coreConn->query("SET NAMES utf8");

$pk  = trim($_GET['pk']);
$today=date('Y-m-d');
$status = 0;

$sql_1 = "UPDATE client_plan_map  SET  
			terminatedOnDate=?,
			active=?					
			WHERE id = ? ";
$stmt_1= $coreConn->prepare($sql_1);
if($stmt_1->execute([
			$today,					
			$status,				
			$pk							
			]))

echo 1;
else echo 0;

?>