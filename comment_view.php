<?php
function commentView($article_id){
	include('db_config.php');

	$mysqli = mysqli_connect($servername, $username, $password, $database);
	$result = $mysqli->query("SELECT * FROM comment WHERE article_id=$article_id"); //select from comment where article id

	echo ('<div id="comment_view">');

		if(($result->num_rows) == 0){
			echo('<p>There is no comment</p>');
		} else {
			while($row = $result->fetch_assoc()){
				$id = $row['id'];
				$date_time = $row['date_time'];
				$comment = $row['comment'];
				$user_id = $row['user_id'];

				echo('<div id="comment_num_'.$id.'">');
				echo('<p>');
				$result_name = $mysqli->query("SELECT first_name, last_name FROM user WHERE id=$user_id");
				while($row_name = $result_name->fetch_assoc()){
					$first_name = $row_name['first_name'];
					$last_name = $row_name['last_name'];
				}
				echo($first_name.', '.$last_name.'<br>');
				echo($date_time.'<br>');
				echo($comment.'<br>');
				echo('</p>');
				echo('<br>');
				echo('</div>');
			}
		}

	echo('</div>');
}
?>