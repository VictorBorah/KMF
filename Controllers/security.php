<?php session_start();
/* 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 */
$timeAlloted = 60 * 60 + time();
if ( isset($_COOKIE['xQWAXbnH5WT5RenU']) && isset($_SESSION['APP_USER']) )
{
	date_default_timezone_set('Asia/Kolkata');
	include('dbCon/dbConn.php');
	include('Controllers/common.functions.php');
	
	$uid = $_SESSION['APP_USER'];
	$mobile = $_SESSION['USR_MOBILE'];	
	$_SESSION['APP_USER']=$uid;	
	$_SESSION['USR_MOBILE']=$mobile;
	
	setcookie('xQWAXbnH5WT5RenU',$uid,$timeAlloted,"/",$webRoot,'/; samesite=Lax');	
	setcookie('MBUAGhTnqz5vDFUC',$session_Hash,$timeAlloted,"/",$webRoot,'/; samesite=Lax');
}
else 
{
	header('location:Controllers/logout');
}

?>