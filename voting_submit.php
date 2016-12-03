<?php
session_start();
include('db_config.php');

$mysqli = mysqli_connect($servername, $username, $password, $database);

$user_id = $_SESSION['user_id'];
$article_id = $_GET['article_id'];
$score = $_GET['score'];

if($user_id != 'empty'){
	$result = $mysqli->query("SELECT id FROM vote WHERE user_id=$user_id AND article_id=$article_id LIMIT 1");
	if(($result->num_rows) == 0){
		$mysqli->query("INSERT INTO vote (user_id, article_id, score) VALUES ($user_id, $article_id, $score)");
	} else {
		while($row = $result->fetch_assoc()){
			$vote_id = $row['id'];
		}
		$mysqli->query("UPDATE vote SET score=$score WHERE id=$vote_id");
	}
	header("location:article_view.php?article=".$_SESSION['article_id']);
}else{
	header("location:login.php?message=1");
}
?>