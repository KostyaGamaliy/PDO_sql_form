<?php
	session_start();
	require_once('vendor/autoload.php');

	use Validations\LoginCheck\LogNameEmailValidate;
	use Validations\LoginCheck\LogPasswordValidate;

	$loginErrors = [];

//	$log_name_email_validate = new LogNameEmailValidate();
//	if ($log_name_email_validate->validate($_POST["user_login"])) {
//		$loginErrors["user_login"] = $log_name_email_validate->validate($_POST["user_login"]);
//	}
//
//	$log_password_validate = new LogPasswordValidate();
//	if ($log_password_validate->validate($_POST["user_password"])) {
//		$loginErrors["user_password"] = $log_password_validate->validate($_POST["user_password"]);
//	}

	$connection = new PDO("mysql:host=db;dbname=mysite;charset=utf8", "root", "myrootpassword");

	$sql = "SELECT user_login, user_password FROM users WHERE user_login = :user_login";
	$stmt = $connection->prepare($sql);
	$stmt->execute(['user_login' => $_POST['user_login']]);
	$row = $stmt->fetch();
	var_dump($row);
	if (!$row) {
		$loginErrors["user_login"] = "Неверный логин";
	} elseif (!password_verify($_POST["user_password"], $row['user_password'])) {
		$loginErrors["user_password"] = "Неверный пароль";
	}

	$_SESSION['loginErrors'] = $loginErrors;
	$_SESSION['loginData'] = $_POST;

	if (!$loginErrors){
		header('Location: http://localhost:85/');
		die();
	} else {
		header('Location: http://localhost:85/loginForm.php');
		die();
	}


