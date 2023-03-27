<?php session_start();

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
//$plansARR = $_POST['clientPlans'];

$coreConn->exec('SET CHARACTER SET utf8');
$coreConn->query("SET NAMES utf8");

if($sex=="") $sex='M';



//UPLOAD PROFILE PHOTO
$timeNow = time();
$file_URL = "";
define ("DocumentsDir","../ClientPhotos/");
if(!file_exists($_FILES['userDP']['tmp_name']) || !is_uploaded_file($_FILES['userDP']['tmp_name']))
{  
	//$file_URL = getData($connCloudApp, "tbl_clients", "photo_File", " WHERE id='$uid'   " );
	$file_URL = "";
}
else
{
	$name = $_FILES["userDP"]["name"];
	$ext = end((explode(".", $name)));
	$file_URL=md5($timeNow.$name.$uid."ProfilePicture").".".$ext;
	
	
		
	$result1 = move_uploaded_file($_FILES['userDP']['tmp_name'], DocumentsDir."/$file_URL");
}




$stmt = $coreConn->prepare("INSERT INTO tbl_clients ( clentName,      clientMobile,    clientAddress ,   clientEmail,   photo_File,          sex )VALUES
                                                   (:client_Name,   :client_Mobile,   :client_Address , :client_Email,  :client_Photo,   :client_Sex  )");
$stmt->bindParam(':client_Name', $clientName);
$stmt->bindParam(':client_Mobile', $mobile);
$stmt->bindParam(':client_Address', $address);
$stmt->bindParam(':client_Email', $email);
$stmt->bindParam(':client_Photo', $file_URL);
$stmt->bindParam(':client_Sex', $sex);
if($stmt->execute())
{
	 $clientID = $coreConn->lastInsertId();
	 /*
	 foreach($plansARR As $x)
	 {
		$uniqueID = get_Unique_ID();
		$stmt_2 = $coreConn->prepare("INSERT INTO client_plan_map ( policyID,   clientID,      planID )VALUES
                                                                ( :policy_ID,  :client_ID,   :plan_ID  )");
		$stmt_2->bindParam(':policy_ID', $uniqueID); 
		$stmt_2->bindParam(':client_ID', $clientID); 
		$stmt_2->bindParam(':plan_ID', $x); 
		if($stmt_2->execute())
			echo 1;
		else echo 0;
		
		
	 }
	 */
	 echo 1;
}
else echo 0;





function get_Unique_ID()
{
	sleep(1);
	$number = rand(100,100000);
	$t=time();
	$random = $number.''.$t;
	return $random;
}






?>