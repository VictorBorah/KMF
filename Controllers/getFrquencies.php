<?php session_start();

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
  
 
include('../dbCon/dbConn.php');
include('common.functions.php');

$plan = false;
$duration = (int) $_GET['period'];//in months
$planID = (int) $_GET['planID'];//PLAN ID for editing

if($planID==0 || $planID == "0")
	$planStr = "";
else 
{
	$plan = true;
	$freqNow  = getData($coreConn, "tbl_plans", "intervalID", " WHERE id='$planID'  " );
}

/*
1=>Daily
2=>Monthly
3=>Quarterly
4=>Half-Yearly
5=>Annually

*/

if($duration <=2 ) $options = array(1,2);
if($duration == 3) $options = array(1,2,3);
if($duration == 4) $options = array(1,2);
if($duration == 5) $options = array(1,2);
if($duration == 6) $options = array(1,2,3,4);
if($duration == 7) $options = array(1,2);
if($duration == 8) $options = array(1,2);
if($duration == 9) $options = array(1,2,3);
if($duration == 10) $options = array(1,2);
if($duration == 11) $options = array(1,2);
if($duration == 12) $options = array(1,2,3,4,5);



?>
<option value="">Select Frequency</option>
<?php 
/* 
$getIntervals = "SELECT * FROM tbl_plan_payment_intervals WHERE active='1'   ".$str;
foreach ($coreConn->query($getIntervals) as $dataRow)
*/
 
foreach($options As $key) 
{
	if($plan)
	{
		if($key==$freqNow)$selected = "selected";
		else  $selected = "";
	}
	else
	{
		if($key==2) $selected = "selected";
		else  $selected = "";
	}
	
	
	$durationName  = getData($coreConn, "tbl_plan_payment_intervals", "durationName", " WHERE id='$key'  " );
?>
	<option <?php echo $selected;?> value="<?php echo $key;?>"><?php echo $durationName;?></option>
<?php 
}
?>	