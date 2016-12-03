<?php
include_once("header.php");
?>

<html>
<body>
<div class="col-sm-6 col-sm-offset-5">
<div class="modal-content">
<div class="modal-header">
<div align="center">

<?php
include_once('db_config.php');
$mysqli = mysqli_connect($servername, $username, $password, $database);
if(isset($_POST['submit'])){
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$confirm_password = md5($_POST['confirm_password']);
	$mobile = $_POST['mobile'];
	$gender = $_POST['gender'];
	$creon = date("Y-m-d");

	if($password == $confirm_password){
		$in="insert into user(first_name,last_name,email,password,mobile,gender,creon) values ('$first_name', '$last_name', '$email', '$password', '$mobile', '$gender', '$creon')";
		$res = $mysqli->query($in);
		if($res){
			$success = "<strong>Success!</strong><br/>You have successfully registered!";
			if($_SESSION['admin_page'] == 'true'){
				header( "refresh:3;url=adminhome.php" );
			}
		}else{
			$fail =  "<strong>Failure!</strong><br/>Oops, Email already exist! <br/>Please Try Again.";
		}
	}else{
		$fail = "<strong>Failure!</strong><br/>Please check your password!<br/>Please Try Again.";
	}
}
	
?>

<?php if(isset($success)){?>
	<div class="alert alert-success">
	<?php echo $success;?>
	</div>
<?php } ?>

<?php if(isset($fail)){?>
	<div class="alert alert-warning">
	<?php echo $fail;?>
	</div>
<?php } ?>

<br/>
<div><img src="../project/img/lock-icon.png" style="width:70px;height:70px;"></div>		
<h4>Create an Account</h4>
<p></p>
</div>
<hr/>

<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
	<div class="form-group">
		FIRST NAME*
		<div class="input-group">
			<input type="text" class="form-control" name="first_name" id="first_name" placeholder="" required >
			<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
		</div>
	</div>
	<div class="form-group">
		LAST NAME*
		<div class="input-group">
			<input type="text" class="form-control" name="last_name" id="last_name" placeholder="" required >
			<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
		</div>
	</div>
	<div class="form-group">
		EMAIL ADDRESS*
		<div class="input-group">
			<input type="email" class="form-control" name="email" id="email" placeholder="" required >
			<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
		</div>
	</div>
	<div class="form-group">
		PASSWORD*
		<div class="input-group">
			<input type="password" class="form-control" name="password" id="password" placeholder="" required >
			<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
		</div>
	</div>
	<div class="form-group">
		CONFIRM PASSWORD*
		<div class="input-group">
			<input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="" required >
			<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
		</div>
	</div>
	<div class="form-group">
		MOBILE NO.*<small class="pull-right">e.g 60182134455</small>
		<div class="input-group">
			<input type="text" class="form-control" name="mobile" id="mobile" placeholder="" required >
			<span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></span>
		</div>
	</div>
	<div class="form-group">
		GENDER :
		<br/>
		<div class="input-group">
			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
			<input type="radio" class="" name="gender" id="gender" value='male'>Male  <br/>  
			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
			<input type="radio" class="" name="gender" id="gender" value='female'>Female
		</div>
	</div>
	<input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right" />
</form>
<div class="clearfix"></div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>

<?php
include_once("footer.php");
?>