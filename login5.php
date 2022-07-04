<!DOCTYPE html>
<html lang="en">
<?php
session_start(); // temp sessions
$noNavBar = "";
$pageTitle = "Login";
include "init.php";
$message = null;
$success = null;
if (isset($_POST['submit']))   // if button is submit
{
	$username = $_POST['username'];  //fetch records from login form
	$password = $_POST['password'];

	if (!empty($_POST["submit"]))   // if records were not empty
	{
		$loginquery = "SELECT username, u_id, password FROM users WHERE username='$username' && password='" . md5($password) . "'"; //selecting matching records
		$result = mysqli_query($db, $loginquery); //executing
		$row = mysqli_fetch_array($result);

		if (is_array($row))  // if matching records in the array & if everything is right
		{
			$_SESSION["user_id"] = $row['u_id']; // put user id into temp session
			header("refresh:2;url=index.php"); // redirect to index.php page
			$success =  "Logged in successfully.";
		} else {
			$message = "Invalid Username or Password!"; // throw error
		}
	}
}
?>
<head>
	<meta charset="UTF-8">
	<title>login</title>
	<!-- <style type="text/css">
		#buttn {
			color: #fff;
			background-color: #ff3300;
		}
	</style> -->

</head>

<body>

	<!-- Form Mixin-->
	<!-- Input Mixin-->
	<!-- Button Mixin-->
	<!-- Pen Title-->
	<div class="pen-title">
		<h1>Login Form</h1>
	</div>
	<!-- Form Module-->
	<div class="module form-module">
		<div class="toggle">

		</div>
		<div class="form">
			<h2>Login to your account</h2>
			<span style="color:red;"><?php echo $message; ?></span>
			<span style="color:green;"><?php echo $success; ?></span>
			<form action="" method="post">
				<input type="text" placeholder="Username" name="username" />
				<input type="password" placeholder="Password" name="password" />
				<input type="submit" id="buttn" name="submit" value="login" />
			</form>
		</div>

		<div class="cta">Not registered?<a href="registration.php" style="color:#f30;"> Create an account</a></div>
	</div>
</body>

</html>