<?php session_start();
date_default_timezone_set('Asia/Kolkata');
/* 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 */
  
  
 
include('../dbCon/dbConn.php');
include('common.functions.php');

$policyPK =  $_GET['pk'];
$uid = $_SESSION['APP_USER'];
$coreConn->exec('SET CHARACTER SET utf8');
$coreConn->query("SET NAMES utf8");


$clientID  = getData($coreConn, "client_plan_map", "clientID", " WHERE id='$policyPK'  " );
$clientName  = getData($coreConn, "tbl_clients", "clentName", " WHERE id='$clientID'  " );
$clientMobile  = getData($coreConn, "tbl_clients", "clientMobile", " WHERE id='$clientID'  " );
$clientPhotoFile  = getData($coreConn, "tbl_clients", "photo_File", " WHERE id='$clientID'  " );


$policyID  = getData($coreConn, "client_plan_map", "policyID", " WHERE id='$clientID'  " );
$planID  = getData($coreConn, "client_plan_map", "planID", " WHERE id='$clientID'  " );




$planName  = getData($coreConn, "tbl_plans", "planName", " WHERE id='$clientID'  " );
$planAmount  = getData($coreConn, "tbl_plans", "collectionAmt", " WHERE id='$clientID'  " );
$planInterval_ID  = getData($coreConn, "tbl_plans", "intervalID", " WHERE id='$clientID'  " );
$planDuration  = (int) getData($coreConn, "tbl_plans", "durationKey", " WHERE id='$clientID'  " );
$planInterval  = getData($coreConn, "tbl_plan_payment_intervals", "durationName", " WHERE id='$planInterval_ID'  " );

if($planDuration<1) $planDuration = $planDuration." Year";
else $planDuration = $planDuration." Years";

$photoURL = "ClientPhotos/".$clientPhotoFile;
if($clientPhotoFile == "") $photoURL = "images/male.jpg";
else $photoURL = "ClientPhotos/".$clientPhotoFile;


?>

<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="row">
			    <div class="col-xs-12 col-md-5 col-lg-4">
				<img src ="<?php echo $photoURL;?>" class="img-responsive"  />
				</div>
				<div class="col-xs-12 col-md-7 col-lg-8">
					<?php 
					
					echo "Client: <b style='color:#8c0046;font-size:16px;'>".$clientName."</b><br>";
					echo "Mobile: <b>".$clientMobile."</b><br>";
					echo "Policy Number: <b>".$policyID."</b><br>";
					echo "Plan Name: <b>".$planName."</b><br>";
					echo "Plan Amount: <b>".$planAmount."</b><br>";
					echo "Duration: <b>".$planDuration."</b><br>";
					echo "Interval: <b>".$planInterval."</b><br>";
					
					?>
				</div>
			</div>
		</div>
		
		
		<div class="panel panel-default">
		<div class="tables">
				<table class="table table-bordered datatable" style="width:100%;"> 
					<thead> 
						<tr> 
							<th width="10%">#</th> 
							<th>Payment Date</th>
							<th >Plan Amount</th>
							<th>Installments</th>
							<th >Payment Amount</th>							
						</tr>
					</thead>
					<tbody> 											
						<?php 
						$i=1;
						$dates_ARR = array();
						$getDurations = "SELECT * FROM tbl_client_payments WHERE policyID='$policyID' GROUP BY  payDate ";
						foreach ($coreConn->query($getDurations) as $dataRow)
						array_push($dates_ARR, $dataRow['payDate']);
						

						foreach ($dates_ARR as $dt)
						{							
							$findItem = "select count(*) from tbl_client_payments  WHERE payDate='$dt'  "; 			
							$itemNum = $coreConn->query($findItem)->fetchColumn();
							
							$amt = $itemNum * $planAmount;
							$totalAmount = number_format((float)$amt, 2, '.', '');
							
							
							?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo getGenericDate($dt);?></td>
								<td><?php echo $planAmount;?></td>
								<td><?php echo $itemNum;?></td>								
								<td><?php echo $totalAmount;?></td>								
							</tr>
							<?php 
							$i++;
						}
						?>													
					</tbody> 
				</table> 
			</div>
		</div>
	</div>
</div>





<?php 


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








