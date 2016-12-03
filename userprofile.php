<?php
include_once("header.php");

$mysqli = mysqli_connect($servername, $username, $password, $database);

$id=$_SESSION['user_id'];
$result = $mysqli->query("SELECT * FROM user where id='$id'");
while($row = $result->fetch_assoc())
{ 
$name=$row['first_name']." ".$row['last_name'];
$email=$row['email'];
$password=$row['password'];
$mobile=$row['mobile'];
$gender=$row['gender'];
$creon=$row['creon'];
}
?>

<html>
<body>
<div class="col-sm-6 col-sm-offset-5">
<div class="modal-content">
<div class="modal-header">
<br/>
<div align="center">
<div><img src="../project/img/profile-icon.png" style="width:120px;height:120px;"></div>
<br/><br/>
  
<table width="398" border="0" align="center" cellpadding="0">
    <td width="100" valign="top"><div align="left"><b>Name</b></div></td>
    <td width="180" valign="top">:&nbsp; <?php echo $name ?></td>
  </tr>
  <tr>
    <td valign="top"><div align="left"><b>Email Address</b></div></td>
    <td valign="top">:&nbsp; <?php echo $email ?></td>
  </tr>
  <tr>
    <td valign="top"><div align="left"><b>Mobile No.</b></div></td>
    <td valign="top">:&nbsp; <?php echo $mobile ?></td>
  </tr>
  <tr>
    <td valign="top"><div align="left"><b>Gender </b></div></td>
    <td valign="top">:&nbsp; <?php echo $gender ?></td>
  </tr>
  <tr>
    <td valign="top"><div align="left"><b>Date Created </b></div></td>
    <td valign="top">:&nbsp; <?php echo $creon ?></td>
  </tr>
</table>
</div>
</div>
</div>
</div>
</body>
</html>

<?php
include_once("footer.php");
?>