<html>
<head>
	<title>Signup</title>
	<link rel="stylesheet" type="text/css" href="register.css">
</head>
<body>
<?php
	$status="";
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
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
			if($stmt->execute())
			{
				echo "Update successful";
				$_SESSION["user"]=$name;
				$_SESSION["dp"]=$img;
				$_SESSION["email"]=$email;
				$_SESSION["phno"]=$phno;
				$_SESSION["gender"]=$gender;
				header("Location: profile.php");
			}
		}
		else
			$status="The emailid/password is already registered";
			
	}
?>
<div class="header">
	<h1 style="position:absolute;top:0;left:45%">Facelog</h1>
</div>
	<img src="signinbg.jpg" width="400" height="400" style="position:absolute;top:20%;left:10%">
	<form enctype="multipart/form-data" action="" method="post" id="fields" onsubmit="return validateForm()">
		<p><span id="errorstatus">* required field.
		<?php if($status!="")
				{?><script>document.getElementById("errorstatus").innerHTML="";</script>
		<?php
				echo $status;
				}
				?></span></p>
		<table>
			<tr>
				<td>Full Name:</td>
				<td><input type="text" name="name" required></td>
				<td><span class="error">*</span></td>
			</tr>
			<tr>
				<td>Username:</td>
				<td><input type="text" name="uname" required></td>
				<td><span class="error">* </span></td>
			</tr>
			<tr>
				<td>Email id:</td>
				<td><input type="email" name="email" required></td>
				<td><span class="error">* </span></td>
			</tr>
			<tr>
				<td>Phone Number:</td>
				<td><input type="number" name="phno" required></td>
				<td><span class="error">*</span></td>
			</tr>
			<tr> 
				<td>Gender:(M-Male F-Female)</td>
				<td><input type="text" name="gender" required></td>
				<td><span class="error">* </span><td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="pass" required></td>
				<td><span class="error">*</span><td>
			</tr>
			<tr>
				<td>Profile Picture</td>
				<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
				<td><input name="userfile" type="file" required/></td>
				<td><span class="error">*</span></td>
			</tr>
		</table>
		<br><br><br>
	<button type="submit" name="submit" value="Submit">Submit</button>
	</form>
<script>
	function validateForm()
	{
		var name=document.forms["fields"]["uname"].value;
		var email=document.forms["fields"]["email"].value;
		var phno=document.forms["fields"]["phno"].value.toString();
		var gender=document.forms["fields"]["gender"].value;
		var password=document.forms["fields"]["password"].value;
		var letternumber=/^[a-zA-Z0-9]+$/;
		var renumber=/[0-9]/;
		var relower=/[a-z]/;
		var reupper=/[A-Z]/;
		var apos=email.indexOf("@");
		var dotpos=email.indexOf(".");
		var error=0;
		if(!name.match(letternumber))
		{
			alert("Username can contain only letters and numbers");
			error=1;
			document.forms["fields"]["uname"].focus()
		}
		
		else if(name.length<5 || name.length>15)
			{
			alert("Username must contain 5-15 characters");
			error=1;
			document.forms["fields"]["uname"].focus();
			}
		else if(phno.length<8)
			{
				alert("Enter valid phone number");
				error=1;
				document.forms["fields"]["phno"].focus();
			}
		else if(gender!="M" && gender!="F")
		{
			alert("Gender has to be M or F");
			error=1;
			document.forms["fields"]["gender"].focus();
		}
		else if(password.length<5 || password.length>8)
		{
			alert("Password must contain 5-8 characters");
			error=1;
			document.forms["fields"]["password"].focus();
		}
		else if(password.match(name))
		{
			alert("Username Should be different from password");
			error=1;
			document.forms["fields"]["password"].focus();
		}
		else if(!renumber.test(password) || !relower.test(password) || !reupper.test(password))
		{
			alert("Password must contain atleast 1 number,1 lowercase alphabet,1 upper case alphabet");
			error=1;
			document.forms["fields"]["password"].focus();
		}
	if(error==1)
		return false;
	else return true;

	}
</script>
</body>
</html>
	