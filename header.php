<?php
session_start();
include_once("db_config.php");
if(empty($_SESSION['user_id'])){
    $_SESSION['user_id'] = 'empty';
}
if(empty($_SESSION['channel_id'])){
    $_SESSION['channel_id'] = 'movie';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Reviews</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/homepage.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
</head>
<body>
    <div class="container">
    <div class="row">
    <div class="col-md-12">
    <nav class="nav">
    <nav class="navbar navbar-inverse navbar-fixed-top container" role="navigation">
        <div class="container">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">REVIEW</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                    <a href="index.php">Home</a>
                    </li>
                    <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Category <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <?php
                    include_once('category_dropdown.php');
                    ?>
                </ul>
                    </li>
                    <li>
                        <a href="contact.php">Contact</a>
                    </li>
                    <li>
                    <a href="about.php">About</a>
                    </li>
                </ul>
<?php
    if(($_SESSION['user_id']) != 'empty'){
?> 
<ul class="nav navbar-nav navbar-right">
<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Setting <span class="caret"></span></a>
<ul class="dropdown-menu">
<li> 
    <a href="userprofile.php">Profile</a>
</li>
<li> 
    <a href="editprofile.php">Edit Profile</a>
</li>
<li> 
    <a href="changepassword.php">Change Password</a>
</li>
<li> 
    <a href="logout.php">Logout</a>
</li>
</ul>
</li>&nbsp;&nbsp;&nbsp;
</ul>

<?php
    }else{
?>
    
<ul class="nav navbar-nav navbar-right">
<li>
    <a href="register.php">Register</a>
</li>
<li><a>|</a></li>
<li>
    <a href="login.php">Login</a>
</li>&nbsp;&nbsp;&nbsp;                       
</ul>
<?php } ?>
</div>
</div>
</nav>
</nav>
</div>
</div>
</div>

<div class="container">

<div class="row">

   <!--  <div class="col-md-3 pull-right">
        <p class="lead" align="center">Category</p>
        <div class="list-group">
            <a href="#" class="list-group-item">Foods</a>
            <a href="#" class="list-group-item">Cars</a>
            <a href="#" class="list-group-item">Gadgets</a>
            <a href="#" class="list-group-item">LifeStyle</a>
        </div>
    </div>
-->
    <div class="col-md-9">

        <div class="row">