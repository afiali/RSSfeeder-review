<?php
include_once('header.php');
include_once('db_config.php');
$mysqli = mysqli_connect($servername, $username, $password, $database);
?>

<style>
    h1.article-title{
        font-weight:600;
        color:#8F8F8F;
    }
    span.article-date{
        color:#8F8F8F;
    }
    p.article-content{
        color:#8C8C8C;
    }
    span.article-link{
        display:block;
        color:#A8A8A8;
    }

    #comment_form textarea {
        border: 4px solid rgba(0,0,0,0.1);
        padding: 8px 10px;
        
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        
        outline: 0;
    }

    #comment_form textarea {
        width: 350px;
    }

    #comment_form input[type="submit"] {
        cursor: pointer;
        background: -webkit-linear-gradient(top, #efefef, #ddd);
        background: -moz-linear-gradient(top, #efefef, #ddd);
        background: -ms-linear-gradient(top, #efefef, #ddd);
        background: -o-linear-gradient(top, #efefef, #ddd);
        background: linear-gradient(top, #efefef, #ddd);
        color: #333;
        text-shadow: 0px 1px 1px rgba(255,255,255,1);
        border: 1px solid #ccc;
    }

    #comment_form input[type="submit"]:hover {
        background: -webkit-linear-gradient(top, #eee, #ccc);
        background: -moz-linear-gradient(top, #eee, #ccc);
        background: -ms-linear-gradient(top, #eee, #ccc);
        background: -o-linear-gradient(top, #eee, #ccc);
        background: linear-gradient(top, #eee, #ccc);
        border: 1px solid #bbb;
    }

    #comment_form input[type="submit"]:active {
        background: -webkit-linear-gradient(top, #ddd, #aaa);
        background: -moz-linear-gradient(top, #ddd, #aaa);
        background: -ms-linear-gradient(top, #ddd, #aaa);
        background: -o-linear-gradient(top, #ddd, #aaa);
        background: linear-gradient(top, #ddd, #aaa);   
        border: 1px solid #999;
    }

    #voting {
        padding: 20px;
        
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
    }

    #voting_score {
        padding: 5px 20px;
        
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
    }

    #comment_view {
        padding: 20px;
        
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
    }

    .button {
       border: 1px solid #DDD;
       border-radius: 3px;
       text-shadow: 0 1px 1px white;
       -webkit-box-shadow: 0 1px 1px #fff;
       -moz-box-shadow:    0 1px 1px #fff;
       box-shadow:         0 1px 1px #fff;
       font: bold 11px Sans-Serif;
       padding: 6px 10px;
       white-space: nowrap;
       vertical-align: middle;
       color: #666;
       background: transparent;
       cursor: pointer;
    }
    .button:hover, .button:focus {
       border-color: #999;
       background: -webkit-linear-gradient(top, white, #E0E0E0);
       background:    -moz-linear-gradient(top, white, #E0E0E0);
       background:     -ms-linear-gradient(top, white, #E0E0E0);
       background:      -o-linear-gradient(top, white, #E0E0E0);
       -webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.25), inset 0 0 3px #fff;
       -moz-box-shadow:    0 1px 2px rgba(0,0,0,0.25), inset 0 0 3px #fff;
       box-shadow:         0 1px 2px rgba(0,0,0,0.25), inset 0 0 3px #fff;
    }
    .button:active {
       border: 1px solid #AAA;
       border-bottom-color: #CCC;
       border-top-color: #999;
       -webkit-box-shadow: inset 0 1px 2px #aaa;
       -moz-box-shadow:    inset 0 1px 2px #aaa;
       box-shadow:         inset 0 1px 2px #aaa;
       background: -webkit-linear-gradient(top, #E6E6E6, gainsboro);
       background:    -moz-linear-gradient(top, #E6E6E6, gainsboro);
       background:     -ms-linear-gradient(top, #E6E6E6, gainsboro);
       background:      -o-linear-gradient(top, #E6E6E6, gainsboro);
    }
    #score {
        padding: 5px 20px;
    }
</style>

<?php
$article_id = $_GET['article'];
$_SESSION['article_id'] = $article_id;

$query = "SELECT title, channel_id FROM article WHERE id = $article_id LIMIT 1";
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
$article_title = $row['title'];
$channel_id = $row['channel_id'];

$query = "SELECT link FROM channel WHERE id = $channel_id LIMIT 1";
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
$channel_link = $row['link'];

$xmlDoc = new DOMDocument();
$xmlDoc->load($channel_link);

$x=$xmlDoc->getElementsByTagName('title');

for ($i=0; $i<=$x->length-1; $i++) {
  //Process only element nodes
  if ($x->item($i)->nodeType==1) {
    if ($x->item($i)->childNodes->item(0)->nodeValue == $article_title) {
      $y=($x->item($i)->parentNode);
    }
  }
}

$item_title=$y->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
$item_link=$y->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
$item_desc=$y->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;
$item_date=$y->getElementsByTagName('pubDate')->item(0)->childNodes->item(0)->nodeValue;
$item_content=$y->getElementsByTagName('encoded')->item(0)->childNodes->item(0)->nodeValue;
?>

<h1 class="article-title"><?php echo $item_title; ?></h1>
<span class="article-date"><?php echo date('l F d, Y', strtotime($item_date)); ?></span>
<p class="article-content"><?php echo $item_content; ?></p>
<span class="article-link">source :<a href="<?php echo $item_link; ?>"><?php echo $item_link; ?></a></span>

<?php
include_once('voting.php');
voting($article_id);

include_once('comment_view.php');
commentView($article_id);

include_once('commenting.php');
commenting($article_id);

$mysqli->close();
include_once('footer.php');
?>