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
$clientName  = trim($_POST['clientName']);
$mobile  = trim($_POST['clientMobile']);
$email  = trim($_POST['clientEmail']);
$address  = trim($_POST['clientAddress']);
$sex  = trim($_POST['clientSex']);



$clientID  = trim($_POST['pk']);

//UPLOAD PROFILE PHOTO
$timeNow = time();
$file_URL = "";
define ("DocumentsDir","../ClientPhotos/");
if(!file_exists($_FILES['userDP']['tmp_name']) || !is_uploaded_file($_FILES['userDP']['tmp_name']))
{  
	$file_URL = getData($coreConn, "tbl_clients", "photo_File", " WHERE id='$clientID'   " );	
}
else
{
	$name = $_FILES["userDP"]["name"];
	$ext = end((explode(".", $name)));
	$file_URL=md5($timeNow.$name.$uid."ProfilePicture").".".$ext;
	
	
		
	$result1 = move_uploaded_file($_FILES['userDP']['tmp_name'], DocumentsDir."/$file_URL");
}





$coreConn->exec('SET CHARACTER SET utf8');
$coreConn->query("SET NAMES utf8");





$sql_1 = "UPDATE tbl_clients  SET  
			clentName=?,
			clientMobile=?,
			clientEmail=?,						
			clientAddress=?,						
			photo_File=?,						
			sex=?						
			WHERE id = ? ";
$stmt_1= $coreConn->prepare($sql_1);
if($stmt_1->execute([
			$clientName, 
			$mobile, 				
			$email,
			$address,			
			$file_URL,			
			$sex,			
			$clientID							
			]))

echo 1;
else echo 0;

?>