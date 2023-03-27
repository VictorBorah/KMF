<?php session_start();
date_default_timezone_set('Asia/Kolkata');
/* 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 */
  
  
 
include('../dbCon/dbConn.php');
include('common.functions.php');

$mapPK =  $_GET['mapID'];

$coreConn->exec('SET CHARACTER SET utf8');
$coreConn->query("SET NAMES utf8");
/*
echo "Client Name = <b>".$clientName."</b><br>";
echo "Client Mobile = <b>".$mobile."</b>";
*/
?>

<div class="row">
	<div class="col-xs-12">
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">		
		<?php	
			
		$i=0;
		$getPlans = "SELECT * FROM client_plan_map WHERE id='$mapPK'  ";
		foreach ($coreConn->query($getPlans) as $dataRow)
		{			
			$policyID = $dataRow['policyID'];
			$planID = $dataRow['planID'];
			$clientID = $dataRow['clientID'];
			$amt  = getData($coreConn, "tbl_plans", "installmentAmt", " WHERE id='$planID'  " );
			?>
			
			  <div class="panel panel-default" style="padding:5px;">
				<div class="panel-heading" role="tab" id="headingOne">
				  <h4 class="panel-title">
					<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne-<?php echo $mapPK;?>" aria-expanded="true" aria-controls="collapseOne">
					  Policy #<?php echo $policyID;?>
					</a>
				  </h4>
				</div>
				<div id="collapseOne-<?php echo $mapPK;?>" class="panel-collapse collapse <?php /*if($i==0) echo "in";*/ ?>" role="tabpanel" aria-labelledby="headingOne">
				  <div class="panel-body">
					<div class="form-body">
						<form name="cashForm-<?php echo $mapPK;?>" id="cashForm-<?php echo $mapPK;?>"> 
							
							<input type="hidden" name="policyMap_PK" id="policyMap_PK" value="<?php echo $mapPK;?>" />
							<input type="hidden" name="policyID_TB" id="policyID_TB" value="<?php echo $policyID;?>" />
							<input type="hidden" name="planID_TB" id="planID_TB" value="<?php echo $planID;?>" />
							<input type="hidden" name="clentID_TB" id="clentID_TB" value="<?php echo $clientID;?>" />
							
							<div class="form-group"> 
								<label for="amount">Installment Amount</label> 
								<input type="text" class="form-control" id="amount" name="amount" value="<?php echo $amt;?>"  readonly style="background:#bfefff;color:#8c0000;font-weight:bold;">
							</div>

							<div class="form-group"> 
								<label for="amount">No. of Instalments</label> 
								<select class="form-control installmentDD" name="installmentsNum" id="installmentsNum-<?php echo $pk;?>" style="height:47px;">
									<?php
									$str ="Installments";									
									for($i=1;$i<=5;$i++)
									{
										if($i<2) $str ="Installment";
										else $str ="Installments";
										
										?>
										<option value="<?php echo $i;?>"><?php echo $i." ".$str;?> </option>
										<?php 
									}
									?>
									
								</select>
							</div>
							
							<div class="form-group"> 
								<label for="totAmount">Total Amount</label> 
								<input type="text" class="form-control" id="totAmount" name="totAmount" value="<?php echo $amt;?>"  readonly style="background:#ecd5d2;color:#8c0000;font-weight:bold;">
							</div>
							
						</form> 
						
						<button type="button" id="collect-<?php echo $mapPK;?>" class="btn btn-default cashBtn">Collect Cash</button>
					</div>
					
					
				  </div>
				</div>
			  </div>	  
			
			<?php 
			$i++;
		}
		?>
		</div>
	</div>
</div>




