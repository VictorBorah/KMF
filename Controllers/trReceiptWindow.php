<?php session_start();

/* 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 */
  
  
 
include('../dbCon/dbConn.php');
include('common.functions.php');


$coreConn->exec('SET CHARACTER SET utf8');
$coreConn->query("SET NAMES utf8");


$policyPK =  $_GET['policyNum'];



$getPolicyData = "SELECT * FROM client_plan_map WHERE policyID='$policyPK' ";
foreach ($coreConn->query($getPolicyData) as $dataRow)
{
	$policyPK = $dataRow['id'];
	$cid = $dataRow['clientID'];
	$policyNum = $dataRow['policyID'];													
	$planPK = $dataRow['planID'];
	$active = (int) $dataRow['active'];
	$initialAmt  = (float) getData($coreConn, "tbl_transaction_roster", "initialAmount", " WHERE policyNumber='$policyNum'  " );
	$totPaidAmt  = getData($coreConn, "tbl_transaction_roster", "totalPaidUpAmount", " WHERE policyNumber='$policyNum'  " );
	$installmentsNum  = getData($coreConn, "tbl_transaction_roster", "instalmentsNum", " WHERE policyNumber='$policyNum'  " );

	$planName  = getData($coreConn, "tbl_plans", "planName", " WHERE id='$planPK'  " );
	$planTypeID  = getData($coreConn, "tbl_plans", "planType", " WHERE id='$planPK'  " );
	$intrvlID  = getData($coreConn, "tbl_plans", "intervalID", " WHERE id='$planPK'  " );
	$durationKey  = getData($coreConn, "tbl_plans", "durationKey", " WHERE id='$planPK'  " );
	$planAmount  = getData($coreConn, "tbl_plans", "planAmount", " WHERE id='$planPK'  " );
	$installAmount  = getData($coreConn, "tbl_plans", "installmentAmt", " WHERE id='$planPK'  " );
	
	$clientName  = getData($coreConn, "tbl_clients", "clentName", " WHERE id='$cid'  " );
	$clientMobile  = getData($coreConn, "tbl_clients", "clientMobile", " WHERE id='$cid'  " );
	$intrvlStr  = getData($coreConn, "tbl_plan_payment_intervals", "durationName", " WHERE id='$intrvlID'  " );

	$activeStts = ($active == 1) ? "Active" : "Closed";
	$planTypeStr = ($planTypeID == 1) ? "Investment Plan" : "Loan Plan";
	$accountAmount = number_format($totPaidAmt, 2);
}

?>

<div id="PrintWin" style="width:100%;padding:10px;">
	<div style="width:98%;margin:0 auto;padding:10px;border:1px solid #000;">
		<div style="width:100%;text-align:center;font-weight:bold;font-size:16px;">KUNJA MICRO FINANCE</div>
		<div style="width:100%;text-align:center;font-weight:bold;font-size:12px;">JAMUGURIHAT</div>
		<div style="width:100%;text-align:center;font-weight:bold;font-size:12px;">DIST:SONITPUR,PIN:784 180</div>
		<div style="width:100%;text-align:center;font-weight:bold;font-size:12px;">ASSAM</div>
		<div style="width:100%;text-align:center;font-weight:bold;font-size:12px;margin-top:15px;">RECEIPT</div>
		<div style="width:100%;text-align:RIGHT;font-weight:bold;font-size:11px;margin-top:10px;">Receipt Date:<?php echo date('d/m/Y');?></div>
		
		<div style="width:100%;text-align:justify;font-size:11px;margin:10px 0;padding:15px 0;border-top:2px dotted #000;border-bottom:2px dotted #000;">
			<div style="width:50%;float:left;">
				<div style="width:100%;">Policy Number:&nbsp;<b><?php echo $policyPK ;?></b></div>
				<div style="width:100%;">Customer Name:&nbsp;<b><?php echo $clientName ;?></b></div>
				<div style="width:100%;">Customer Mobile:&nbsp;<b><?php echo $clientMobile ;?></b></div>
				<div style="width:100%;">Plan Name:&nbsp;<b><?php echo $planName ;?></b></div>
				<div style="width:100%;">Plan Type:&nbsp;<b><?php echo $planTypeStr ;?></b></div>
				<div style="width:100%;">Pay Interval:&nbsp;<b><?php echo $intrvlStr ;?></b></div>
				<div style="width:100%;">Plan Duration:&nbsp;<b><?php echo $durationKey ;?> Months</b></div>
			</div>
			
			
			<div style="width:50%;float:right;text-align:right;">
				<div style="width:100%;">Plan Amount:&nbsp;<b>Rs.<?php echo $planAmount ;?></b></div>
				<div style="width:100%;">Initial Amount Paid:&nbsp;<b>Rs.<?php echo $initialAmt ;?></b></div>
				<div style="width:100%;">Installment Amount:&nbsp;<b>Rs.<?php echo $installAmount ;?></b></div>
				<div style="width:100%;">Current Balance:&nbsp;<b>Rs.<?php echo $accountAmount ;?></b></div>
			</div>
			<div style="clear:both;"></div>
		</div>
		
		<div style="width:100%;margin-top:15px;"><b>Transactions</b></div>
		
		<div style="width:100%;margin-top:15px;">
		<table class="table table-bordered" style="width:100%;">
				<thead>
					<tr>
						<th><div align="center">SL</div></th>
						<th><div align="center">Date</div></th>
						<th><div align="center">Amount</div></th>
						<th><div align="center">Installments</div></th>
						<th><div align="center">Total Paid</div></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i=1;
					$totalAmt=0;
					$getPaymentData = "SELECT DATE(payDate) As pDate ,SUM(amountRecieved) AS TotAmt , count(payDate) As InstallmentsNum FROM tbl_client_payments WHERE policyID='$policyNum' GROUP BY payDate";
					foreach ($coreConn->query($getPaymentData) as $dataRow)
					{
						$dt = date_DMY($dataRow['pDate']);
						$pAmt = (float)$dataRow['TotAmt'];
						$totalAmt = $totalAmt + $pAmt;
						
						$paidAmount = number_format($pAmt, 2);
						
						?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $dt;?></td>
							<td><div align="right">Rs.<?php echo $installAmount;?></div></td>
							<td><div align="center"><?php echo $dataRow['InstallmentsNum'];?></div></td>
							<td><div align="right">Rs.<?php echo $paidAmount;?></div></td>
						</tr>
						<?php 
						$i++;
					}
					
					$curBalance = $totalAmt + $initialAmt;
					$initial_Amount = number_format($initialAmt, 2);
					$current_Balance = number_format($curBalance, 2);
					?>
					<tr>
						<td colspan="4"><div align="right"><b>Initial Amount</b></div></td>
						<td><div align="right"><b>Rs.<?php echo $initial_Amount;?></b></div></td>
					</tr>
					<tr>						
						<td colspan="4"><div align="right"><b>Current Balance</b></div></td>
						<td><div align="right"><b>Rs.<?php echo $current_Balance;?></b></div></td>
					</tr>
				</tbody>
			</table>
		</div>
		
	</div>
</div>