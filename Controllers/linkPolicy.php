<?php session_start();

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
  
 
include('../dbCon/dbConn.php');
include('common.functions.php');

$clientID = $_POST['customerID'];
$planID = $_POST['planID'];
$policyNo = $_POST['policyNumber'];
$initialAmount = trim($_POST['initAmount']);

if($initialAmount=="") $instNum = 0;
else $instNum = 1;


$stmt = $coreConn->prepare("INSERT INTO client_plan_map ( policyID,    clientID,    planID )VALUES
                                                       (:policy_ID,   :client_ID,   :plan_ID )");
$stmt->bindParam(':policy_ID', $policyNo);
$stmt->bindParam(':client_ID', $clientID);
$stmt->bindParam(':plan_ID', $planID);
if($stmt->execute()) 
{
	$policyPK = $coreConn->lastInsertId();
	$stmt_2 = $coreConn->prepare("INSERT INTO tbl_transaction_roster ( clientID,    policyID,   policyNumber,  planID,    initialAmount, totalPaidUpAmount,instalmentsNum )VALUES
                                                                   ( :client_ID,   :policy_ID,   :policy_Num,  :plan_ID,   :init_Amt,        :paid_Amt,     :inst_Num   )");
	$stmt_2->bindParam(':client_ID', $clientID);
	$stmt_2->bindParam(':policy_ID', $policyPK);
	$stmt_2->bindParam(':policy_Num', $policyNo);
	$stmt_2->bindParam(':plan_ID', $planID);
	$stmt_2->bindParam(':init_Amt', $initialAmount);
	$stmt_2->bindParam(':paid_Amt', $initialAmount);
	$stmt_2->bindParam(':inst_Num', $instNum);
	if($stmt_2->execute()) 
	echo 1;
	else echo 0;
}
else echo 0;

?>