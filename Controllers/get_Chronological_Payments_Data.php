<?php session_start(); 
header('Content-Type: application/json');
date_default_timezone_set('Asia/Kolkata');
 
include('../dbCon/dbConn.php');
include('common.functions.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$uid = $_SESSION['APP_USER'];
$dateFrom = getUnixDate($_POST['start_Date']);
$dateTo = getUnixDate($_POST['end_Date']);


/* 
$dateFrom = getUnixDate("21/09/2020");
$dateTo = getUnixDate("24/09/2020");
*/


$dateQuery = " payDate BETWEEN '".$dateFrom."' and '".$dateTo."'";// <= WORKING NOW


$data=array();
$rawDates_ARR = array();
$dates_ARR = array();
$paymentAmt_ARR = array();




$postsNum = $coreConn->query("select count(*) from tbl_client_payments WHERE   ".$dateQuery." and active='1'   ")->fetchColumn();
if($postsNum==0)
{
	//Just Skip - Victor :-)
}
else
{
	$getRecords = "SELECT * FROM tbl_client_payments WHERE  ".$dateQuery." and active='1'  GROUP BY payDate ";
	foreach ($coreConn->query($getRecords) as $dataRow)
	{
		
		$postDate = $dataRow['payDate'];
		array_push($rawDates_ARR,$postDate);		
	}
}


foreach($rawDates_ARR As $pDate)
{
	array_push($dates_ARR,getGenericDate($pDate));
	//echo "POST DATE => ".$postDate."<br>";		
	$getPaymentsSum = "select SUM(amountRecieved)  from tbl_client_payments WHERE payDate='$pDate'    "; 			
	$paymentAmt = $coreConn->query($getPaymentsSum)->fetchColumn();
	array_push($paymentAmt_ARR,$paymentAmt);
}

$data[] = array(		
			'dataLabels'=>$dates_ARR,
			'dataset1'=> $paymentAmt_ARR //Number of Posts Published on that date		
		);
	
/* 
echo "<pre>";
var_dump($data);
echo "</pre>";

 */
echo json_encode($data);


function getUnixDate($k)
{
	$dateARR = explode("/", $k);
	$new_Date = $dateARR[2]."-".$dateARR[1]."-".$dateARR[0];
	return $new_Date;
}

function getGenericDate($k)
{
	$dateARR = explode("-", $k);
	$new_Date = $dateARR[2]."/".$dateARR[1]."/".$dateARR[0];
	return $new_Date;
}




?>