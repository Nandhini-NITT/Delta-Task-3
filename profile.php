<html>
<head>
	<title>Welcome</title>
	<script src="jquery-1.12.2.min.js"></script>
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
	echo $_SESSION['name'];
	echo '<br>';
	?> &nbsp <span class='glyphicon glyphicon-search'></span><input type="text" placeholder="Find What's up with your friends" style="width:280px;"></p>
<?php
include "connect.php";
echo '<img src="data:image/jpeg;base64,'.base64_encode( $_SESSION['dp'] ).'"/>';
?>
<div id="contents">
	<table>
		<tr>
			<td>Username</td>
			<td><?php echo $_SESSION['user']?></td>
		</tr>
		<tr>
			<td>Gender</td>
			<td><?php echo $_SESSION['gender']?></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><?php echo $_SESSION['email']?></td>
		</tr>
		<tr>
			<td>Phone number</td>
			<td><?php echo $_SESSION['phno'] ?></td>;
		</tr>
	</table>
	<br>
	<input type="button" onclick="document.location.href='logout.php'" value="Logout">
</div>
</body>
</html>