<?php
	$email=$_POST['email'];
	$newpassword = $_POST['newpassword'];
	$renewpassword = $_POST['renewpassword'];


 $conn = new mysqli('localhost','root','','user');
    if($conn->connect_error){
        echo "$conn->connect_error";
        die("Connection Failed : ". $conn->connect_error);
    } else {
        //insert in to Verifies user table
        if($newpassword== $renewpassword){
        $sqlInDetails = "UPDATE tempuser SET tempuser.Password='".$newpassword."' WHERE tempuser.Email ='".$email."'";
        $result = $conn->query($sqlInDetails);
        header("Location: http://localhost/login.php?Error=Password Updated");
        
    	}
	}
	$conn->close();


?>
