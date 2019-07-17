<?php  
require_once('module/start_session.php'); 
require_once('module/header-home.php');
require_once('classicadmin/module/Core.php');
require_once('classicadmin/module/Function.php');

$user='';
$add_datetime='';
$remote_addr='';
$request_uri='';

if(isset($_REQUEST['login']))
{
	$user=addslashes(strtolower(stripslashes(trim(isset($_POST['email'])?$_POST['email']:''))));
	$pass=addslashes(stripslashes(trim(isset($_POST['password'])?$_POST['password']:''))); 
	$password=md5($pass); // Encrypted Password

	if(empty($user)){
	$err[]='Please enter user email';
	}
	if(empty($pass)){
	$err[]='Please enter Password';
	} 
	if(!validateLoginwebuser($user,$password)){
	//echo validateLoginUser($user,$user_password);
	$err[]='Invalid Username or Password';
	}
	else if(empty($err)){	
	//setSess('LOGGED_USER',$user);
	$_SESSION['LOGGED_WEB_EMAIL']=$user;
	$_SESSION['last_login_timestamp'] = time(); 	
	$_SESSION['LOGGED_WEB_USER']=getUserIdwebusername($user);
	$_SESSION['LOGGED_USER']=$user;	
	$_SESSION['LOGIN']=1;	
	$_SESSION['USER_ID']=getAdminId($user);
	
	echo'<script>window.location="index.php";</script>';
	}
	else {
	//echo "<script>alert('User Not Login Successfully');</script>";
	echo'<script>window.location="login.php";</script>';
	}
}

	//forgot password start_session
	if(isset($_POST['forgot'])){
	$user=stripslashes(isset($_POST['email'])?$_POST['email']:'');
	if(!validateLoginforgotweb($user)){
	$err[]='Invalid Email id entered';
	}
		else {
		$rec=getEmailIdsforgotweb($user);
			if(count($rec)>0){	
			foreach($rec as $r){			
			$to  = $user . ', '; // note the comma
		
			// subject
			$subject = 'Shopping ARA Forgot Password Customer ';
			
			$password=rand(100000, 500000);
			$newpass=$password;
			$pass=md5($password); // Encrypted Password
			// message
			$message = '<html><body><h3>  Customer Password </h3><table border="0"> <tr><td> User Email : </td><td>'.$r['email'].'</td></tr><tr><td> User Password : </td><td>'.$newpass.'</td></tr></html></body>';

			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			// Additional headers
			$headers .= 'To: Shopping ARA  Forgot Password Customer '. $user. "\r\n";
			$headers .= 'From: Shopping ARA  Forgot Password Customer  <shoppingara@gmail.com>' . "\r\n";
			//$headers .= 'Cc: amit.dubale10@gmail.com' . "\r\n";
			//$headers .= 'Bcc: amit.dubale10@gmail.com . "\r\n";

				$data3=array(				
				'password'=>$pass						
			);
				
			updateRecord("new_customer",$data3,"customer_id=".$r['customer_id']);
				$data=array(
				'login_user'=>$user,
				'login_datetime'=>$add_datetime,
				'task'=>'Forget Password',	
				'remote_addr'=>$remote_addr,		
				'request_uri'=>$request_uri,						
				'file'=>''		
				); 											
				insertRecord('logs_master',$data);
					
			// Mail it
			mail($to, $subject, $message, $headers);
			echo "<script>alert('Please Check Mail! Password Send Successfully');</script>";
			echo'<script>window.location="login.php";</script>';
			exit();
			}
		}
	}
}
?>

<!-- Start Page Banner -->
<div class="page-banner" style="background: url(images/slide-02-bg.jpg) center #eee;">
  <div class="container">
	<div class="row">
	  <div class="col-md-12">
		<ul class="breadcrumbs">
		  <li><a href="index.php">Home</a></li>
		  <li>login</li>
		</ul>
	  </div>
	</div>
  </div>
</div>
<!-- End Page Banner -->
	
<!-- Start Content -->
<div id="content">
	<div class="container">
		<div class="call-action call-action-boxed call-action-style2 clearfix">
			<div class="row">
				<div class="col-md-6" style="border-right: 1px solid #ccc";>
					<h4 class="classic-title"><div class="panel-body"><strong><i> Already Registered ?</i></strong></div></h4>
					<h5>If you have an account with us, please log in.</h5><hr/>
					<?php
					if(!empty($err)){
					showErrBox($err);
					}else if(!empty($msg)){
					showMsgBox($msg);
					}								
					?>
					<form class="form-horizontal" name="login" action="login.php" method="post">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control">Email <span class="required">*</span></label>
							<div class="col-sm-8">
							  <input type="email" class="form-control" name="email" value="<?=$user?>" id="inputEmail3" pattern="[^'\x22]+" placeholder="Email" required />
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-3 control">Password <span class="required">*</span></label>
							<div class="col-sm-8">
							  <input type="password" class="form-control" name="password" id="inputPassword3" pattern=".{6,}" pattern="[^'\x22]+" placeholder="Password" required />
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-7">
								<div >
									<label class="checkbox">
										<input type="checkbox" value="remember-me" style="margin-top:9px;"> Remember me
										<span class="pull-right"><a href="#" type="button"  data-toggle="modal" data-target=".bs-example-modal-lg"> Forgot Password?</a></span>
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
							 <button name="login" type="submit" class="btn btn-default center bt">LOGIN <i class="fa fa-arrow-circle-right shopicon"></i></button>
							</div>
						</div>
					</form>
				</div>
				
				<div class="col-md-6" style="margin-top:10px";>
					<center><h4 class="classic-title" ><span><i>Login Or Create An Account</i></span></h4></center>
					<center>
					<ul class="social-btns center-block">
						<li><button class="btn btn-facebook"><i class="fa fa-facebook pull-left" aria-hidden="true"></i>Sign in with Facebook</button></li>
						<li><button class="btn btn-twitter"><i class="fa fa-twitter pull-left" aria-hidden="true"></i>Sign in with Twitter</button></li>
						<li><button class="btn btn-google"><i class="fa fa-google-plus pull-left" aria-hidden="true"></i>Sign in with Google</button></li>
					</ul>
					</center><br/>
					<center><h4 style="margin-bottom:5px";>New To  Classic Perfumes ?</h4>
					<p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p><br/>
					<a href="signup.php" class="btn btn-default center bt">SIGN UP <i class="fa fa-arrow-circle-right shopicon"></i></a></center>
				</div>
			</div> 
		</div>
	  <!-- End Call Action -->
	</div>
		
	<!-- Small modal -->
	<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		<div class="modal-dialog modal-lg" role="document" style="margin-top:243px">
			<div class="modal-content" style="width:353px;">
				<div class="loginmodal-container">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h1>Forgot Password</h1><br/>
					<form class="form-horizontal" method="post" name="forgot" action="login.php">
						<div class="form-group">
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa"></i></span>
									<input type="text" class="form-control" name="email" id="email" placeholder="Enter your Email"/>
								</div>
							</div>
						</div>
						<div class="form-group ">
							<button type="submit" name="forgot" value="Submit" class="btn btn-primary btn-lg btn-block login-button bt">Submit</button>
						</div>
					</form>	
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Content -->

<?php require_once('module/footer.php'); ?>  