<?php
	require_once('includes/common.php');
	require_once('includes/header.php');
	// require_once('includes/nav.php');
	require_once('includes/database.php');
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	    //if request method is post
	    //now validate input
	    $firstname = $_POST['name_first'];
	    $lastname = $_POST['name_last'];
	    $username = $_POST['username'];
	    $password = $_POST['password'];
	    $confirmpassword = $_POST['confirmpassword'];
	    $error = null;
	    if(empty($firstname) || empty($lastname) || empty($username) || empty($password)){
			$error = "Please enter all fields.";
	    }
	    else if ($password != $confirmpassword) {
	    	$error = "Passwords do not match.";
	    }
	    else{
			try{
			    $signup = signup($_POST);
			}catch(Exception $e){
			    $error = $e;
			}
	    }
	    if($error == ""){
			$_SESSION["logged_in"] = "true";
			$_SESSION["username"] = $username;
			$_SESSION["password"] = $password;
			redirectRequest("main.php");
		    }else{
				$error= "Sign up failed, please try again!";
	    }
	}
 ?>

 <div class="wrapper-page">
 	<div class="panel panel-color panel-primary panel-pages">
 		<div class="panel-body"">
 			<h3 class="text-center m-t-0 m-b-15"> 
 					<a href="index.html" class="logo logo-admin"><h1 style="font-size: 3em">M<span style="font-family: Raleway;">|</span>G</h1></a></h3><h4 class="text-muted text-center m-t-0"><b>Sign up</b>
 				<h4/>
 				<div class='error-text'><?php echo $error; ?></div>
 				<form class="form-horizontal m-t-20" action="signup.php" method="post">
 					<div class="form-group">
 						<div class="col-xs-12"> 
 						<input class="form-control" name='name_first' id="icon_prefix" type="text" required="" placeholder="First Name">
 						</div>
 					</div>
 					<div class="form-group">
 						<div class="col-xs-12"> 
 						<input class="form-control" name='name_last' id="icon_prefix" type="text" required placeholder="Last Name">
 						</div>
 					</div>
 					<div class="form-group">
 						<div class="col-xs-12"> 
 						<input class="form-control" name='username' id="icon_prefix" type="text" required placeholder="Username">
 						</div>
 					</div>
 					<div class="form-group">
 						<div class="col-xs-12"> 
 							<input class="form-control" name='password' id="password" type="password" required placeholder="Password">
 						</div>
 					</div>
 					<div class="form-group">
 						<div class="col-xs-12"> 
 							<input class="form-control" name='confirmpassword' id="confirmpassword" type="password" required placeholder="Confirm Password">
 						</div>
 					</div>
 					<div class="form-group text-center m-t-40">
 						<div class="col-xs-12"> 
 							<button class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit">Sign up</button>
 						</div>
 						</div>
 				</form>
 			</div>
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