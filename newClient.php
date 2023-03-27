<?php include("Controllers/security.php");
$photoURL = "images/male.jpg";
?>
<!DOCTYPE HTML>
<html>
<head>
<title>New Client | Kunja Micro Finance</title>
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
					<li><a href="./">Home</a></li>
					<li class="active">New Customer</li>
				</ol>
			   </div>

				<div class="graph-visual tables-main">					
						<div class="graph">
							<div class="block-page">
								<form name="ClientFrm" id="ClientFrm" > 
									<div class="form-group"> 
										<label for="clientName">Customer Name</label> 
										<input type="text" class="form-control" id="clientName" name="clientName" placeholder="Customer Full Name"> 
									</div> 
																		
									
									<div class="form-group"> 
										<label for="clientMobile">Customer Mobile</label> 
										<input type="text" class="form-control" id="clientMobile" name="clientMobile" placeholder="Customer Mobile"> 
									</div>
									
									<div class="form-group"> 
										<label for="clientEmail">Customer Email</label> 
										<input type="text" class="form-control" id="clientEmail" name="clientEmail" placeholder="Customer Email"> 
									</div>
									
									<div class="form-group"> 
										<label for="clientAddress">Customer Address</label> 
										<textarea class="form-control" name="clientAddress" id="clientAddress"></textarea>					
									</div>
									
									
									
									
									<div class="form-group"> 
										<label for="clientSex">Gender</label> 
										<select name="clientSex" id="clientSex" class="form-control" style="height:45px;">
											<option value="">Select Gender</option>																																	
											<option value="M">Male</option>																																	
											<option value="F">Female</option>																																	
											<option value="O">Other</option>																																																										
										</select>
									</div>


									
									
									
									<div class="form-group" style="margin-top:30px;">
										<div class="row" style="margin:10px 0 0 0;">Customer Photo</div>
										<div class="col-xs-12">											
											<div class="row">
												<div id="dpPreview" class="image-preview" style="background:#dbdbea url('<?php echo $photoURL;?>');background-size:cover; " >
												  <label for="userDP" id="image-label">Choose Photo</label>
												  <input type="file" name="userDP" id="userDP"  accept="image/*" />
												</div>
											</div>
										</div>
									</div>
									
									
									
									
								</form> 
								
								<button type="button" id="addClient" class="btn btn-default">Add Customer</button> 
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