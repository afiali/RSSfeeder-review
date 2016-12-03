<?php
include_once("header.php");
	session_destroy();
	$_SESSION['user_id'] = 'empty';
	header("location:login.php?logout=1");
?>
<?php
include_once("footer.php");
?>