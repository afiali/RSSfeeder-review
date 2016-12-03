<?php
include_once("header.php");
?>

<html>
<body>
<div class='col-sm-6 col-sm-offset-5'>
<div class='modal-content'>
<div class='modal-header'>
<div align='center'>


<?php
$user = @$_SESSION['user_id'];
if ($user)
{
if (@$_POST['submit'])
{
$oldpassword =md5(@$_POST['oldpassword']);
$newpassword = md5(@$_POST['newpassword']);
$repeatnewpassword =md5(@$_POST['repeatnewpassword']);

$mysqli = mysqli_connect($servername, $username, $password, $database);
$queryget = $mysqli->query("SELECT password FROM user WHERE id='$user'")or die ("Query didnt work");
$row = $queryget->fetch_assoc();
$oldpassworddb = $row ['password'];

if($oldpassword==$oldpassworddb)
{

if ($newpassword==$repeatnewpassword)
{
$querychange = $mysqli->query("
UPDATE user SET password='$newpassword' WHERE id='$user'
");
$success = "Your password has been successfully changed.";}
else 
 $fail = "New password doesn't match!";}
else 
 $info = "Old password doesn't match!";}
}
?>

<?php if(isset($info)){?>
	<div class="alert alert-fail">
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

<div><img src='../project/img/change-icon.png' style='width:70px;height:70px;'></div>

<h4>Change Your Password</h4>
<hr/>
</div>			
<form action ='changepassword.php' role="form" method='POST'>
<div class="form-group">Old password: 
	<div class="input-group">
 <input type ='text' class="form-control" name ='oldpassword' required>
 <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
 	</div>
</div>
<div class="form-group">New password: 
	<div class="input-group">
 <input type='password' class="form-control" name='newpassword' required>
 <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
  	</div>
</div>
 <div class="form-group"> Repeat new password:
	<div class="input-group">
<input type='password' class="form-control" name='repeatnewpassword' required>
<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
   	</div>
</div>
 <input type='submit' name='submit' value='Change password' class="btn btn-info pull-right">
</form>
</div>
</div>
</div>
</body>
</html>

<?php
include_once("footer.php");
?>