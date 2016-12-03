<?php
include_once('db_config.php');
$id=$_GET['id'];

$mysqli = mysqli_connect($servername, $username, $password, $database);
$result = $mysqli->query("DELETE FROM user WHERE id=$id");
if($result){
	header("location:adminhome.php");
}
?>