<html>  
<body>
 <?php
 if  (!isset($_GET['Error'])){
 	echo "Welcome ";
 	echo "\r\n";
 	echo "Login";
 }else{
 	echo '<span style="color:#FF0000;text-align:center;">'.$_GET["Error"].'</span>';
 }
	
?>
<form action="authentication.php" method="post">
	E-mail: <input type="text" name="email"> <label for="fname"></label><br>
	Password: <input type="Password" name="password"><br>
	<input type="submit" name ='btn_login' value='Login'>
</form>

<form action="forgetPassword.php" method="reset">	
	<input type="submit" value="ForgetPassword">
	
</form>


Registration
<form action="connect2.php" method="post">
	E-mail: <input type="text" name="newemail"><br>
	Password: <input type="Password" name="newpassword"><br>
	ReEnterPassword: <input type="Password" name="renewpassword"><br>
	<input type="submit">
</form>
</body>
</html>