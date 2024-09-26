<html>  
<body>

<form action="updatenewpassword.php" method="post">
	Email: <input type="text" name="email" value=<?php echo $_GET['userEmail'] ?>> <br>
	Password: <input type="Password" name="newpassword"><br>
	ReEnterPassword: <input type="Password" name="renewpassword"><br>
	<input type="submit">
</form>
</body>
</html>