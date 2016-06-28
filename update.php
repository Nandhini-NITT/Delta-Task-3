<?php
include "connect.php";
$field="";
$changedvalue="";
foreach($_GET as $param => $value){
$field=$param;
$changedvalue=$value;
}?>
<script>alert("Called update");</script>
<?php
session_start();
$query=$conn->prepare("Update users set {$field}=? where username=?");
$query->bind_param('ss',$changedvalue,$_SESSION['user']);
$query->execute();
$_SESSION[$field]=$changedvalue;
echo $_SESSION[$field];
?><script>alert("updated");</script>
