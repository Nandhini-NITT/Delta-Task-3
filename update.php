<?php
include "connect.php";
$field="";
$changedvalue="";
foreach($_GET as $param => $value){
$field=$param;
$changedvalue=$value;
}
session_start();
if($field=="Email" || $field=="Phno")
{
	$query = $conn->prepare("SELECT Username FROM users WHERE {$field}=?");
	$query->bind_param('s',$changedvalue);
	$query->execute();
	$query->bind_result($name);
	$query->store_result();
		if($query->num_rows==0)
		{
			$query=$conn->prepare("Update users set {$field}=? where username=?");
			$query->bind_param('ss',$changedvalue,$_SESSION['user']);
			$query->execute();
			$_SESSION[$field]=$changedvalue;
			echo $_SESSION[$field];
		}
		else
			echo 'Given Email/Phone number is already taken';
}
?>