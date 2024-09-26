<?php
$email = $_GET['userEmail'];


 $conn = new mysqli('localhost','root','','user');
    if($conn->connect_error){
        echo "$conn->connect_error";
        die("Connection Failed : ". $conn->connect_error);
    } else {

        $sqlMain = "SELECT status FROM tempuser WHERE  status ='Approved' && Email='".$email."' ";
		$resultMain = $conn->query($sqlMain);
		$resultuname = mysqli_fetch_row($resultMain)[0];
		
        $sqlInDetails = "UPDATE tempuser SET tempuser.status='Approved' WHERE tempuser.Email ='".$email."'";
        $result = $conn->query($sqlInDetails);
        
        echo "User- ".$email." Successfully approved!";
						
	        
		//send verification mail
		$to_email =$email;
		$subject = "User Approved";
		$body = "Hi ". $to_email.", your account is approved you can now login http://localhost/login.php ";
		$headers = "From: Admin";

			if (mail($to_email, $subject, $body, $headers)) {
			 echo "Email successfully sent to $to_email...";
			} else {
				  echo "Email sending failed...";
			}
		
					
        //header("Location: http://localhost/login.php");
    }
	$conn->close();


?>