<?php session_start();

/* 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/


 /* 
include('../dbCon/dbConn.php');
include('common.functions.php');

$coreConn->exec('SET CHARACTER SET utf8');
$coreConn->query("SET NAMES utf8");
*/

function get_Unique_Policy_Number($coNN)
{
	
	while(1)
	{
		$number = rand(100,100000);
		$t=time();
		$policyNumber = $number.''.$t;
		
		
		$dataNum = $coNN->query("select count(*) from tbl_policyNo_temp WHERE policyNo='$policyNumber'  ")->fetchColumn(); 
		if($dataNum>0)
		{
			sleep(1);
			continue;
		}
		else 
		{
			$stmt = $coNN->prepare("INSERT INTO tbl_policyNo_temp (policyNo)VALUES(:policy_No )");
			$stmt->bindParam(':policy_No', $policyNumber);				
			if($stmt->execute()) 
			{				
				break;			
			}
		}
	}
	
	return $policyNumber;
}

//echo get_Unique_Policy_Number($coreConn);


?>