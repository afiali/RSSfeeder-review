<?php
include_once("header.php");
if(isset($_GET['id'])){
	$id = $_GET['id'];
} else {
	$id = $_SESSION['user_id'];
}
$mysqli = mysqli_connect($servername, $username, $password, $database);
?>

<html>
<body>
<div class='col-sm-6 col-sm-offset-5'>
<div class='modal-content'>
<div class='modal-header'>
<div align='center'>


<?php


if(isset($_POST['submit'])){
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$gender = $_POST['gender'];
	$creon = date("Y-m-d");
	$update=$mysqli->query("UPDATE user SET first_name='$first_name', last_name='$last_name', email='$email', mobile='$mobile', gender='$gender' WHERE id=$id");
	if($update){
		$success = "Your profile have been successfully updated!";
		if($_SESSION['admin_page'] == 'true'){
			header( "refresh:3;url=adminhome.php" );
		}
	}else{
		$fail =  "Oops, Something went wrong. <br/>Please Try Again.";
		}
	}
?>

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

<?php 
$result=$mysqli->query("SELECT * FROM user WHERE id=$id");
while($row=$result->fetch_assoc()){
	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
	$email = $row['email'];
	$mobile = $row['mobile'];
	$gender = $row['gender'];
}
?>
<br/>
<div><img src='../project/img/editprofile.png' style='width:70px;height:70px;'></div>

<h4>Edit Your Profile</h4>
<hr/>
</div>			
<form role="form" method='POST'>
<div class="form-group">FIRST NAME
	<div class="input-group">
 <input type ='text' class="form-control" name ='first_name' placeholder="<?php echo $first_name; ?>" required>
 <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
 	</div>
</div>
<div class="form-group">LAST NAME
	<div class="input-group">
 <input type ='text' class="form-control" name ='last_name' placeholder="<?php echo $last_name; ?>" required>
 <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
 	</div>
</div>
<div class="form-group">EMAIL ADDRESS
	<div class="input-group">
 <input type='email' class="form-control" name='email' placeholder="<?php echo $email; ?>" required>
 <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span>
  	</div>
</div>
<div class="form-group">MOBILE NO
	<div class="input-group">
<input type='text' class="form-control" name='mobile' placeholder="<?php echo $mobile; ?>" required>
<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span>
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
 <input type='submit' name='submit' value='Edit profile' class="btn btn-info pull-right">
</form>
</div>
</div>
</div>
</body>
</html>

<?php
include_once("footer.php");
?>