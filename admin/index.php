<!DOCTYPE html>
<html lang="en">
<?php
//error_reporting(0);
$message = null;
$success = null;
$noNavBar = "";
include "init.php";
session_start();
if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if (!empty($_POST["submit"])) {
		$loginquery = "SELECT * FROM admin WHERE username='$username' && password='" . md5($password) . "'";
		$result = mysqli_query($db, $loginquery);
		$row = mysqli_fetch_array($result);

		if (is_array($row)) {
			$_SESSION["adm_id"] = $row['adm_id'];
			header("refresh:1;url=dashboard.php");
		} else {
			$message = "Invalid Username or Password!";
		}
	}
}

if (isset($_POST['submit1'])) {
	if (
		empty($_POST['cr_user']) ||
		empty($_POST['cr_email']) ||
		empty($_POST['cr_pass']) ||
		empty($_POST['cr_cpass']) 
	) {
		$message = "ALL fields must be fill";
	} else {


		$check_username = mysqli_query($db, "SELECT username FROM admin where username = '" . $_POST['cr_user'] . "' ");

		$check_email = mysqli_query($db, "SELECT email FROM admin where email = '" . $_POST['cr_email'] . "' ");



		if ($_POST['cr_pass'] != $_POST['cr_cpass']) {
			$message = "Password not match";
		} elseif (!filter_var($_POST['cr_email'], FILTER_VALIDATE_EMAIL)) // Validate email address
		{
			$message = "Invalid email address please type a valid email!";
		} elseif (mysqli_num_rows($check_username) > 0) {
			$message = 'username Already exists!';
		} elseif (mysqli_num_rows($check_email) > 0) {
			$message = 'Email Already exists!';
		}
	}
}
?>


<body>


	<div class="container">
		<div class="info">
			<h1>Administration </h1><span> login Account</span>
		</div>
	</div>
	<div class="form">
		<div class="thumbnail"><img src="images/manager.png" /></div>

		<span>username:admin</span>&nbsp;<span>password:1234</span>
		<span style="color:red;"><?php echo $message; ?></span>
		<span style="color:green;"><?php echo $success; ?></span>
		<form class="login-form" action="index.php" method="post">
			<input type="text" placeholder="username" name="username" />
			<input type="password" placeholder="password" name="password" />
			<input type="submit" name="submit" value="login" />
		</form>
	</div>
	<script src='js/index.js'></script>
</body>

</html>