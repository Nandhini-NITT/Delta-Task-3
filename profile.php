<html>
<head>
	<title>Welcome</title>
	<script src="jquery-1.12.2.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="profile.css">
	<link href='https://fonts.googleapis.com/css?family=Lora:400,700italic' rel='stylesheet' type='text/css'>
</head>
<body>
	<?php if(!isset($_SESSION)==0)
		header("Location: index.php");
	?>
	<p align="center">Welcome  <?php	
	session_start();
	echo '<br>';
	?> &nbsp <span class='glyphicon glyphicon-search'></span><input type="text" placeholder="Find What's up with your friends" style="width:280px;"></p>

<?php
include "connect.php";
echo '<img src="data:image/jpeg;base64,'.base64_encode( $_SESSION['dp'] ).'"/>';
?>
<div id="id01" class="modal">
	
	<div class="modal-content" id="change">
		</div>
	</div>
</div>	
<div id="contents">
	<h1 style="position:relative;left:25px">Contact Information</h1>
	<hr color="black">
	<table>
		<div id="name">
		<tr>
			<td width="30%">Name</td>
			<td width="40%" id="valueName"><?php echo $_SESSION['name']?></td>
			<td width="20%"><button type="button" class="btn btn-default" onclick="updatename();"><span class="glyphicon glyphicon-pencil icon-success"></span> Edit</button></td>
		</tr>
		</div>
		<div id="gender">
		<tr>
			<td>Gender</td>
			<td id="valueGender"><?php printf("%s",$_SESSION['gender']);?></td>
			<td><button type="button" class="btn btn-default" onclick="updategender();"><span class="glyphicon glyphicon-pencil icon-success"></span> Edit</button></td>
		</tr>
		</div>
		<div id="email">
		<tr>
			<td>Email</td>
			<td id="valueEmail"><?php echo $_SESSION['email']?></td>
			<td><button type="button" class="btn btn-default" onclick="updatemail();"><span class="glyphicon glyphicon-pencil icon-success"></span> Edit</button></td>
		</tr>
		</div>
		<div id="phno">
		<tr>
			<td>Phone number</td>
			<td id="valuePhno"><?php echo $_SESSION['phno']; ?></td>
			<td><button type="button" class="btn btn-default" onclick="updatephno();"><span class="glyphicon glyphicon-pencil icon-success"></span> Edit</button></td>
		</tr>
		</div>
	</table>
	<br>
		<button align="center" style="position:relative;left:25%" onclick="updatepassword()">Change Password</button>
	<br>
	<br>
	<input type="button" onclick="document.location.href='logout.php'" value="Logout" style="position:relative;left:30%">
</div>
<script>
var param="";
	function updatename()
	{
		param="Name";
		document.getElementById("name").style.display="none";
		var modal=document.getElementById("id01");
		modal.style.display="block";
		document.getElementById("change").innerHTML="<button onclick=document.getElementById('id01').style.display='none';>&times;</button><center><table><tr><td>Enter Name:</td><td><input type='text' id='changedvalue'></td><td><button onclick='send()'>Submit</button></td></tr></table></center>";
	}
	function updategender()
	{
		param="Gender";
		document.getElementById("gender").style.display="none";
		var modal=document.getElementById("id01");
		modal.style.display="block";
		document.getElementById("change").innerHTML="<button onclick=document.getElementById('id01').style.display='none';>&times;</button><center><table><tr><td>Gender:</td><td><input type='text' id='changedvalue'></td><td><button onclick='send()'>Submit</button></td></tr></table></center>";
	}
	function updatemail()
	{
		param="Email";
		document.getElementById("email").style.display="none";
		var modal=document.getElementById("id01");
		modal.style.display="block";
		document.getElementById("change").innerHTML="<button onclick=document.getElementById('id01').style.display='none';>&times;</button><center><table><tr><td>Email Id:</td><td><input type='email' id='changedvalue'></td><td><button onclick='send()'>Submit</button></td></tr></table></center>";
	}
	function updatephno()
	{
		param="Phno";
		var modal=document.getElementById("id01");
		modal.style.display="block";
		document.getElementById("change").innerHTML="<button onclick=document.getElementById('id01').style.display='none';>&times;</button><center><table><tr><td>Phone Number:</td><td><input type='text' id='changedvalue'></td><td><button onclick='send()'>Submit</button></td></tr></table></center>";
	}
	function send()
	{
		var newvalue=document.getElementById("changedvalue").value;
		var renumber=/[0-9]/;
		var iChars = "!@#$%^&*()+=-[]\';,./{}|\":<>?~_";
		var relower=/[a-z]/;
		var reupper=/[A-Z]/;
		if(param=="Name")
		{
			for (var i = 0; i < newvalue.length; i++) 
			{
				if (iChars.indexOf(newvalue.charAt(i)) != -1) {
				alert ("Your string has special characters.These are not allowed.");
				return false;
				}
			}
			if(renumber.test(newvalue))
			{
				alert("Name Can only contain letters and spaces");
				return;
			}
		}
		else if(param=="Gender")
		{
			if(newvalue!="M" && newvalue!="F")
				{
					alert("Gender can be only M/F :M - Male F-Female");
					return;
				}
		}
		else if(param=="Phno")
		{
			if(newvalue.length<8 || relower.test(newvalue) ||reupper.test(newvalue) )
			{
				alert("Enter valid phone number");
				return;
			}
		}
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			if(xhttp.responseText=="Given Email/Phone number is already taken")
			{
				alert("Given Email id/Phone number is already taken");
				return;
			}
			document.getElementById("id01").style.display="none";
			document.getElementById("value"+param).innerHTML=xhttp.responseText;
			
		}
		};
		xhttp.open("GET", "update.php?"+param+"="+newvalue, true);
		xhttp.send();
	}
	
</script>
</body>
</html>