<?php include("Controllers/security.php");
if( isset($_GET['sx9jiucv']) )
{
	$planID = $_GET['sx9jiucv'];
	$dataNumX = (int) $coreConn->query("select count(*) from tbl_plans WHERE id='$planID'    ")->fetchColumn(); 
	if($dataNumX > 0)
	{
		$planName  =  getData($coreConn, "tbl_plans", "planName", " WHERE id='$planID'  " );
		$installAmt  =  getData($coreConn, "tbl_plans", "installmentAmt", " WHERE id='$planID'  " );
		$planAmt  =  getData($coreConn, "tbl_plans", "planAmount", " WHERE id='$planID'  " );
		$interestAmt  =  getData($coreConn, "tbl_plans", "interestAmt", " WHERE id='$planID'  " );
		$totPlanAmt  =  getData($coreConn, "tbl_plans", "totalPlanAmt", " WHERE id='$planID'  " );
		$intervalID  = (int) getData($coreConn, "tbl_plans", "intervalID", " WHERE id='$planID'  " );
		$durationKey  = (int) getData($coreConn, "tbl_plans", "durationKey", " WHERE id='$planID'  " );
		$planType  = (int) getData($coreConn, "tbl_plans", "planType", " WHERE id='$planID'  " );
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
<title>Edit Plan | Kunja Micro Finance</title>
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
<link rel="stylesheet"  type="text/css" href="Plugins/waitMe/waitMe.css" >			
<link rel="stylesheet" type="text/css"  href="Plugins/noty/lib/noty.css"/>                                          
<link rel="stylesheet" type="text/css"  href="Plugins/noty/lib/themes/mint.css"/>                                          
<link rel="stylesheet" type="text/css"  href="Plugins/noty/lib/themes/nest.css"/>  
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
					<li><a href="listPlans">Plans List</a></li>
					<li class="active">Edit Plan</li>
				</ol>
			   </div>

				<div class="graph-visual tables-main">					
						<div class="graph">
							<div class="block-page">
								<form name="newPlanFrm" id="newPlanFrm" > 
									<input type="hidden" name="pk" id="pk" value="<?php echo $planID;?>" />
									<input type="hidden" name="intvID" id="intvID" value="<?php echo $intervalID;?>" />
									
									<div class="col-xs-12 col-md-6 appCol">
										<div class="form-group"> 
											<label for="planName">Plan Name</label> 
											<input type="text" class="form-control" id="planName" name="planName" value="<?php echo $planName;?>" placeholder="Plan Name"> 
										</div> 
									
										<div class="form-group">
											<input type="radio" name="planType" id="invPlan" value="1"  <?php if($planType==1) echo "checked"; ?> />&nbsp;Investment Plan&nbsp;&nbsp;
											<input type="radio" name="planType" id="loanPlan" value="2" <?php if($planType==2) echo "checked"; ?>  />&nbsp;Loan Plan
										</div>
										
										<div class="form-group"> 
											<label for="durationID">Duration (in months)</label> 
											<select name="durationID" id="durationID" class="form-control" style="height:45px;">
												<option value="">Select Duration</option>
												<?php 
													for($i=1;$i<=12;$i++)
													{
														if($i<2) $durationTxt = $i." Month";
														else $durationTxt = $i." Months";
														
														if($i==$durationKey)$selected = "selected";
														else
														$selected = "";
														
														?>
														<option <?php echo $selected;?> value="<?php echo $i;?>"><?php echo $durationTxt;?></option>
														<?php
													}
												?>																										
																										
											</select>
										</div> 
										
										
										
										<div class="form-group"> 
											<label for="intervalID">Frequency</label> 
											<select name="intervalID" id="intervalID" class="form-control" style="height:45px;">
												
																																					
																										
											</select>
										</div> 
										
										
										
										
										
										<div class="form-group"> 
											<label for="planAmt">Amount</label> 
											<input type="text" class="form-control" id="planAmt" name="planAmt" value="<?php echo $planAmt;?>" placeholder="0.00" > 
										</div> 
										
										<div class="form-group"> 
											<label for="interestAmt">Interest Amount</label> 
											<input type="text" class="form-control" id="interestAmt" value="<?php echo $interestAmt;?>" name="interestAmt" placeholder="0.00" > 
										</div> 		

										
										
									</div>
									
									
									
									<div class="col-xs-12 col-md-6">
										<div class="form-group"> 
											<label for="installmentAmt">Installment Amount</label> 
											<input type="text" class="form-control" id="installmentAmt" name="installmentAmt" value="<?php echo $installAmt;?>" readonly> 
										</div> 									
									
										<div class="form-group"> 
											<label for="planVal">Total Plan Value</label> 
											<input type="text" class="form-control" id="planVal" name="planVal" value="<?php echo $totPlanAmt;?>" readonly style="color:#d93600"> 
										</div> 
									
									</div>
									<div style="clear:both"></div>
									
									
									
								</form> 
								
								<button type="button" id="editPlan" class="btn btn-default">Update Plan</button> 
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
<script src="js/kmf.common.js"></script>
<script src="js/kmf.newPlan.js"></script>
</body>
</html>