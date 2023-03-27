<?php session_start();

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
  
 
include('../dbCon/dbConn.php');
include('common.functions.php');


$cid = $_GET['cid'];


$custName  = getData($coreConn, "tbl_clients", "clentName", " WHERE id='$cid'  " );
$custMobile  = getData($coreConn, "tbl_clients", "clientMobile", " WHERE id='$cid'  " );
$custEmail  = getData($coreConn, "tbl_clients", "clientEmail", " WHERE id='$cid'  " );
$custAddress  = getData($coreConn, "tbl_clients", "clientAddress", " WHERE id='$cid'  " );
$custPicURL  = getData($coreConn, "tbl_clients", "photo_File", " WHERE id='$cid'  " );

?>
<div class="row no-padding no-margin"><img src="ClientPhotos/<?php echo $custPicURL;?>" width="120" height="120" /></div>
<div class="row no-padding no-margin">Customer: <b><?php echo $custName;?></b></div>
<div class="row no-padding no-margin">Mobile: <b><?php echo $custMobile;?></b></div>
