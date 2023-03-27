<?php session_start();
date_default_timezone_set('Asia/Kolkata');
 /* 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 */

 
 
include('../dbCon/dbConn.php');
include('common.functions.php');
include("class.DetectDevice.php");


$webRoot = "billing.kmfassam.xyz";
$mobile = trim( $_POST['mobile'] );
$pwd = trim( $_POST['pwd'] );

$pwdHash=md5(md5($pwd)."VictorBorah@2020");

$deviceThis = "Unknown Device";
$device = new DetectDevice();

if($device->isComputer()) $deviceThis = "Computer";
else
{
	if($device->isMobile()) $deviceThis = "Mobile Device";
	else
	{
		if($device->isTablet()) $deviceThis = "Tablet Device";
		else
		{
			if($device->isBot()) $deviceThis = "Bot";
			else
			{
				if($device->isConsole()) $deviceThis = "Console";
				else $deviceThis = "Unknown Device";
			}
		}
	}	
}




$sql = "SELECT  COUNT(*) FROM tbl_users WHERE tbl_users.mobileNumber='$mobile' and  tbl_users.next_tiger='$pwdHash' and  tbl_users.isBlocked=0 "; 
$userNum = $coreConn->query($sql)->fetchColumn();
if($userNum>0) 
{
	
	$timeAlloted = 60 * 60 + time();
	$dateTimeNow = date('Y-m-d h:i:s');	
	
	
	$uid = getData($coreConn, "tbl_users", "id", " WHERE tbl_users.mobileNumber='$mobile' and  tbl_users.next_tiger='$pwdHash'   " );
	
	$userAgent = $_SERVER['HTTP_USER_AGENT'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$json =  unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$ip"));
	$country = $json["geoplugin_countryName"];
	$session_Hash = md5($dateTimeNow);
	
	$stmt = $coreConn->prepare("INSERT INTO tbl_login_history (uid,session_hash,ip_address,device,browser,login_time,country)VALUES(:uid_this,:this_session,:ip_address,:this_device,:this_browser, :this_time, :this_country)");
	$stmt->bindParam(':uid_this', $uid);
	$stmt->bindParam(':this_session', $session_Hash);
	$stmt->bindParam(':ip_address', $ip);
	$stmt->bindParam(':this_device', $deviceThis);
	$stmt->bindParam(':this_browser', $userAgent);
	$stmt->bindParam(':this_time', $dateTimeNow);
	$stmt->bindParam(':this_country', $country);
	if($stmt->execute()) 
	{
		$_SESSION['APP_USER']=$uid;	
		$_SESSION['USR_MOBILE']=$mobile;	
		setcookie('xQWAXbnH5WT5RenU',$uid,$timeAlloted,"/",$webRoot,'/; samesite=Lax');	
		setcookie('MBUAGhTnqz5vDFUC',$session_Hash,$timeAlloted,"/",$webRoot,'/; samesite=Lax');	
		//send_Welcome_SMS($mobile,$webRoot, $sms_Keyword, $coreConn, $shortName,$instituteName);
		header('location:../?ghikuv=1');
	}
	else
	{
		setcookie("xQWAXbnH5WT5RenU","",time()-3600,"/",$webRoot);
		setcookie("MBUAGhTnqz5vDFUC","",time()-3600,"/",$webRoot);			
		header('location:../../?k=2');
	}
}
else 
{
	$flag=0;
	$sql = "SELECT  COUNT(*) FROM tbl_users WHERE tbl_users.mobileNumber='$mobile' and  tbl_users.next_tiger='$pwdHash' and  tbl_users.isBlocked=1 "; 
	$userNum = $coreConn->query($sql)->fetchColumn();
	if($userNum>0)
	{
		$flag=2;
		session_destroy();
		setcookie("xQWAXbnH5WT5RenU","",time()-3600,"/",$webRoot);
		setcookie("MBUAGhTnqz5vDFUC","",time()-3600,"/",$webRoot);			
		header('location:../../?k=2');
	}
	else
	{
		session_destroy();
		setcookie("xQWAXbnH5WT5RenU","",time()-3600,"/",$webRoot,'/; samesite=Lax');
		setcookie("MBUAGhTnqz5vDFUC","",time()-3600,"/",$webRoot,'/; samesite=Lax');
		header('location:../../?k=0');
	}	
	
	
}






function send_Welcome_SMS($mobile,$web_Root, $sms_Keyword, $dbConnn, $shortName, $clgName)
{
	$timeAlloted = 60 * 30 + time();
	$msg="You logged in to ".$shortName.", Thank you - ".$clgName;
	$smsURL = getData($dbConnn, "tbl_app_settings", "sms_url", " WHERE id='1'   " );
	$smsText=rawurlencode ($msg);	
	$api_key = '25EC0E2E4D4829';
	
	if($mobile!='9954817702')
	$mobile = $mobile.",9954817702";
	
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL, $smsURL);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".$api_key."&campaign=0&routeid=5&type=text&contacts=".$mobile."&senderid=".$sms_Keyword."&msg=".$smsText);
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