<?php 
include_once ("header.php");
?>

<!DOCTYPE html>
<html>
<body>

<div class="col-sm-6 col-sm-offset-5">
<div class="modal-content">
<div class="modal-header">
<div align="center">
<div id="main">

<head>
<meta charset="UTF-8">
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-43981329-1']);
_gaq.push(['_trackPageview']);
(function() {
var ga = document.createElement('script');
ga.type = 'text/javascript';
ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(ga, s);
})();
</script>
</head>

<?php
include_once('db_config.php');
$mysqli = mysqli_connect($servername, $username, $password, $database);
if(isset($_POST['send'])){
	$email = $_POST['email'];
	$result = $mysqli->query("SELECT * FROM user WHERE email='$email'");
	$get = $result->num_rows;
	if($get==1){
		$data=$result->fetch_assoc();

		$user_id = $data['id'];
		$user_name = $data['first_name']." ".$data['last_name'];
		$user_email = $data['email'];

		$word = "temporary12345"; //this is the temporary password
		$new_password = md5($word);

		$query = "UPDATE user SET password='$new_password' WHERE id='$user_id'";
		$result = $mysqli->query($query);
		if($result){
			echo "done!";
			require ('../RSSfeeder/phpmailer/PHPMailerAutoload.php');

			$mail = new PHPMailer;
			$mail->isSMTP();
			$mail->Host = 'tls://smtp.gmail.com:587';
			$mail->SMTPAuth = true;
			$mail->Username = 'editor.revweb@gmail.com';
			$mail->Password = 'rev123456';

			$mail->setFrom('editor.revweb@gmail.com','Forgot Password');
			$mail->addAddress($email);
			$mail->addReplyTo('editor.revweb@gmail.com');

			$body =				
				"<div>
				<b>Your Name : </b>".$user_name."<br>
				<b>Email : </b>".$user_email."<br>
				<b>Temporary password : </b>".$word."<br>
				<br>Please change your password once you login.
				</div>";
			
			$body = eregi_replace("[\]", '', $body);

			$mail->Subject = 'Password Information';
			$mail->MsgHTML($body);
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			$mail->Send();
			?> <!-- <Script type="text/javascript">alert("Check your email.");</Script> -->
			<?php
			$success = "<strong>Success!</strong><br/>Check your email.";
		}else{
			$fail = "<strong>Failure!</strong><br/>There is something wrong!<br/>Please Try Again.";
		}
	}else{
		?>
		<!--  <Script type="text/javascript">alert("Your email not existed!");</Script> -->
		<?php
		$fail =  "<strong>Failure!</strong><br/>Oops, Email does not exist! <br/>Please Try Again.";
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


<h2>Forgot Password</h2></div>
<hr/>
<form role="form" method="post">
<div class="form-group">
	<div class="input-group">
	<input type="text" class="form-control" placeholder="Your Name : " name="name"><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
	</div>
</div>
<div class="form-group">
	<div class="input-group">
	<input type="text" class="form-control" placeholder="Your Email : " name="email"><span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
	</div>
</div>
<input type="submit" value="Send" name="send" class="btn btn-info pull-right" />
</form>
<div class="clearfix"></div>
</div></div></div>
</div></div>
<?php
include_once ("footer.php");
?>