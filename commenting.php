<?php 
function commenting($article_id){
	global $article_id;
	echo ('<div id="comment_form">');
	echo ('<textarea name='.$article_id.' id="comment"></textarea>');
	echo ('<br>');
	echo ('<input type="submit" name="submit" id="commentSubmit" value="add comment" onclick=commentSubmit()>');
}
?>
</div>
