<html>
<head>
	<title>Welcome</title>
</head>
<body>
	Welcome!<?php	session_start();
	echo $_SESSION['user'];?>
</body>
</html>