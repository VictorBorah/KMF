<?php session_start();
date_default_timezone_set('Asia/Kolkata');
 /* 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 */
  
$today = date('Y-m-d');
$uid = $_SESSION['APP_USER']; 

include('../dbCon/dbConn.php');
include('common.functions.php');

$pk=1;//Settings Table Row-PK
$iCount = 0;
$exe_Stts = false;

$mapPK  = trim($_POST['policyMap_PK']);
$policyID  = trim($_POST['policyID_TB']);
$planD  = trim($_POST['planID_TB']);
$clientID  = trim($_POST['clentID_TB']);


$amt  = trim($_POST['amount']);
$installment  = trim($_POST['installmentsNum']);

$coreConn->exec('SET CHARACTER SET utf8');
$coreConn->query("SET NAMES utf8");

$totalAmt = (float)($amt * $installment);
$clientName  =  getData($coreConn, "tbl_clients", "clentName", " WHERE id='$clientID'  " );
$clientMobile  =  getData($coreConn, "tbl_clients", "clientMobile", " WHERE id='$clientID'  " );
$oldSMS_Count  =  (int)getData($coreConn, "tbl_settings", "sentSMS_Count", " WHERE id='$pk'  " );
$use_SMS  =  (int)getData($coreConn, "tbl_settings", "use_SMS_Service", " WHERE id='$pk'  " );

//Fetch Roster
$prev_Instlmnts  = (int) getData($coreConn, "tbl_transaction_roster", "instalmentsNum", " WHERE policyNumber='$policyID'  " );
$prev_Amount  = (float) getData($coreConn, "tbl_transaction_roster", "totalPaidUpAmount", " WHERE policyNumber='$policyID'  " );
$new_Amount  = $totalAmt + $prev_Amount;
$new_Instlmnt_Num  = $prev_Instlmnts + $installment;


for($i=0;$i<$installment;$i++)
{
	$exe_Stts = false;
	$stmt = $coreConn->prepare("INSERT INTO tbl_client_payments ( clientID,   policyID,    planID,     payDate ,   amountRecieved,   collectorID  )VALUES
                                                               (:client_ID,  :policy_ID,   :plan_ID,   :pay_Date ,    :amt_Rcvd,    :collector_ID  )");
	$stmt->bindParam(':client_ID', $clientID);
	$stmt->bindParam(':policy_ID', $policyID);
	$stmt->bindParam(':plan_ID', $planD);
	$stmt->bindParam(':pay_Date', $today);
	$stmt->bindParam(':amt_Rcvd', $amt);
	$stmt->bindParam(':collector_ID', $uid);
	if($stmt->execute())		
		{
			$iCount++;
			$exe_Stts = true;
		}
	else $exe_Stts = false;
}

if($exe_Stts)
{
		$sql_2 = " UPDATE tbl_transaction_roster SET totalPaidUpAmount = :amt_Now,instalmentsNum = :new_Instlmnts_Num  WHERE policyNumber = :policy_Number";
		$params = array(
					 ':amt_Now'					=> $new_Amount,
					 ':new_Instlmnts_Num'		=> $new_Instlmnt_Num,					
					 ':policy_Number'			=> $policyID					
				   );


		$stmt_2 = $coreConn->prepare($sql_2);               
		if($stmt_2->execute($params)) 
			$exe_Stts = true;
		else $exe_Stts = false;
			
}


if($exe_Stts) echo 1;
else echo 0;



/*
if($iCount == $installment) 
{
	$msg_Body = "Hello ".$clientName.", your Payment of INR ".$totalAmt." has been successful- Kunja Micro-Fin";
	
	if($use_SMS==1)
	{
		if(send_OTP($msg_Body, $clientMobile,$coreConn ))
		{
			$stmt_2 = $coreConn->prepare("INSERT INTO tbl_sms_messages ( smsMobile,       smstext,  sentOn   )VALUES
																	 (:client_Mobile,  :sms_Text, :sent_Date    )");
			$stmt_2->bindParam(':client_Mobile', $clientMobile);
			$stmt_2->bindParam(':sms_Text', $msg_Body);
			$stmt_2->bindParam(':sent_Date', $today);
			if($stmt_2->execute())	
			{
				$newSMS_Count = $oldSMS_Count +1;
				
				$sql_3 = "UPDATE tbl_settings  SET  
							sentSMS_Count=?											
							WHERE id = ? ";
				$stmt_3= $coreConn->prepare($sql_3);
				$stmt_3->execute([
							$newSMS_Count, 									
							$pk							
				]);
			}
		}
	}
	
	
	
	echo 1;
}
else echo 0;
*/





function send_OTP($msg, $mobile, $appConn)
{
	
	$timeAlloted = 60 * 30 + time();
	
	$sms_Keyword  =  getData($appConn, "tbl_settings", "sms_Keyword", " WHERE id='1'  " );
	$smsURL  =  getData($appConn, "tbl_settings", "sms_URL", " WHERE id='1'  " );	
	
	$smsText=rawurlencode ($msg);	
	$api_key = '25EC0E2E4D4829';	
	

	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL, $smsURL);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".$api_key."&campaign=0&routeid=23&type=text&contacts=".$mobile."&senderid=".$sms_Keyword."&msg=".$smsText);
	$response = curl_exec($ch);	
	
	if(curl_errno($ch))
	{
		//echo 'Curl error: ' . curl_error($ch);
		return false;
	}
	else 		
	{
		curl_close($ch);		
		return true;
	}
	
	
}















?>