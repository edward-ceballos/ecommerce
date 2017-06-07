<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="styles/login.css" media="all">

</head>
<body>
	<div class="login">
	<?php if (isset($_GET['no_admin'])): ?>
		<h3 style="color: red; text-align: center"><?php echo $_GET['no_admin'] ?></h3>
	<?php endif ?>
	<h1>Login</h1>
    <form method="post">
    	<input type="text" name="email" placeholder="Email" required="required" />
        <input type="password" name="pass" placeholder="Password" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large" name="login">Login</button>
    </form>
</div>
</body>
</html>
<?php 
session_start();
include '../includes/db.php';
if (isset($_POST['login'])) {
	$user_email = mysqli_real_escape_string($con, $_POST['email']);
	$user_pass = mysqli_real_escape_string($con, $_POST['pass']);

	$sel_c = "SELECT * FROM `admins` WHERE `user_pass` = '$user_pass' AND `user_email` = '$user_email'";

	$run_c = mysqli_query($con, $sel_c);

	$check_cutomer = mysqli_num_rows($run_c);

	if ($check_cutomer == 0) {
		echo "<script>alert('The email or password is incorrect, please try again!');</script>";
		exit();
	}

	
	if ($check_cutomer > 0) {

		$_SESSION['user_email'] = $user_email;
		echo "<script>alert('You logged in successfully, Thanks!');</script>";
		echo "<script>window.open('index.php', '_self');</script>";
	}
}
?>