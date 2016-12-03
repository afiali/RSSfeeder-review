<?php
include_once('db_config.php');
$mysqli = mysqli_connect($servername, $username, $password, $database);
if ($result = $mysqli->query("SELECT category FROM channel")) {
	while($row = $result->fetch_assoc()){
    	$category = $row['category'];
    	echo ('<li><a href="category_result.php?q='.$category.'">'.$category.'</a></li>');
	}
    $result->close();
}
echo("</select>");
?>