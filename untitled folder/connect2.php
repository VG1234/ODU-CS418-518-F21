<?php
// this is for registration(new user)
	$newemail = $_POST['newemail'];
	$newpassword = $_POST['newpassword'];
	$renewpassword = $_POST['renewpassword'];

	// Database connection
	$conn = new mysqli('localhost','root','','user');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		//checks email already verified!
		$sqlMain = "SELECT Email FROM tempuser WHERE Email='".$newemail."'";
		$resultMain = $conn->query($sqlMain);
		$resultMain = mysqli_num_rows($resultMain);
		//if email is not in verifiedusers database and pwd and repwd matches
		if ( $resultMain >=1)
		{
			echo "User- ".$newemail."  Already Exist!!! please use another email address";
		}
		else
		{
			if( $resultMain ==0 && $newpassword==$renewpassword)
			{ 
				$stmt = $conn->prepare("insert into tempuser(Email, Password) values(?, ?)");
				$stmt->bind_param('ss',$newemail, $newpassword);
				$execval = $stmt->execute();
				$sqlMain = "UPDATE tempuser SET tempuser.role = 'normal', tempuser.status ='notVerified', tempuser.code='2125f'  WHERE Email='".$newemail."'";
				$resultMain = $conn->query($sqlMain);
				echo $execval;
				echo "Registration successfully...";
				//send verification mail
				$to_email = $newemail;
				$subject = "Simple Email Test via PHP";
				$body = "Hi ". $to_email.", This is test email send by PHP Script http://localhost/verification.php?userEmail=".$to_email." ";
				$headers = "From: sender email";

				if (mail($to_email, $subject, $body, $headers)) {
				    echo "Email successfully sent to $to_email...";
				} else {
				    echo "Email sending failed...";
				}
				$stmt->close();
			}
			
			else
			{
				echo "Registration failed...";
		}

	}
		
		
	$conn->close();
	}
?>

