<?php session_start();

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
  
 
include('../dbCon/dbConn.php');
include('common.functions.php');


$planID = $_GET['pid'];


$planName  = getData($coreConn, "tbl_plans", "planName", " WHERE id='$planID'  " );
$planTypeID  = getData($coreConn, "tbl_plans", "planType", " WHERE id='$planID'  " );
$planAmt  = getData($coreConn, "tbl_plans", "planAmount", " WHERE id='$planID'  " );
$installAmt  = getData($coreConn, "tbl_plans", "installmentAmt", " WHERE id='$planID'  " );
$intAmt  = getData($coreConn, "tbl_plans", "interestAmt", " WHERE id='$planID'  " );
$totalPlanAmt  = getData($coreConn, "tbl_plans", "totalPlanAmt", " WHERE id='$planID'  " );
$intvID  = getData($coreConn, "tbl_plans", "intervalID", " WHERE id='$planID'  " );
$durVal  = getData($coreConn, "tbl_plans", "durationKey", " WHERE id='$planID'  " );

$planType  = getData($coreConn, "plan_types", "planTypeName", " WHERE id='$planTypeID'  " );
$interval  = getData($coreConn, "tbl_plan_payment_intervals", "durationName", " WHERE id='$intvID'  " );
$duration = $durVal." Months";

?>

<div class="row" style="border-top:2px dotted #000;margin:10px 5px 0 0;padding:10px 5px 10px 0;"><b>Plan Details:</b></div>

<div class="row no-padding no-margin">Plan Type: <b><?php echo $planType;?></b></div>
<div class="row no-padding no-margin">Plan Amount: <b><?php echo $planAmt;?></b></div>
<div class="row no-padding no-margin">Interest Amount: <b><?php echo $intAmt;?></b></div>
<div class="row no-padding no-margin">Total Plan Amount: <b><?php echo $totalPlanAmt;?></b></div>
<div class="row no-padding no-margin">Installment Amount: <b><?php echo $installAmt;?></b></div>
<div class="row no-padding no-margin">Pay Interval: <b><?php echo $interval;?></b></div>
<div class="row no-padding no-margin">Duration: <b><?php echo $duration;?></b></div>
