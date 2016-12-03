<?php
function votingScore($article_id) {
	include('db_config.php');
	$mysqli = mysqli_connect($servername, $username, $password, $database);

	$result = $mysqli->query("SELECT SUM(score) AS result FROM vote WHERE article_id=$article_id");
	while($row = $result->fetch_assoc()){
		$total_vote = $row['result'];
	}
	if(isset($total_vote)){
		$mysqli->query("UPDATE article SET voting_score=$total_vote WHERE id=$article_id");
	}

	echo ('<div id="voting_score">');
	$result = $mysqli->query("SELECT voting_score FROM article WHERE id=$article_id");
	if(($result->num_rows) == 0){
		echo('<p>Article not exist</p>');
	} else {
		while($row = $result->fetch_assoc()){
			$voting_score = $row['voting_score'];
			echo('<p>voting score : '.$voting_score.'</p>');
		}
	}
	echo ('</div>');

	$mysqli->close();
}

function voteUp($article_id) {
	include('db_config.php');
	$mysqli = mysqli_connect($servername, $username, $password, $database);

	$result = $mysqli->query("SELECT score FROM vote WHERE article_id=$article_id AND score=1");
	$total_vote_up = $result->num_rows;

	echo('<span id="score">'.$total_vote_up.'</span>');
}

function voteDown($article_id) {
	include('db_config.php');
	$mysqli = mysqli_connect($servername, $username, $password, $database);

	$result = $mysqli->query("SELECT score  FROM vote WHERE article_id=$article_id AND score=-1");
	$total_vote_down = $result->num_rows;

	echo('<span id="score">'.$total_vote_down.'</span>');
}
?>