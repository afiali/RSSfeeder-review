<?php 
include_once ("header.php");
?>

<!DOCTYPE html>
<html>
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

<body>

<div class="col-sm-8 pull-sm-10">
<div class="modal-content">
<div class="modal-header">
<div align="center">
<div id="main">
<h1></h1>
<div id="login">

<h2>Contact Us</h2></div>
<hr/>
<form role="form" method="post">
<div class="form-group">
	<div class="input-group">
	<input type="text" class="form-control" placeholder="Your Name : " name="name"><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
	</div>
</div>
<div class="form-group">
	<div class="input-group">
	<input type="text" class="form-control" placeholder="Your Email : " name="mail"><span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
	</div>
</div>


<input type="text" class="form-control"  placeholder="Subject : " name="subject"/><br/>
<textarea rows="8" class="form-control"  cols="50" placeholder="Enter Your Message..." name="message"></textarea><br/>
<?php
require '../RSSfeeder/phpmailer/PHPMailerAutoload.php';
if(isset($_POST['send']))
{
$email = 'reader.revweb@gmail.com'; //sender email
$password = 'rev123456';
$to_id = 'editor.revweb@gmail.com'; //receiver email
$sendermail = '('.$_POST['mail'].')'; //sender email
$message = $_POST['message'];
$name = $_POST['name'];
$subject = $_POST['subject'];
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'tls://smtp.gmail.com:587';
$mail->SMTPAuth = true;
$mail->Username = $email;
$mail->Password = $password;
$mail->addAddress($to_id);
$mail->Subject = 'Review Website Feedback';
$mail->msgHTML('<b>From:</b>&nbsp;'
	.$name.'&nbsp;'
	.$sendermail.'<br/>'.'<b>Subject:</b>&nbsp;'
	.$subject.'<br/><br/>'.'<b>Message:</b><br/>'
	.$message);
if (!$mail->send()) {
$error = "" . $mail->ErrorInfo;
$fail='<p id="para">'.$error.'</p>';
}
else {
$success='<p id="para">Message sent!</p>';
}
}
else{
$info='<p id="para">Please enter valid data</p>';
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
<input type="submit" value="Send" name="send" class="btn btn-info pull-right" />
</form>
<div class="clearfix"></div>
</div></div></div>
</div></div>

<div class="col-sm-4 push-sm-10">
<b>Customer Service Hotline: </b><br/>
1-300-88-7827<br/>
Monday – Friday (8.30am – 7.30pm),<br/>
excluding public holidays<br/>
<b>Fax: </b><br/>
03-7954 1301<br/>
<strong>Email: </strong><br/>
<a href="mailto:editor.revweb@gmail.com">editor.revweb@gmail.com</a><br/>
<b>Star Media Group Berhad</b><br/>
Menara Star, 15 Jalan 16/11<br/>
46350 Petaling Jaya<br/>
Selangor Darul Ehsan<br/>
Malaysia<br/>
<br/>
View maps to our office

<p><iframe style="border: 0px currentColor;" src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d1991.9381153386443!2d101.64597330821229!3d3.12740830715048!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sstar+publication+malaysia!5e0!3m2!1sen!2s!4v1396925519582" width="500" height="280" frameborder="0"></iframe></p>
</body>
</html>

<?php
include_once ("footer.php");
?>