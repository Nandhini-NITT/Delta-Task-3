<html>
<head>
	<title>Signup</title>
	<script>
	document.getElementById("files").onchange = function () {
    var reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("imagepreview").src = e.target.result;
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};
	</script>
	<link rel="stylesheet" type="text/css" href="register.css">
</head>
<body>

<div class="header">
	<h1 style="position:absolute;top:0;left:45%">Facelog</h1>
</div>
	<img src="signinbg.jpg" width="400" height="400" style="position:absolute;top:20%;left:10%">
	<form enctype="multipart/form-data" action="registeruser.php" method="post" id="fields">
		<p><span id="errorstatus">* required field.</span></p>
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
				<td><input name="userfile" type="file" id="files" required/></td>
				<td><span class="error">*</span></td>
			</tr>
				<tr><img id="imagepreview"></tr>
		</table>
		<br><br><br>
	<button type="submit" name="submit" value="Submit" onclick="return validateForm();">Submit</button>
	</form>
<script  src="validation.js" type="text/javascript" >
    </script>
</body>
</html>
