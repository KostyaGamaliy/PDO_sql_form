<?php
	session_start();
	if (isset($_SESSION['registerErrors']) && isset($_SESSION['registerData'])) {
		$errors = $_SESSION['registerErrors'];
		$data = $_SESSION['registerData'];
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
</head>
<body>
<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-md-6">

			<form method="post" action="checkRegForm.php">
				<h2 class="text-center mb-4">Registration Form</h2>
				<div class="form-group">
					<label for="name">Login</label>
					<input type="text" class="form-control <?php echo isset($errors['user_login']) ? 'border border-danger' : '' ?>" placeholder="Enter your name" name="user_login" value="<?php echo $data['user_login'] ?? '' ?>">
					<div><?php echo $errors['user_login'] ?? '' ?></div>
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control <?php echo isset($errors['user_email']) ? 'border border-danger' : '' ?>" placeholder="Enter your email" name="user_email" value="<?php echo $data['user_email'] ?? '' ?>">
					<div><?php echo $errors['user_email'] ?? '' ?></div>
				</div>
				<div class="form-group">
					<label for="city">City</label>
					<input type="text" class="form-control <?php echo isset($errors['user_city']) ? 'border border-danger' : '' ?>" placeholder="Enter your city" name="user_city" value="<?php echo $data['user_city'] ?? '' ?>">
					<div><?php echo $errors['user_city'] ?? '' ?></div>
				</div>
				<div class="form-group">
					<label for="sex">Sex</label>
					<input type="text" class="form-control <?php echo isset($errors['user_sex']) ? 'border border-danger' : '' ?>" placeholder="Enter your sex (М/Ж)" name="user_sex" value="<?php echo $data['user_sex'] ?? '' ?>">
					<div><?php echo $errors['user_sex'] ?? '' ?></div>
				</div>
				<div class="form-group">
					<label for="telephone">Telephone</label>
					<input type="text" class="form-control <?php echo isset($errors['user_telephone']) ? 'border border-danger' : '' ?>" placeholder="Enter your telephone" name="user_telephone" value="<?php echo $data['user_telephone'] ?? '' ?>">
					<div><?php echo $errors['user_telephone'] ?? '' ?></div>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control <?php echo isset($errors['user_password']) ? 'border border-danger' : '' ?>" placeholder="Enter your password" name="user_password" value="<?php echo $data['user_password'] ?? '' ?>">
					<div><?php echo $errors['user_password'] ?? '' ?></div>
				</div>
				<div class="form-group">
					<label for="password">Password confirmation</label>
					<input type="password" class="form-control <?php echo isset($errors['user_confirm_password']) ? 'border border-danger' : '' ?>" placeholder="Confirm your password" name="user_confirm_password" value="<?php echo $data['user_confirm_password'] ?? '' ?>">
					<div><?php echo $errors['user_confirm_password'] ?? '' ?></div>
				</div>
				<div class="d-flex justify-content-around" role="group" aria-label="Two buttons">
					<button type="submit" class="btn btn-primary">Зарегиестрироваться</button>
					<a type="button" class="btn btn-primary" href="loginForm.php">Уже есть аккаунт</a>
				</div>
			</form>

		</div>
	</div>
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>