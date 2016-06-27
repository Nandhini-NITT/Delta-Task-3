<html>
<head>
	<title>Welcome to Facelog</title>
	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<?php
	session_start();
	if(isset($_SESSION['user'])==1)
	{
		header("Location: profile.php");
	}
	else
	{
		if($_SERVER['REQUEST_METHOD']=="POST" )
		{
			include "connect.php";
			$user=$_POST["uname"];
			$pass1=SHA1($_POST["password"]);
			$sql=$conn->prepare("SELECT username,name,passcode,Image,email,phno,gender from users where username=?");
			$sql->bind_param('s',$user);
			$sql->execute();
			$row = new StdClass;
			$row->id = null;
			$row->pass = "";
			$row->image="";
			$row->phno="";
			$row->gender="";
			$row->email="";
			$row->name="";
			$sql->bind_result($row->id,$row->name,$row->pass,$row->image,$row->email,$row->phno,$row->gender);
			while (($status = $sql->fetch()) === true) 
			{ 
				if($pass1===$row->pass)
				{
					$_SESSION["name"]=$row->name;
					$_SESSION["user"]=$row->id;
					$_SESSION["dp"]=$row->image;
					$_SESSION["email"]=$row->email;
					$_SESSION["phno"]=$row->phno;
					$_SESSION["gender"]=$row->gender;
					header("Location: profile.php");
				}
			}
		if($status=$sql->fetch()==false || $pass!==$row->pass)
	?>
	<script>	alert("Invalid username or password");</script>
<?php
		}	
	}

?>
<h1 align="center">Welcome To Facelog</h1>
<img src="bg.jpg" width="500" height="500" style="position:absolute;left:20%;top:20%">
	<form action="" method="post" style="float:right;top:20%;position:relative" id="signin">
		<h1 align="center">SIGNIN</h1>
		<table>
		<tr>
			<td>Username:</td>
			<td><input type="text" name="uname"></td>
		</tr>
		<tr></tr>
		<tr></tr>
		<tr>
			<td>Password:</td>
			<td><input type="password" name="password"></td>
		</tr>
		<tr></tr>
		<tr></tr>
		</table>
		<button type="submit" name="submit" value="Submit">Submit</button>
	</form>
	<p style="top:55%;left:85%;position:absolute">Not registered yet?<input type="button" onClick="document.location.href='adduser.php'" value="Signup">
</body>
</html>