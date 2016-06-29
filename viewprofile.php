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
	$sql = "SELECT username,name,email,phno,gender from users where username like'".$search_text."%'";
		$result = $conn->query($sql);
	if ($result->num_rows == 1) {
		while($row = $result->fetch_assoc());
	}
	else{
		header('Location:profile.php');
	}
?>
<html>
	<head>
	<title><?php echo $row['name']; ?></title>
	<link href='profile page.css' rel='stylesheet'>
	</head>
	
	<body>
		<h1>Profile Page</h1>
		<img src="<?php echo $row['Image']; ?>" height="300px" width="300px">

		<?php 
			echo "<br>".$row['username']."<br>".$row['email']."<br>".$row['phno'];
		?>

	</body>
</html>