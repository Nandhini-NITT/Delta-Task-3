<html>
<head>
	<title>Welcome to Facelog</title>
</head>
<body>
<?php
session_start();
/*if(isset($_SESSION['user'])==1)
{
	header("Location: profile.php");
}*/
//else
//{
if($_SERVER['REQUEST_METHOD']=="POST" )
{
include "connect.php";
$user=$_POST["uname"];
$pass1=SHA1($_POST["password"]);
$sql=$conn->prepare("SELECT username,passcode,Image from users where username=?");
$sql->bind_param('s',$user);
$sql->execute();
$row = new StdClass;
    $row->id = null;
    $row->pass = "";
	$row->image="";
    $sql->bind_result($row->id, $row->pass,$row->image);
while (($status = $sql->fetch()) === true) { 
		echo "Entered loop";
		
		if($pass1===$row->pass)
		{
		$_SESSION["user"]=$row->id;
		$_SESSION["dp"]=$row->image;
		header("Location: profile.php");
		}
    }
	echo "Invalid username or password";
}
//}
?>
	<form action="" method="post">
		<input type="text" name="uname">
		<input type="password" name="password">
		<button type="submit" name="submit" value="Submit">Submit</button>
	</form>
</body>
</html>