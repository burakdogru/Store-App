<!DOCTYPE html>
<html>

<head>
	<title>Inventory Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/7187ab1959.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="../css/style.css">

</head>

<body class="bg-dark">
	<?php
	require "../config.php";
	$username = $password = "";
	$username_err = $password_err = "";
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$inp_username = trim($_POST['username']);
		$inp_password = trim($_POST['password']);

		if (empty($inp_username)) {
			$username_err = "Please enter username.";
		} elseif (!filter_var(
			$inp_username,
			FILTER_VALIDATE_REGEXP,
			array("options" => array("regexp" => "/^[a-zA-Z\s]+$/"))
		)) {
			$username_err = "Please enter a valid Username.";
		} else {
			$username = $inp_username;
		}

		if (empty($inp_password)) {
			$password_err = "Please enter password.";
		} else {
			$password = $inp_password;
		}
		if (empty($username_err) && empty($password_err)) {

			$sql = "SELECT username FROM users WHERE username = '$username'";
			if ($res = $con->query($sql)) {
				if (mysqli_num_rows($res) <= 0) {
					$username_err = "No account found with that username.";
				} else {
					$sql = "SELECT password FROM users WHERE password = '$password'";
					if ($res = $con->query($sql)) {
						if (mysqli_num_rows($res) <= 0) {
							$password_err = "The password you entered was not correct.";
						} else {
							session_start();
							$_SESSION['username'] = $username;
							header("location: ../landing.php");
						}
					} else {
						echo "Oops! An Error Occuered. Please try again later.";
					}
				}
			} else {
				echo "Oops! An Error Occuered. Please try again later.";
			}
		}
	}

	?>
	<nav style="height: 90px;" class="navbar navbar-expand-lg navbar-dark bg-secondary">
		<a class="navbar-brand" href="../home.php">IAU Store Inventory System</a>
	</nav>
	<div class="container mt-5">
		<div style="width: 750px; margin-top: 13%;" class="container">
			<div class="row">
				<div class="col-md-6 offset-md-3">
					<div class="card bg-warning">
						<div class="card-header">
							<h3 class="text-center">Login</h3>
						</div>
						<div class="card-body">
							<form method="post">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label " for="username"><i class="fa-solid fa-user"></i></label>
									<div class="col-sm-10 ">
										<input placeholder="Enter Username" style="border-radius: 20px;" type="text" name="username" id="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
										<span class="invalid-feedback"><?php echo $username_err; ?></span>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label " for="password"><i class="fa-solid fa-lock"></i></label>
									<div class="col-sm-10 ">
										<input placeholder="Enter Password" style="border-radius: 20px;" type="password" name="password" id="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
										<span class="invalid-feedback"><?php echo $password_err; ?></span>
									</div>
								</div>
								<div class="form-group">
									<button style="border-radius: 20px;" type="submit" class="btn btn-primary btn-block mt-4 btn-dark">Login</button>
								</div>
								<p class="text-center mt-4">Don't have an account? <a class="text-dark" href="register.php">Sign up here</a></p>

							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer class=" py-3  bg-secondary">
		<div class="container bg-secondary">
			<p class="text-center bg-secondary text-white">Copyright &copy; <?php echo date("Y"); ?> IAU Store</p>
		</div>
	</footer>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/[email protected]/dist/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
</body>

</html>