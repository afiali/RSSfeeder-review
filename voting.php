<?php
function voting($article_id) {
	include_once('voting_score.php');
	$user_id = $_SESSION['user_id'];

	include('db_config.php');
	$mysqli = mysqli_connect($servername, $username, $password, $database);
	$result = $mysqli->query("SELECT * FROM vote WHERE user_id=$user_id AND article_id=$article_id");

	echo ('<div id="voting">');
	if($result){
		if(($result->num_rows) > 0){
			while($row = $result->fetch_assoc()){
				$score = $row['score'];
			}
			if($score == 0){
				echo('<button class="button" name='.$article_id.' id="vote_up" value=1 onclick=vote_up('.$article_id.')><img src="icon/thumbsup_0.png"></button>');
				voteUp($article_id);
				echo('<button class="button" name='.$article_id.' id="vote_down" value=-1 onclick=vote_down('.$article_id.')><img src="icon/thumbsdown_0.png"></button>');
				voteDown($article_id);
			} elseif ($score == 1) {
				echo('<button class="button" name='.$article_id.' id="vote_up" value=1 onclick=vote_up('.$article_id.')><img src="icon/thumbsup_1.png"></button>');
				voteUp($article_id);
				echo('<button class="button" name='.$article_id.' id="vote_down" value=-1 onclick=vote_down('.$article_id.')><img src="icon/thumbsdown_0.png"></button>');
				voteDown($article_id);
			} elseif ($score == -1) {
				echo('<button class="button" name='.$article_id.' id="vote_up" value=1 onclick=vote_up('.$article_id.')><img src="icon/thumbsup_0.png"></button>');
				voteUp($article_id);
				echo('<button class="button" name='.$article_id.' id="vote_down" value=-1 onclick=vote_down('.$article_id.')><img src="icon/thumbsdown_1.png"></button>');
				voteDown($article_id);
			}
		} else {
			echo('<button class="button" name='.$article_id.' id="vote_up" value=1 onclick=vote_up('.$article_id.')><img src="icon/thumbsup_0.png"></button>');
			voteUp($article_id);
			echo('<button class="button" name='.$article_id.' id="vote_down" value=-1 onclick=vote_down('.$article_id.')><img src="icon/thumbsdown_0.png"></button>');
			voteDown($article_id);
		}
	} else {
		echo('<button class="button" name='.$article_id.' id="vote_up" value=1 onclick=vote_up('.$article_id.')><img src="icon/thumbsup_0.png"></button>');
		voteUp($article_id);
		echo('<button class="button" name='.$article_id.' id="vote_down" value=-1 onclick=vote_down('.$article_id.')><img src="icon/thumbsdown_0.png"></button>');
		voteDown($article_id);
	}
	echo ('</div>');
}
?>