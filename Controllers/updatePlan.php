<?php session_start();

/* 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 */
  
  
 
include('../dbCon/dbConn.php');
include('common.functions.php');

$uid = $_SESSION['APP_USER'];
$pk = $_POST['pk'];
$planName  = trim($_POST['planName']);
$planAmount  = trim($_POST['planAmt']);
$intervalID  = trim($_POST['intervalID']);
$durKey  = trim($_POST['durationID']);
$planType  = (int)$_POST['planType'];
$interestAmt  = trim($_POST['interestAmt']);
$installmentAmt  = trim($_POST['installmentAmt']);
$totPlanValue  = trim($_POST['planVal']);


$coreConn->exec('SET CHARACTER SET utf8');
$coreConn->query("SET NAMES utf8");





$sql_1 = "UPDATE tbl_plans  SET  
			planName=?,
			planType=?,
			planAmount=?,
			installmentAmt=?,
			interestAmt=?,
			totalPlanAmt=?,
			intervalID=?,						
			durationKey=?						
			WHERE id = ? ";
$stmt_1= $coreConn->prepare($sql_1);
if($stmt_1->execute([
			$planName, 
			$planType, 				
			$planAmount,
			$installmentAmt,			
			$interestAmt,			
			$totPlanValue,			
			$intervalID,			
			$durKey,				
			$pk							
			]))

echo 1;
else echo 0;

?>