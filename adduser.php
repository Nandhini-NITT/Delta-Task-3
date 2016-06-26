<?php
	session_start();
	$name=$_POST["uname"];
	$email=$_POST["email"];
	$phno=(string) $_POST["phno"];
	$gender=$_POST["gender"];
	$pass=SHA1($_POST["pass"]);
	if(!isset($_FILES['userfile']))
	{
    echo '<p>Please select a file</p>';
	}
else
{
	$image = $_FILES['userfile']['tmp_name'];
    $img = file_get_contents($image);
}
include("connect.php");
	$query = $conn->prepare("SELECT Username FROM users WHERE Phno= ? or email=?");
	$query->bind_param('ss',$phno, $email);
	$query->execute();
	$query->bind_result($name);
	$query->store_result();
	if($query->num_rows==0)
	{
		
		$stmt=$conn->prepare("INSERT INTO users (Username,email,Phno,Gender,Passcode,Image) VALUES (?, ?, ?, ?, ? ,?)");
		$stmt->bind_param('ssssss', $name, $email, $phno, $gender, $pass,$img);
		
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