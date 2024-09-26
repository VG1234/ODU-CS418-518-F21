<html>  
<body>
Two Factor Authentication
User    - <?php 
	$newemail = $_POST['email'];
	$password = $_POST['password'];
	$conn = new mysqli('localhost','root','','user');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} 
	else
	{
		$sqlMain = "SELECT Email FROM tempuser WHERE Email='".$newemail."'";
		$sqlpwd = "SELECT Password FROM tempuser WHERE Email='".$newemail."'";
		$resultMain = $conn->query($sqlMain);
		$resultuname = mysqli_fetch_row($resultMain)[0];
		$resultMain = mysqli_num_rows($resultMain);
		$resultpwd = $conn->query($sqlpwd);
		$resultpwd = mysqli_fetch_row($resultpwd)[0];

		//if user exist generate verification code and mail him and move to au 
		if($resultMain >=1 ){
			if($resultuname == $newemail && $resultpwd == $password){
				echo $newemail;
			}else{
				header("Location: http://localhost/login.php?Error=Incorrect Password");
			}


		
		}
		else{
			$conn->close();
			header("Location: http://localhost/login.php?Error=User Not Exist Please register!!");

		}
	}
	$conn->close();

?>

<form action="welcome.php" method="post">
	Code: <input type="text" name="2fCode"><br>
	<input type="submit">
</form>
</body>
</html>