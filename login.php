<?php
include_once("header.php");
$mysqli = mysqli_connect($servername, $username, $password, $database);
?>
<html>
<body>
<div class="col-sm-6 col-sm-offset-5">
<div class="modal-content">
<div class="modal-header">
<div align="center">

<?php
/*
admin login
email : admin@panel.com
password : revadmin123
*/

if(isset($_GET['message'])){
	$message = $_GET['message'];
	if($message == 1){
		$fail = "Please login to vote";
	}else if($message == 2) {
		$fail = "Please login to comment";
	}
}

if(isset($_GET['logout'])){
	$success =  "You have successfully Logged Out!";
}
if(isset($_POST['submit'])){
	$email = mysqli_real_escape_string($mysqli, $_POST['email']);
	$password = md5($_POST['password']);
	$sql = "select * from user where email='".$email."' and password='".$password."'";
	$res = $mysqli->query($sql) or die(mysqli_error());
	if($email == 'admin@panel.com' && $password == 'af28f64ff336e9e7abbbcbbebf21198f'){
		header("location:adminhome.php");
	}
	if($res->num_rows==0){
		$fail =  "<strong>Warning!</strong><br/>Invalid Username/Password.";
	}else{
		while($result = $res->fetch_assoc()){
			$_SESSION['user_id']=$result['id'];
			$_SESSION['name']=$result['first_name']." ".$result['last_name'];
			if(isset($_SESSION['article_id'])){
				header("location:article_view.php?article=".$_SESSION['article_id']);
			}else{
				header("location:index.php");
			}
		}		
	}
}
?>

<?php if(isset($info)){?>
	<div class="alert alert-info">
	<?php echo $info;?>
	</div>
<?php } ?>
<?php if(isset($fail)){?>
	<div class="alert alert-warning">
	<?php echo $fail;?>
	</div>
<?php } ?>
<?php if(isset($success)){?>
	<div class="alert alert-success">
	<?php echo $success;?>
	</div>
<?php } ?>

<br/>
<div><img src="../project/img/lock-icon.png" style="width:70px;height:70px;"></div>
					
<h4>Log in</h4>
<p></p>
</div>
<hr/>

<form role="form" method='post'>
	<div class="form-group">
		<div class="input-group">
			<input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required>
			<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
		</div>
	</div>
	<div class="form-group">
		<div class="input-group">
			<input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
			<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
		</div>
	</div>
	<input type="submit" name="submit" id="submit" value="Login" class="btn btn-info pull-right" />
</form>
<div class="clearfix"></div>
   </div>
</div>
</div>
</div>
</body>
</html>

<?php
include_once("footer.php");
?>