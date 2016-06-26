<html>
<head>
	<title>Welcome</title>
</head>
<body>
	Welcome!<?php	
	session_start();
	echo $_SESSION['user'];
	echo '<br>';
	?>
<?php
include "connect.php";
echo '<img src="data:image/jpeg;base64,'.base64_encode( $_SESSION['dp'] ).'"/>';
?>
</body>
</html>