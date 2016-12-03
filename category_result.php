<?php
include_once('header.php');
include_once('db_config.php');
$mysqli = mysqli_connect($servername, $username, $password, $database);
?>
<style type="text/css">
    ul.rss-items{
        padding:0;
        margin:0;
        list-style:none;
        margin-top:30px;
    }
    ul.rss-items li a{
        display:block;
        border-bottom:1px dotted #CFCFCF;
        padding:20px;
        text-decoration:none;
    }
    ul.rss-items li:last-child a{
        border-bottom:none;
    }
    ul.rss-items li a:hover{
        background-color:#DBF9FF;
    }
    ul.rss-items li span{
        display:block;
    }
    ul.rss-items li span.rss-title{
        font-weight:600;
        color:#8F8F8F;
    }
    ul.rss-items li span.rss-date{
        color:#8F8F8F;
    }
    ul.rss-items li span.rss-description{
        color:#8C8C8C;
    }
    ul.rss-items li p.rss-content{
        display:block;
        color:#A8A8A8;
    }
</style>
<?php

if(isset($_GET['q'])){
    $q=$_GET["q"];
    $_SESSION['channel_id'] = $q;
}

if ($result = $mysqli->query("SELECT id, title, link FROM channel WHERE category='$_SESSION[channel_id]' LIMIT 1")) {
    while($row = $result->fetch_assoc()){
        $channel_id = $row['id'];
        $rss_file = $row['link'];
        $rss_title = $row['title'];
    }
    $result->close();
}

$words = 50; // words per excerpt
$per_page = 5; // entries per page
$range = 3; // number of pages each side of active page in pagination

function excerpt($string, $count) { // excerpt
    $words = explode(' ', $string);
    if (count($words) > $count) {
        $words = array_slice($words, 0, $count);
        $string = implode(' ', $words).'...';
        }
    return $string;
    }

function showPagination($page, $page_count, $range) { // pagination
    echo '<div class="pagination">';
    echo '<span class="pages">Page(s): </span>';
    if ($page > 1) {
        echo '<a href="'.$_SERVER['PHP_SELF'].'?page=1#rss" title="First" class="btn">&lt;&lt;</a> <a href="'.$_SERVER['PHP_SELF'].'?page='.( $page - 1 ).'#rss" title="Previous" class="btn prev">&lt;</a> | ';
        }
    for ($num = ($page - $range); $num < (($page + $range) + 1); $num++) {
        if($num > 0 && $num <= $page_count) {
            if($num == $page) { 
                echo ' <span class="num">'.$num.'</span> |';
                } else {
                echo ' <a href="'.$_SERVER['PHP_SELF'].'?page='.$num.'#rss" class="num">'.$num.'</a> |';
                }
            }
        }
    if ($page != $page_count) {
        echo ' <a href="'.$_SERVER['PHP_SELF'].'?page='.( $page + 1 ).'#rss" title="Next" class="btn next">&gt;</a> <a href="'.$_SERVER['PHP_SELF'].'?page='.$page_count.'#rss" title="Last" class="btn">&gt;&gt;</a> ';
        }
    echo '</div>';
    }

$xmlDoc = new DOMDocument();
$xmlDoc -> load($rss_file);

$x=$xmlDoc->getElementsByTagName('item');

$item_count = $x->length;
$page_count = ceil($item_count / $per_page);
$page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? (int)$_GET['page'] : 1;
if ($page > $page_count) { $page = $page_count; }
if ($page < 1) { $page = 1; }
$remaining = $per_page - (($page * $per_page) - $item_count); 
$offset = (($page - 1) * $per_page);   
if ($remaining < $per_page) { $per_page = $remaining; }

echo '<h2 id="rss">'.$xmlDoc->getElementsByTagName('channel')->item(0)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue.'</h2>';

showPagination($page, $page_count, $range);

echo '<ul class="rss-items">';
for ($i = $offset; $i < ($offset + $per_page); $i++) {
    $item_title=$x->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
    $item_link=$x->item($i)->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
    $item_desc=$x->item($i)->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;
    $item_date=$x->item($i)->getElementsByTagName('pubDate')->item(0)->childNodes->item(0)->nodeValue;
    $item_content=$x->item($i)->getElementsByTagName('encoded')->item(0)->childNodes->item(0)->nodeValue;

    $date_query = date("Y-m-d", strtotime($item_date));
    $result = $mysqli->query("SELECT id FROM article WHERE link ='$item_link' LIMIT 1");

    if(($result->num_rows) == 0){
        $query = "INSERT INTO article (title, link, date_pub, channel_id) VALUES ('$item_title', '$item_link', '$date_query', '$channel_id')";
        $mysqli->query($query);
        if ($mysqli->error) {
            try {   
                throw new Exception("MySQL error $mysqli->error <br> Query:<br> $query", $mysqli->errno);   
            } catch(Exception $e ) {
                echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
                echo nl2br($e->getTraceAsString());
            }
        }
        $article_id = $mysqli->insert_id;
    } else {
        while($row = $result->fetch_assoc()){
            $article_id = $row['id'];
        }
    }
?>
    <li>
    <a href="article_view.php?article=<?php echo $article_id; ?>">
    <span class="rss-title"><?php echo $item_title; ?></span>
    <span class="rss-date"><?php echo date('l F d, Y', strtotime($item_date)); ?></span>
    <span class="rss-description"><?php echo $item_desc; ?></span>
    </a>
    </li>
<?php
}
echo '</ul>';
showPagination($page, $page_count, $range); 

include_once('footer.php');
?>