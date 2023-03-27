<?php  
$today = date('Y-m-d');
$getAllClients = "select count(*) from tbl_clients  WHERE active='1'  "; 			
$clientNum = $coreConn->query($getAllClients)->fetchColumn();

$getAllPayments = "select count(*) from tbl_client_payments    "; 			
$paymentNum = $coreConn->query($getAllPayments)->fetchColumn();

$getPaymentsSum = "select SUM(amountRecieved) from tbl_client_payments WHERE payDate='$today'    "; 			
$paymentAmt = $coreConn->query($getPaymentsSum)->fetchColumn();

$getTotalPaymentsSum = "select SUM(amountRecieved) from tbl_client_payments    "; 			
$grandPaymentAmt = $coreConn->query($getTotalPaymentsSum)->fetchColumn();

?>


<div class="custom-widgets">
	   <div class="row-one">
			<div class="col-md-4 ">
				<div class="stats-left ">
					<h5>Total</h5>
					<h4 style="font-size:1.2em">Clients</h4>
				</div>
				<div class="stats-right">
					<label><?php echo $clientNum;?></label>
				</div>
				<div class="clearfix"> </div>	
			</div>
			
			
			<div class="col-md-4  states-mdl">
				<div class="stats-left">
					<h5>Today's</h5>
					<h4 style="font-size:1.2em">Collection</h4>
				</div>
				<div class="stats-right">
					<label><?php echo $paymentAmt;?></label>
				</div>
				<div class="clearfix"> </div>	
			</div>
			
			
			<div class="col-md-4   states-thrd">
				<div class="stats-left">
					<h5>Total</h5>
					<h4 style="font-size:1.2em">Collection</h4>
				</div>
				<div class="stats-right">
					<label><?php echo $grandPaymentAmt;?></label>
				</div>
				<div class="clearfix"> </div>	
			</div>
			<div class="clearfix"> </div>	
		</div>
	</div>