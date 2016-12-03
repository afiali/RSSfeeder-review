<?php
include_once("header.php");
?>
<style type="text/css">
	ul.output-list{
	    padding:0;
	    margin:0;
	    list-style:none;
	    margin-top:30px;
	}
	ul.output-list li a{
	    display:block;
	    border-bottom:1px dotted #CFCFCF;
	    padding:20px;
	    text-decoration:none;
	}
	ul.output-list li:last-child a{
	    border-bottom:none;
	}
	ul.output-list li a:hover{
	    background-color:#DBF9FF;
	}
	ul.output-list li span{
	    display:block;
	}
	ul.output-list li span.output-title{
	    font-weight:600;
	    color:#8F8F8F;
	}
	ul.output-list li span.output-description{
	    display:block;
	    color:#A8A8A8;
	}
	ul.output-list li span.output-source{
        display:block;
        color:#A8A8A8;
    }
</style>
<?php
include_once('db_config.php');
$mysqli = mysqli_connect($servername, $username, $password, $database);

?>
<ul class="output-list">
<?php

if ($result = $mysqli->query("SELECT link, category, title FROM channel")) {
	while($row = $result->fetch_assoc()){
		$title = $row['title'];
    	$link = $row['link'];
    	$category = $row['category'];
        
        $xmlDoc = new DOMDocument();
        $xmlDoc -> load($link);

        $x=$xmlDoc->getElementsByTagName('item');
		for ($i=0; $i<=0; $i++) {
			?>
			<li>
			<a href="category_result.php?q=<?php echo $category; ?>">
			<?php
		  	$item_title=$x->item($i)->getElementsByTagName('title')
		  	->item(0)->childNodes->item(0)->nodeValue;
		  	$item_link=$x->item($i)->getElementsByTagName('link')
		  	->item(0)->childNodes->item(0)->nodeValue;
		  	$item_desc=$x->item($i)->getElementsByTagName('description')
		  	->item(0)->childNodes->item(0)->nodeValue;
		  	?>
		  	<h4><?php echo $title; ?></h4>
		  	<span class="output-title"><?php echo $item_title; ?></span>
		  	<span class="output-description"><?php echo $item_desc; ?></span>
		  	</a>
		  	</li>
		  	<?php
		}
	}
    $result->close();
}
?>
</ul>
<?php

include_once("footer.php");
?>

<ul class="output-list">
<li>
	<span></span>
	<span></span>
</li>
</ul>