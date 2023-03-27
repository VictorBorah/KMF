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


$stmt = $coreConn->prepare("INSERT INTO tbl_plans (planName,    planType,   planAmount,     installmentAmt, interestAmt,   totalPlanAmt,  intervalID , durationKey )VALUES
                                                 (:plan_Name,  :plan_Type,  :plan_Amt,    :collection_Amt,  :int_Amt,  :tot_PlanAmt, :interval_ID , :duration_Key  )");
$stmt->bindParam(':plan_Name', $planName);
$stmt->bindParam(':plan_Type', $planType);
$stmt->bindParam(':plan_Amt', $planAmount);
$stmt->bindParam(':collection_Amt', $installmentAmt);
$stmt->bindParam(':int_Amt', $interestAmt);
$stmt->bindParam(':tot_PlanAmt', $totPlanValue);
$stmt->bindParam(':interval_ID', $intervalID);
$stmt->bindParam(':duration_Key', $durKey);
if($stmt->execute()) echo 1;
else echo 0;












?>