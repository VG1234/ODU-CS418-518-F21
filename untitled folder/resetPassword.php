<?php
// this is for registration(new user)
	$newemail = $_POST['email'];
	
	// Database connection
	$conn = new mysqli('localhost','root','','user');
	if($conn->connect_error)
	{

		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} 
	else 
	{
		//checks email already registered!
		$sqltemp = "SELECT Email FROM tempuser WHERE Email='".$newemail."'";
		$resultTemp = $conn->query($sqltemp);
		$resultTemp = mysqli_num_rows($resultTemp);
		//if email is not in verifiedusers database and pwd and repwd matches
		
		if( $resultTemp >=1)//update and resende the verification mail
		{
				//resend verification mail
				$to_email = $newemail;
				$subject = "Reset Password";
				$body = "Hi ". $to_email.", This is test email send to reset the password http://localhost/setPassword.php?userEmail=".$to_email." ";
				$headers = "From: Company";

				if (mail($to_email, $subject, $body, $headers)) {
				    echo "Email successfully sent to $to_email...";
				} else {
				    echo "Email sending failed...";
				}

		}
		else
		{

			header("Location: http://localhost/login.php?Error=User Not Exist Please register!!");
		}
		

	}
		
		
	$conn->close();
	
?>

