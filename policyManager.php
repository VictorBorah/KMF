<?php include("Controllers/security.php");
if( isset($_GET['g9hky0x7vk']) )
{
	$clientID = $_GET['g9hky0x7vk'];
	$dataNumX = (int) $coreConn->query("select count(*) from client_plan_map WHERE clientID='$clientID'    ")->fetchColumn(); 
	if($dataNumX > 0)
	{
		$clients_Policies = array();
		$getPolicies = "SELECT * FROM client_plan_map WHERE clientID='$clientID'  ";
		foreach ($coreConn->query($getPolicies) as $dataRow)
		{
			array_push($clients_Policies,$dataRow['id']);
		}
		//$planName  =  getData($coreConn, "tbl_plans", "clientID", " WHERE id='$planID'  " );
		$clientName  =  getData($coreConn, "tbl_clients", "clentName", " WHERE id='$clientID'  " );
		$clientMobile  =  getData($coreConn, "tbl_clients", "clientMobile", " WHERE id='$clientID'  " );
		$clientAddress  = getData($coreConn, "tbl_clients", "clientAddress", " WHERE id='$clientID'  " );
		$clientEmail  = getData($coreConn, "tbl_clients", "clientEmail", " WHERE id='$clientID'  " );
	}
	else 
	header("location:newPlan");
}
else 
header("location:newPlan");
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Policy Manager | Kunja Micro Finance</title>
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
					<li><a href="listClients">Client List</a></li>
					<li class="active">Policy Manager</li>
				</ol>
			   </div>

				<div class="graph-visual tables-main">					
						<div class="row">
							<div class="block-page">
								
								<div class="panel panel-default" style="padding-left:20px;">
									<div class="row">
										<div class="col-xs-12">
											<div class="row">Client name: <b><?php echo $clientName;?></b></div>
											<div class="row">Mobile: <b><?php echo $clientMobile;?></b></div>
										</div>
									</div>
									
									
								</div>
								
								<div class="row">
									<div class="col-xs-12 col-md-7 col-lg-5">
										<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">		
										<?php	
											
										$i=0;
										$cancelBTN = "";
										$getPlans = "SELECT * FROM client_plan_map WHERE clientID='$clientID'  ";
										foreach ($coreConn->query($getPlans) as $dataRow)
										{
											$pk = $dataRow['id'];
											$policyID = $dataRow['policyID'];
											$planID = $dataRow['planID'];
											$isActive = (int) $dataRow['active'];
											$isDisbursed = (int) $dataRow['isDisbursed'];
											$disbursalDt = $dataRow['disbursedOnDate'];
											$disbursedAmt = $dataRow['disbursedAmount'];
											$amt  = getData($coreConn, "tbl_plans", "collectionAmt", " WHERE id='$planID'  " );
											
											$status = "<span style='color:#008c00'>Active</span>";
											
											switch($isActive)
											{
												case 1: $status = "<span style='padding:3px;background:#99ffb2;color:#008c00'>Active</span>";break;
												case 0: $status = "<span style='padding:3px;background:#ffbfbf;color:#8c0000'>In-Active</span>";$cancelBTN = "disabled";break;												
											}
											
											
											
											if($isDisbursed==1) 
											{
												$cancelBTN = "disabled";
												$status = "<span  style='padding:3px;background:#dbdbea;color:#424251'>Disbursed</span>";	
											}
											
											
											
											
											
											?>
											
											  <div class="panel panel-default" style="padding:5px;">
												<div class="panel-heading" role="tab" id="headingOne">
												  <h4 class="panel-title">
													<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne-<?php echo $pk;?>" aria-expanded="true" aria-controls="collapseOne">
													  Policy #<?php echo $policyID;?>
													</a>
												  </h4>
												</div>
												<div id="collapseOne-<?php echo $pk;?>" class="panel-collapse collapse <?php /*if($i==0) echo "in";*/ ?>" role="tabpanel" aria-labelledby="headingOne">
												  <div class="panel-body">
													
												  
												  
													<div class="form-body" style="text-align:center;">										
														
														<form name="policyForm-<?php echo $pk;?>" id="policyForm-<?php echo $pk;?>"> 															
															<input type="hidden" name="policyPK_TB" id="policyPK_TB" value="<?php echo $pk;?>" />
															<input type="hidden" name="policyID_TB" id="policyID_TB" value="<?php echo $policyID;?>" />
															<input type="hidden" name="planID_TB" id="planID_TB" value="<?php echo $planID;?>" />
															<input type="hidden" name="clentID_TB" id="clentID_TB" value="<?php echo $clientID;?>" />
															
															<div class="row">
																<div class="col-xs-12">
																	Policy Status: <?php echo $status;?>
																</div>
															</div>
															
															<button type="button" id="viewTrns-<?php echo $pk;?>" class="btn blue four viewTrnsBtn" style="width:180px;margin:5px 3px;" title="View all Transactions">View Transactions</button>															
															<button type="button" id="cnclPolicy-<?php echo $pk;?>" class="btn red four cancelPolicyBtn" style="width:180px;margin:5px 3px;" title="Cancel this Policy" <?php echo $cancelBTN;?>>Cancel Policy</button>
															
														</form> 
														
														
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.21/b-1.6.2/b-colvis-1.6.2/b-flash-1.6.2/b-html5-1.6.2/b-print-1.6.2/fh-3.1.7/r-2.2.5/sc-2.0.2/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspanel4@4.10.2/dist/jspanel.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspanel4@4.10.2/dist/extensions/modal/jspanel.modal.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspanel4@4.10.2/dist/extensions/tooltip/jspanel.tooltip.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspanel4@4.10.2/dist/extensions/hint/jspanel.hint.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspanel4@4.10.2/dist/extensions/layout/jspanel.layout.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspanel4@4.10.2/dist/extensions/contextmenu/jspanel.contextmenu.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspanel4@4.10.2/dist/extensions/dock/jspanel.dock.js"></script>
<script src="js/kmf.common.js"></script>
<script src="js/kmf.policyManager.js"></script>
</body>
</html>