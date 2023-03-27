<?php session_start();
date_default_timezone_set('Asia/Kolkata');
/* 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 */
  
  
 
include('../dbCon/dbConn.php');
include('common.functions.php');

$uid = $_SESSION['APP_USER'];
$policyPK  =  $_POST['policyPK_TB'];






$coreConn->exec('SET CHARACTER SET utf8');
$coreConn->query("SET NAMES utf8");


$today = date('Y-m-d');

$stts = 0;
$sql_1 = "UPDATE client_plan_map  SET  
			active=?,		
			cancelledOnDate=?		
			WHERE id = ? ";
$stmt_1= $coreConn->prepare($sql_1);
if($stmt_1->execute([
			$stts, 				
			$today, 				
			$policyPK							
			]))

echo 1;
else echo 0;




?>