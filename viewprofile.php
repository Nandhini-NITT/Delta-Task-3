<?php
	session_start();
	
	if(!isset($_SESSION['user'])){
		header('Location:index.php');
	}
	if(empty($_GET['username'])){
		header('Location:profile.php');
	}
	$user = $_GET['username'];
	include('connect.php');
	$sql = "SELECT username,name,email,phno,gender,Image from users where username like'".$user."%'";
		$result = $conn->query($sql);
	if ($result->num_rows == 1) {
		$row1= $result->fetch_assoc();
	}
	else{
		header('Location:profile.php');
	}
	
?>
<html>
	<head>
	<title><?php echo $row['name']; ?></title>
	</head>
	
	<body>
		<h1>Profile Page</h1>
		<?php echo '<img width="300" height="300" id="dp" src="data:image/jpeg;base64,'.base64_encode( $row1['Image'] ).'"/>';
		
			echo "<br>".$row1['username']."<br>".$row1['email']."<br>".$row1['phno'];
		?>

	</body>
</html>