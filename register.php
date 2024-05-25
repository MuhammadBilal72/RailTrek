<?php
  session_start();
  if(isset($_SESSION["user"])) {
    header("location:./index.php");
    exit();
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>RailTrek - Create Account</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="assets/css/auth.css">
</head>
<body>
<div class="container">
	<div class="d-flex flex-column justify-content-center h-100">
    <h1 class="text-center mb-5 text-light">Create Account on RailTrek</h1>
		<div class="card">
			<div class="card-header">
				<h3>Signup</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<div class="card-body">
				<?php if(isset($_REQUEST["missing_details"])) { ?>
					<div class="alert alert-danger">
						Please fill all details
					</div>
				<?php } else if (isset($_REQUEST["email_persistent"])) { ?>
					<div class="alert alert-danger">
						Sorry This email is already registered
					</div>
				<?php } else if (isset($_REQUEST["password_short"])) { ?>
					<div class="alert alert-danger">
						Password Too Short. Minimum 6 characters
					</div>
				<?php } else if (isset($_REQUEST["created"])) { ?>
					<div class="alert alert-success">
						Account Created Successfully. <a href="login.php">Login</a>
					</div>
				<?php } ?>
				<form action="controllers/registeration_controller.php" method="POST">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" name="fullname" class="form-control" placeholder="Full Name">
					</div>
          <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-envelope"></i></span>
						</div>
						<input type="text" name="email" class="form-control" placeholder="Email">
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="password" class="form-control" placeholder="password">
					</div>
					<div class="form-group">
						<input type="submit" value="Create Account" class="btn float-right btn-warning">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Already have an account?<a href="login.php">Login Now</a>
        </div>
			</div>
		</div>
	</div>
</div>
</body>
</html>