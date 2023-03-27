<?php include("Controllers/security.php");
if( isset($_GET['xuiki9w2v']) )
{
	$clientID = $_GET['xuiki9w2v'];
	$dataNumX = (int) $coreConn->query("select count(*) from tbl_clients WHERE id='$clientID'    ")->fetchColumn(); 
	if($dataNumX > 0)
	{
		$clientName  =  getData($coreConn, "tbl_clients", "clentName", " WHERE id='$clientID'  " );
		$clientMobile  =  getData($coreConn, "tbl_clients", "clientMobile", " WHERE id='$clientID'  " );
		$clientAddress  = getData($coreConn, "tbl_clients", "clientAddress", " WHERE id='$clientID'  " );
		$clientEmail  = getData($coreConn, "tbl_clients", "clientEmail", " WHERE id='$clientID'  " );
		$clientPhotoFile  =  getData($coreConn, "tbl_clients", "photo_File", " WHERE id='$clientID'  " );
		$sex  =  getData($coreConn, "tbl_clients", "sex", " WHERE id='$clientID'  " );
		$active_STTS  = (int) getData($coreConn, "tbl_clients", "active", " WHERE id='$clientID'  " );
		
		$clientPlans_ARR = array();
		$getPlans = "SELECT * FROM client_plan_map WHERE clientID='$clientID' and active='1' ";
		foreach ($coreConn->query($getPlans) as $dataRow)
		{
			array_push($clientPlans_ARR, $dataRow['planID']);
		}
		
		if($clientPhotoFile == "") $photoURL = "images/male.jpg";
		else $photoURL = "ClientPhotos/".$clientPhotoFile;
		
		if($sex=="") $clientGender="N/A";
		else
		{
			switch($sex)
			{
				case 'M': $clientGender="Male";break;
				case 'F': $clientGender="Female";break;
				case 'O': $clientGender="Other";break;
			}
		}
		
		if($clientAddress=="") $clientAddress="N/A";
		if($clientEmail=="") $clientEmail="N/A";
		
		
		
	}
	else 
	header("location:listClients");
}
else 
header("location:listClients");
?>
<!DOCTYPE HTML>
<html>
<head>
<title>View Client | Kunja Micro Finance</title>
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
					<li><a href="index">Home</a></li>
					<li><a href="listClients">Client List</a></li>
					<li class="active">Client View</li>
				</ol>
			   </div>

				<div class="graph-visual tables-main">					
						<div class="graph">
							<div class="block-page">
								<input type="hidden" name="pk" id="pk" value="<?php echo $clientID;?>" />
								
								
								<div class="row" style="margin-bottom:10px;">
									<div class="col-xs-12">
										<img src="<?php echo $photoURL;?>" width="140" height="140" />
									</div>
								</div>
								
								
								<div class="row" style="margin-bottom:10px;"><div class="col-xs-12">Name: <b><?php echo $clientName;?></b></div></div>
								<div class="row" style="margin-bottom:10px;"><div class="col-xs-12">Sex: <b><?php echo $clientGender;?></b></div></div>
								<div class="row" style="margin-bottom:10px;"><div class="col-xs-12">Mobile: <b><?php echo $clientMobile;?></b></div></div>
								<div class="row" style="margin-bottom:10px;"><div class="col-xs-12">Email: <b><?php echo $clientEmail;?></b></div></div>
								
								
								<div class="row" style="margin-bottom:10px;">
									<div class="col-xs-12 col-md-6">Address: <br>
										<b>
										<div style="min-height:120px;width:100%;background:#eee;padding:5px!important;;margin:0;border:1px solid #dedede;" >
										 <?php 
										 $modSTR="";
										 if (strpos($clientAddress,',') !== false)
											{
												$my_array = explode(",", $clientAddress);
												foreach($my_array As $part)
												{
												 if($modSTR == "") $modSTR = $part;
												 else $modSTR = $modSTR."<br>".$part;
												}
											}
										else $modSTR = $clientAddress;
										 
										 
										 
										 
										 
										 echo $modSTR;
										 
										 ?>
										</div>
										</b>
									</div>
								</div>
								
								<div class="row" style="margin-bottom:10px;">
									<div class="col-xs-12 col-md-6">Associated Plan(s):<span style="color:#b30000;">*</span> <br>
										<b>
										<div style="min-height:120px;width:100%;background:#eee;padding:5px!important;;margin:0;border:1px solid #dedede;" >
										  <?php 
											    $str="";
												//print_r($clientPlans_ARR);
												
												foreach($clientPlans_ARR As $planID)
												{													
													$planName  =  trim(getData($coreConn, "tbl_plans", "planName", " WHERE id='$planID'  " ));
													echo $planName."<br>";
													/*
													if( $str=="" ) $str = $planName;
													else $str = $str.",".$planName;													
													*/
												}
												
												
												?>
										</div>										
										<span style="color:#b30000;">*</span><small>Use the Policy Manager to Add or Disable Plans</small>
										</b>
									</div>
								</div>
								
								<div class="row" style="margin-bottom:10px;">
									<hr class="hrClass">
									<div class="col-xs-12">
										<a class="butt" href="editClient?uu9ikx3vp=<?php echo $clientID;?>">Edit Client</a>&nbsp;&nbsp;
										<a class="butt" href="policyManager?g9hky0x7vk=<?php echo $clientID;?>">Policy Manager</a>&nbsp;&nbsp;										
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
<script src="Plugins/uploadPreview/jquery.uploadPreview.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="js/kmf.common.js"></script>
<script src="js/kmf.newClient.js"></script>
</body>
</html>