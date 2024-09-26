<?php

	//include database information and user information
	require 'authentication.php';

	//never forget to start the session
	session_start();
	$errorMessage = 'Create a user account';

	//are user ID and Password provided?
	if (isset($_POST['txtUserId']) && isset($_POST['txtPassword']) &&
		isset($_POST['retxtPassword'])) {

		//get userID and Password
		$loginUserId = $_POST['txtUserId'];
		$loginPassword = $_POST['txtPassword'];
		$reLoginPassword = $_POST['retxtPassword'];
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$email = $_POST['email'];
		
		if ($loginPassword == $reLoginPassword) {
		
		//connect to the database
                $conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
		
		//table to store username and password
		$userTable = "userprofile"; 

		$ps = md5($loginPassword);
			
		//table for user profile
		$userTable = "userprofile"; 

		// Formulate the SQL statment to find the user
		$sql = "INSERT INTO $userTable VALUES ('$loginUserId', '$firstName','$lastName', '$email', '$ps')";
		
		// Execute the query
                $query_result = $conn->query($sql)
                
			or die( "SQL Query ERROR. User can not be created.");

		// Go to the login page
		header('Location: login.php');
			exit;
		} else {
			$errorMessage = "Passwords do not match";
		}///to be modified
	}
?>

<html>
	<head>
		<title>Sign-Up</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
		<link rel="stylesheet" href="main.css">
	</head>

	<body>
	    <Strong> <?php echo $errorMessage ?> </Strong>
	    <div class="container">
    		<div class="row">
      		<div class="col-md-4 offset-md-4 form-wrapper auth">
        	<h3 class="text-center form-title">Register</h3>
		<form action="" method="post" name="frmLogin" id="frmLogin">
		 <table width="300" border="1" align="center" cellpadding="2" cellspacing="2">
		  <tr>
		   <td width="150">Select User ID *</td>
		   <td><input name="txtUserId" type="text" id="txtUserId"></td>
		  </tr>
		  <tr>
		   <td width="150">Type Password *</td>
		   <td><input name="txtPassword" type="password" id="txtPassword"></td>
		  </tr>
		  <tr>
		   <td width="150">Retype Password *</td>
		   <td><input name="retxtPassword" type="password" id="retxtPassword"></td>
		  </tr>


		  <tr>
		   <td width="150">First Name</td>
		   <td><input name="firstName" type="text" id="firstName"></td>
		  </tr>
		  <tr>

		  <tr>
		   <td width="150">Last Name</td>
		   <td><input name="lastName" type="text" id="lastName"></td>
		  </tr>
		  <tr>
		  <tr>
		   <td width="150">Email Address *</td>
		   <td><input name="email" type="text" id="email"></td>
		  </tr>
		  <tr>
		   <td width="150">&nbsp;</td>
		   <td><input name="btnLogin" type="submit" id="btnLogin" value="Sign Up"></td>
		  </tr>
		 </table>
		</form>
		<p>Already have an account? <a href="login.php">Login</a></p>
		</div>
    </div>
  </div>
	</body>
</html>
