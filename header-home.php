<?php
require_once('module/start_session.php');
require 'PHPMailerAutoload.php';
require_once('classicadmin/module/Core.php');
require_once('classicadmin/module/Function.php');

 if(isset($_SESSION["LOGGED_WEB_USER"]))  
      {  
           if((time() - $_SESSION['last_login_timestamp']) > 60) // 900 = 15 * 60  
           {  
                header("location:logout.php");  
           }
	  }

?>
<!doctype html>
<html lang="en">
<head>
  <!-- Basic -->
  <title>Classic Perfumes | Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="description" content="SHOPPINGRAR">
  <meta name="author" content="iThemesLab">
  <link rel="stylesheet" href="asset/css/bootstrap.min.css" type="text/css" media="screen">
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="screen">
  <link rel="stylesheet" type="text/css" href="css/slicknav.css" media="screen">
  <link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
  <link rel="stylesheet" type="text/css" href="css/responsive.css" media="screen">
  <link rel="stylesheet" type="text/css" href="css/animate.css" media="screen">
  <link rel="stylesheet" type="text/css" href="css/colors/red.css" title="red" media="screen" />
  <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="js/jquery.migrate.js"></script>
  <script type="text/javascript" src="js/modernizrr.js"></script>
  <script type="text/javascript" src="asset/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery.fitvids.js"></script>
  <script type="text/javascript" src="js/owl.carousel.min.js"></script>
  <script type="text/javascript" src="js/nivo-lightbox.min.js"></script>
  <script type="text/javascript" src="js/jquery.isotope.min.js"></script>
  <script type="text/javascript" src="js/jquery.appear.js"></script>
  <script type="text/javascript" src="js/count-to.js"></script>
  <script type="text/javascript" src="js/jquery.textillate.js"></script>
  <script type="text/javascript" src="js/jquery.lettering.js"></script>
  <script type="text/javascript" src="js/jquery.easypiechart.min.js"></script>
  <script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>
  <script type="text/javascript" src="js/jquery.parallax.js"></script>
  <script type="text/javascript" src="js/mediaelement-and-player.js"></script>
  <script type="text/javascript" src="js/jquery.slicknav.js"></script>
  

<!--[if IE 8]><script src=""></script><![endif]-->
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="zoom/zoomsl-3.0.min.js"></script>
<script src="/jquery-1.8.2.min.js"></script>

<style>
#country-list-new{float:left;list-style:none;margin:0;padding:3px;width:355px;}
#country-list-new li{padding: 8px; background:#FAFAFA;border-bottom:#e6e6e6 1px solid;}
#country-list-new li:hover{background:#F0F0F0;}
#search-box-new{padding: 6px;border: #F0F0F0 1px solid;}
</style>
<script>
$(document).ready(function(){
	$("#search").keyup(function(){
	var search = $(this).val();
		$.ajax({
		type: "GET",
		url: "searchallproducts.php?search="+ search ,
		//data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search").css("background","#FFF url(LoaderIcon.gif) no-repeat 465px");
		},
		success: function(data){
			$("#resultshow").show();
			$("#resultshow").html(data);
			$("#search").css("background","#FFF");
		}
		});
	});
});

function selectSearch(val) {
$("#search").val(val);
$("#resultshow").hide();
}
</script>

 <!--[if lt IE 9]><script src=""></script><![endif]-->
 <!--Start of Tawk.to Script-->
	<script type="text/javascript">
		var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
		(function(){
		var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
		s1.async=true;
		s1.src='https://embed.tawk.to/5b925acbafc2c34e96e84fc4/default';
		s1.charset='UTF-8';
		s1.setAttribute('crossorigin','*');
		s0.parentNode.insertBefore(s1,s0);
		})();
	</script>
	<!--End of Tawk.to Script-->
</head>

<body>
<!-- Full Body Container -->
<div id="container">
    <!-- Start Header Section -->
    <div class="hidden-header"></div>
    <header class="clearfix" style="background-color:#fff;border-top:1px solid;">  
		<!-- start middle meun  header--->
		<div id="mmeun-navbar" style="margin-top:8px;background-color:#fff;margin-bottom:8px;">
			<div class="container">	
				<div class="row">
					<div class="col-md-2">
						<a class="largenav" href="index.php"><img alt="" src="images/logo.png"></a>
						<a class="smallnav menu" onclick="openNav()" href="index.php" style="height:45px;width:110px;">
						<img src="images/logo.png" style="height:45px;"></a>
					</div>
					<div class="col-md-6">
						<div class="mmeun-navbar-search smallsearch">
							<div class="widget widget-search">
								<form action="" method="GET" style="margin-top:5px;">
									<input type="search" id="search" name="search" placeholder="Search for a #tag, user, product, category, brand or looks" onfocus="this.value = '';" autocomplete="off" onblur="if (this.value == '') {this.value = 'Search';}" />
									<div id="resultshow" style="position:absolute;z-index:1;padding-top:1px;margin-top:33px; margin-left:-5px;width:100%;"></div>
									<button class="search-btn" type="submit"><i class="fa fa-search" style="color:#fff;"></i> </button>		  
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="slider-content" style="margin-top:5px;">
							<div class="col-md-12 text-right">
								<div class="register-hight">
									<span class="tagz">
										<ul class="top btn btn11">	
											<div class="btn-group" role="group">
											<?php if(isset($_SESSION['LOGGED_WEB_USER'])!=''){ ?>
											<li>	 
												<button class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color:#fff;margin-left:-25px;border:0px solid #fff">
												  <a href=""><?php echo substr($_SESSION['LOGGED_WEB_USER'],0,10); ?> <i class="fa fa-user co"></i> <span class="caret"></span></a> 
												</button>
												<ul class="dropdown-menu" style="margin-left:-48px;margin-top:10px;">
												  <li><a href="member.php">My Account</a></li>
												  <li><a href="my_order.php">My Order</a></li>
												  <li><a href="logout.php">Sign Out</a></li>
												</ul>
											</li>
											<?php } else { ?>
											<li><a href="login.php" style="font-size:14px;text-transform:capitalize;"> Sign In</a> </li>
											<?php } ?>
											</div>
										</ul>
									 <a href="basket.php" class="top btn btn-system btn-large" style="margin-left:9px;"> 
									 <?php $recssession=selectAllActive("order_temp_add","temp_id","DESC","session_id='".session_id()."'"); ?>
									 <?php echo count($recssession); ?> Cart <i class="fa fa-cart-arrow-down icontop"></i></a>
									 
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	 <!-- start middle meun  header---> 

    <!-- Start  Logo & Naviagtion  -->
		<div class="navbar navbar-default navbar-top" >
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<i class="fa fa-bars"></i></button>
				</div>
				<div class="navbar-collapse collapse">
					<!-- Start Navigation List -->
					<ul class="nav navbar-nav navbar-lift">
						<li><a class="active" href="index.php">Home &nbsp <i class="fa fa-home"></i></a></li>
						<?php 
						$start_from=0;
						$num_rec_per_page=5;
						$recs=selectLimitWhere("prod_category","status='Yes'","category_id","ASC",$start_from,$num_rec_per_page);
						if(count($recs)>0){
						foreach($recs as $r){ 
						?>
						<li><a href="#"><?=$r['category_name']?> &nbsp&nbsp<i class="fa fa-angle-down"></i></a>
							<ul class="dropdown">
								<?php
								$info=selectAllActive("prod_mainsubcategory","mainsubcategory_id","ASC"," category_id= ".$r['category_id']." AND status='Yes'");
								if(count($info)>0){
								foreach($info as $r1){
								?>
								<li><a href="sub_category.php?subcatid=<?php echo $r1['mainsubcategory_id']?>"><?=$r1['mainsubcat_name']?></a></li>
								<?php } } ?>
							</ul>
						</li>
						<?php } } ?>
					</ul>
					<!-- End Navigation List -->
				</div>
			</div>

			<!-- Mobile Menu Start -->
			<ul class="wpb-mobile-menu" style="text-align:justify;">
				<li><a class="active" href="index.php"><i class="fa fa-home icontop"></i> HOME </a></li>
				<?php 
				$start_from=0;
				$num_rec_per_page=5;
				$recs=selectLimitWhere("prod_category","status='Yes'","category_id","ASC",$start_from,$num_rec_per_page);
				if(count($recs)>0){
				foreach($recs as $r){ 
				?>
				<li><a href="#"><i class="fa fa-th-list icontop"></i> <?=$r['category_name']?></a>
					<ul class="dropdown">
						<?php
						$info=selectAllActive("prod_mainsubcategory","mainsubcategory_id","ASC"," category_id= ".$r['category_id']." AND status='Yes'");
						if(count($info)>0){
						foreach($info as $r1){
						?>
						<li><a href="sub_category.php?subcatid=<?php echo $r1['mainsubcategory_id']?>"><?=$r1['mainsubcat_name']?></a></li>
						<?php } } ?>
					</ul>
				</li>
				<?php } } ?>
			</ul>
			<!-- Mobile Menu End -->
		</div>
      <!-- End Header Logo & Naviagtion -->
    </header>
    <!-- End Header Section -->
	
<!-- .container -->
			
		