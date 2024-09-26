<?php
	session_start();

	//is the one accessing this page logged in or not?
	if (!isset($_SESSION['db_is_logged_in'])
		|| $_SESSION['db_is_logged_in'] != true) {
		// not logged in, move to login page
		header('Location: login.php');
		exit;
	} else {
		//logged in, display appropriate information
		 echo "Hello ",$_SESSION['userID'], "!";
	}
?>

<html>
	<head>
		<title>Main User Page</title>
		<meta charset="UTF-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
		<link rel="stylesheet" href="main.css">
	</head>

	<body>
		<p>This is the main application page. You are free to play around here since you are an autenthicated user :-) </p>
		<p><a href="profile.php">Profile</a> </p>
		<p><a href="logout.php">Logout</a> </p>
	</body>
</html>
