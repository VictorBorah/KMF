<?php include("Controllers/security.php");

if( isset($_GET['bki9ux']) ) 
	{
		$policyPK = trim($_GET['bki9ux']);
		if(countData($coreConn, "client_plan_map", " WHERE id='$policyPK' "))
		{
			$getPolicyData = "SELECT * FROM client_plan_map WHERE id='$policyPK' ";
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
		}
		else header('location:policyData');
	}
else header('location:policyData');




?>
<!DOCTYPE HTML>
<html>
<head>
<title>View Account Status | Kunja Micro Finance</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="img/favicon.png" type="image/x-icon" />
<meta name="keywords" content="Kunja Micro Finance, Kunja,Lila Das, Lila" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<link rel="stylesheet" type="text/css" href="Plugins/waitMe/waitMe.css" >			
<link rel="stylesheet" type="text/css"  href="Plugins/noty/lib/noty.css"/>                                          
<link rel="stylesheet" type="text/css"  href="Plugins/noty/lib/themes/mint.css"/>                                          
<link rel="stylesheet" type="text/css"  href="Plugins/noty/lib/themes/nest.css"/>  
<link rel="stylesheet" type="text/css"  href="Plugins/uploadPreview/uploadPreview.css"  />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/jspanel4@4.10.2/dist/jspanel.css" rel="stylesheet">
<link rel="stylesheet" type="text/css"  href="css/custom.css"/> 
<script src="js/jquery-1.10.2.min.js"></script> 
</head> 
<body>
   <div class="page-container">  
	<div class="left-content">
	   <div class="inner-content">		
			<div class="header-section">						
				<div class="top_menu">					
					<div STYLE="position:absolute;color:#fff;font-weight:bold;margin-top:20px;margin-left:30px;">KUNJA MICRO FINANCE</div>
					
					<div class="profile_details_left">					
					<ul class="nofitications-dropdown">							
						
						<li class="dropdown note pull-right" style="margin-right:20px;">
								<a href="#" class="logoutBtn" data-toggle="dropdown" aria-expanded="false"><i class="lnr lnr-power-switch"></i></a>
									
							</li>		   							   		
							<div class="clearfix"></div>	
					</ul>
					
					</div>
					<div class="clearfix"></div>	
				</div>						
				<div class="clearfix"></div>
			</div>
					
			<div class="outter-wp" style="min-height:800px;">

			  <div class="sub-heard-part">
			   <ol class="breadcrumb m-b-0">
					<li><a href="./">Home</a></li>
					<li class="active">Account Status</li>
				</ol>
			   </div>

				<div class="graph-visual tables-main">					
						<div class="graph">
							<div class="block-page">
								
								<div class="row">									
									<input type="hidden" name="policy_NUM" id="policy_NUM" value="<?php echo $policyNum;?>" />
									<input type="hidden" name="cust_Name" id="cust_Name" value="<?php echo $clientName;?>" />
									<div class="col-xs-12 col-md-6">
										<div class="row">Policy No: <b><?php echo $policyNum;?></b></div>							
										<div class="row">Customer: <b><?php echo $clientName;?></b></div>							
										<div class="row">Mobile: <b><?php echo $clientMobile;?></b></div>							
										<div class="row">Plan: <b><?php echo $planName;?></b></div>							
										<div class="row">Plan Type: <b><?php echo $planTypeStr;?></b></div>							
										<div class="row">Pay Interval: <b><?php echo $intrvlStr;?></b></div>							
										<div class="row">Duration: <b><?php echo $durationKey;?>&nbsp;Months</b></div>							
									</div>								
									<div class="col-xs-12 col-md-6 txt-rt">
										<div class="row">Plan Amount: <b>Rs.<?php echo $planAmount;?></b></div>	
										<div class="row">Installment Amount: <b>Rs.<?php echo $installAmount;?></b></div>	
										<div class="row">Current Balance: <b style="color:#d90000;">Rs.<?php echo $accountAmount;?></b></div>	
										<div class="row"><button id="rpt-<?php echo $policyNum;?>" class="btn btn-info openRcptWindow" style="margin-right:0;">Generate Receipt</button></div>
									</div>
								</div>												
							</div>						
						</div>					
				</div>
				
				<div class="graph-visual tables-main">
					<div class="graph">
						<div class="block-page">
							<div class="row">
								<b>Transactions</b>
							</div>
							<div class="row">
								<table class="table table-bordered datatable" style="width:100%;">
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
											<td><?php echo $i;?></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td><div align="right"><b>Initial Amount</b></div></td>
											<td><div align="right"><b>Rs.<?php echo $initial_Amount;?></b></div></td>
										</tr>
										<tr>
											<td><?php echo $i+1;?></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td><div align="right"><b>Current Balance</b></div></td>
											<td><div align="right"><b>Rs.<?php echo $current_Balance;?></b></div></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
									
			<footer>
			   <p>&copy;&nbsp;Kunja Micro Finance | <?php echo date('Y');?></p>
			</footer>
		
		</div>
	</div>
				

	<div class="sidebar-menu">
		<header class="logo">
		<a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="index.php"> <span id="logo"> <h1>KUNJA MF</h1></span></a> 
		</header>
			<div style="border-top:1px solid rgba(69, 74, 84, 0.7)"></div>
			
							<div class="down">	
									  <a href="./"><img src="img/Kunja_Micro_Finance_Logo.png" width="120" height="120"></a>
									  <a href="./"><span class=" name-caret">Lila Das</span></a>
									 <p>CEO, Kunja Micro Finance</p>
									<ul>
									<li style="display:none;"><a class="tooltips" href="index.html"><span>Profile</span><i class="lnr lnr-user"></i></a></li>
										<li><a class="tooltips" href="#"><span>Settings</span><i class="lnr lnr-cog"></i></a></li>
										<li><a class="tooltips logoutBtn" href="#"><span>Log out</span><i class="lnr lnr-power-switch"></i></a></li>
										</ul>
									</div>
							   <!--//down-->
								<div class="menu">
									<?php include('Menu/menu.php'); ?>
								</div>
							  </div>
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
							
							
							
							$(".sidebar-icon").trigger('click');


							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
							});
							
							
							
							
							</script>

<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="Plugins/validate/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<script src="Plugins/mojs/mo.min.js"></script>
<script src="Plugins/noty/demo/bouncejs/bounce.js" type="text/javascript"></script>	
<script src='Plugins/noty/lib/noty.min.js' type='text/javascript'></script>
<script src="Plugins/bootbox/bootbox.min.js"></script>
<script src="Plugins/waitMe/waitMe.min.js"></script>
<script src="Plugins/uploadPreview/jquery.uploadPreview.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.21/b-1.6.2/b-colvis-1.6.2/b-flash-1.6.2/b-html5-1.6.2/b-print-1.6.2/fh-3.1.7/r-2.2.5/sc-2.0.2/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script><script src="js/kmf.common.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspanel4@4.10.2/dist/jspanel.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspanel4@4.10.2/dist/extensions/modal/jspanel.modal.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspanel4@4.10.2/dist/extensions/tooltip/jspanel.tooltip.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspanel4@4.10.2/dist/extensions/hint/jspanel.hint.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspanel4@4.10.2/dist/extensions/layout/jspanel.layout.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspanel4@4.10.2/dist/extensions/contextmenu/jspanel.contextmenu.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspanel4@4.10.2/dist/extensions/dock/jspanel.dock.js"></script>
<script src="Plugins/html2pdf/dist/html2pdf.bundle.min.js"></script>
<script src="js/kmf.common.js"></script>
<script src="js/kmf.accountStatus.js"></script>
</body>
</html>