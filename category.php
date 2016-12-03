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
</style>
<?php
include_once('db_config.php');