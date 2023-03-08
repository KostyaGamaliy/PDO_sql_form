<?php
	session_start();
	require_once('../vendor/autoload.php');

	use Validations\LoginCheck\LogNameEmailValidate;
	use Validations\LoginCheck\LogPasswordValidate;
	
	

	$loginErrors = [];

	$connection = new PDO("mysql:host=db;dbname=mydatabase;charset=utf8", "root", "myrootpassword");
    if(!$connection){
        die("Fatal Error: Connection Failed!");
    }


    if($_POST['user_login'] != "" || $_POST['user_password'] != ""){
        $username = $_POST['user_login'];
        $password = $_POST['user_password'];

        $sql = "SELECT * FROM `users` WHERE `user_login`=? OR `user_email` =? AND `user_password`=? ";
        $query = $connection->prepare($sql);
        $query->execute([$username, $username, $password]);

        $row = $query->rowCount();
        $fetch = $query->fetch();

        if($row > 0) {
            $_SESSION['user'] = $fetch['id'];
        } else{
            $loginErrors["user_login"] = "Неверный логин или пароль";
        }
    }else{
        $loginErrors["user_login"] = "Не оставляйте пустых мест";
    }

	if (isset($_SESSION['user'])){
		unset($_SESSION['loginData']);
		unset($_SESSION['loginErrors']);
		
		header('Location: http://localhost:85/');
		die();
	} else if ($loginErrors) {
		$_SESSION['loginErrors'] = $loginErrors;
		$_SESSION['loginData'] = $_POST;
		
		header('Location: http://localhost:85/login/loginForm.php');
		die();
	}


