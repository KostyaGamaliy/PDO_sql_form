<?php
	session_start();
	session_destroy();

	if (isset($_SESSION['loginErrors'])) {
		$errors = $_SESSION['loginErrors'];
		$data = $_SESSION['loginData'];
	}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Palmo</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-md-6">

			<form method="post" action="checkLoginForm.php">
				<h2 class="text-center mb-4">Login Form</h2>
				<div class="form-group">
					<label for="name">Login</label>
					<input type="text" class="form-control <?php echo isset($errors['user_login']) ? 'border border-danger' : '' ?>" placeholder="Enter your name" name="user_login" value="<?php echo $data['user_login'] ?? '' ?>">
					<div><?php echo $errors['user_login'] ?? '' ?></div>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control <?php echo isset($errors['user_login']) ? 'border border-danger' : '' ?>" placeholder="Enter your password" name="user_password" value="<?php echo $data['user_password'] ?? '' ?>">
					<div><?php echo $errors['user_login'] ?? '' ?></div>
				</div>
				<div class="d-flex justify-content-around" role="group" aria-label="Two buttons">
					<button type="submit" class="btn btn-primary">Войти</button>
					<a type="button" class="btn btn-primary" href="../registration/registerForm.php">Зарегиестрироваться</a>
				</div>
			</form>

		</div>
	</div>
</div>


</body>
</html>
