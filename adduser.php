<?php
	session_start();
	$name=$_POST["uname"];
	$email=$_POST["email"];
	$phno=(string) $_POST["phno"];
	$gender=$_POST["gender"];
	$pass=SHA1($_POST["password"]);
	include("connect.php");
	$query = $conn->prepare("SELECT Username FROM users WHERE Phno= ? or email=?");
	$query->bind_param('ss',$phno, $email);
	$query->execute();
	$query->bind_result($name);
	$query->store_result();
	if($query->num_rows==0)
	{
		$stmt=$conn->prepare("INSERT INTO users (Username,email,Phno,Gender,Passcode) VALUES (?, ?, ?, ?, ?)");
		$stmt->bind_param('sssss', $name, $email, $phno, $gender, $pass);
		
		if($stmt->execute()){
			echo "Update successful";
			
		}
		else{
        echo "Update failed";
		}
	}
	else
	 echo "The emailid/password is already registered";
?>