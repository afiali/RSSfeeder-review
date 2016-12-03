<?php
session_start();
include_once('db_config.php');
$mysqli = mysqli_connect($servername, $username, $password, $database);

$comment = $_GET['comment'];
$article_id = $_GET['article_id'];
$user_id = $_SESSION['user_id'];
$date = date("Y-m-d H:i:s");

if(isset($comment)){
	if($user_id != 'empty'){
		if($comment == ""){
			header("location:article_view.php?article=".$_SESSION['article_id']);
		}else{
			$mysqli->query("INSERT INTO comment (date_time, comment, user_id, article_id) VALUES ('$date', '$comment', '$user_id', '$article_id')");
			header("location:article_view.php?article=".$_SESSION['article_id']);
		}
	}else{
		header("location:login.php?message=2");
	}
} else {
	header("location:article_view.php?article=".$_SESSION['article_id']);
}
$mysqli->close();
?>