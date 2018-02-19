<?php
	require_once('includes/common.php');
	require_once('includes/header.php');
	// require_once('includes/nav.php');
	//require_once('includes/connection.php');
 ?>

 <div class="wrapper-page">
 	<div class="box box-primary">
 		<div class="box-header with-border">
 			<h3 class="text-center m-t-0 m-b-15"> 
				<a href="index.html" class="logo logo-admin"><h1 style="font-size: 3em">M<span style="font-family: Raleway;">|</span>G</h1></a></h3><h3 class="box-title">Forgot Password?
			<h3/>
 		</div>
 		<form class="" action="forgot.php" method="post" role="form">
 			<div class="box-body"">

 				<div class='error-text'><?php echo $error; ?></div>
				<div class="form-group">
					<label for="email">Email</label> 
					<input class="form-control" name='email' id="email" type="text" required="" placeholder="Email">
				</div>
			</div>
			<div class="box-footer">

				<div class="form-group"> 
					<button class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit">Send Reset Email</button>
				</div>
			</div>
		</form>
	</div>
</div>


<!-- body tags included in this layout due to lack of nav and footer 
 <body id="login">
	<div class="container">
		<div class="valign-wrapper">
			<div class="valign" id="login-div">
			 	<div class="row">
			 		<div class="col s12 center-align">
			 			<img id="login-photo" src="img/mcgraw_logo.png" alt="McGraw Group Real Estate Investment Company Logo">
			 		</div>
			 	</div>
			    <div class='error-text'><?php echo $error; ?></div>
			    <form class="col s12" action="login.php" method="post">
				 	<div class="row">
					    
				        <div class="row">
						    <div class="input-field col s12">
						        <i class="material-icons icon-white prefix">account_circle</i>
						        <input name='username' id="icon_prefix" type="text" class="validate">
						        <label for="icon_prefix">Username</label>
					        </div>
					        <div class="input-field col s12">
						        <i class="material-icons icon-white prefix">vpn_key</i>
						          <input name='password' id="password" type="password" class="validate">
						          <label class="login-label" for="password">Password</label>
					        </div>
				        </div>
					</div>
					<div class="row">
						<div class="center col s12">
							<button class="btn waves-effect waves-light" type="submit" name="action">Login
						    	<i class="center material-icons right">send</i>
						 	</button>
						</div>
					</div>
			     
				</form>
			</div>
		</div>
	</div>
-->
 <?php
	require_once('includes/footer.php');
?>