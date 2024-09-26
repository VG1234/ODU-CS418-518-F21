<?php
$email = $_GET['userEmail'];


 $conn = new mysqli('localhost','root','','user');
    if($conn->connect_error)
    {
        echo "$conn->connect_error";
        die("Connection Failed : ". $conn->connect_error);
    } else 
    {
        //insert in to Verifies user table
         $sqlMain = "SELECT status FROM tempuser WHERE  status ='Verified' && Email='".$email."' ";
		$resultMain = $conn->query($sqlMain);
		$resultuname = mysqli_fetch_row($resultMain)[0];
		
	        $sqlInDetails = "UPDATE tempuser SET tempuser.status= 'Verified' WHERE tempuser.Email ='".$email."'";
	        $result = $conn->query($sqlInDetails);
	        
	        echo "User- ".$email." Successfully verified! please wait for the Admins approval";
        

        		//send aproval mail to admin
        			$sqlMain = "SELECT Email FROM tempuser WHERE role='admin'";
					$resultMain = $conn->query($sqlMain);
					$noRows =mysqli_num_rows($resultMain);
					for ($i = 0; $i < $noRows ; $i++)
					{
						$to_admin_email = mysqli_fetch_row($resultMain)[$i];
						
	        
						//send verification mail
						$to_email =$email;
						$subject = "Approve the user";
						$body = "Hi ". $to_admin_email.", This is the approval mail for the user".$to_email." please click the following link for approval  http://localhost/approve.php?userEmail=".$to_email." ";
						$headers = "From: Admin";

							if (mail($to_admin_email, $subject, $body, $headers)) {
							    echo "Email successfully sent to $to_email...";
							} else {
							    echo "Email sending failed...";
							}
					}
			
    }
	$conn->close();
?>

