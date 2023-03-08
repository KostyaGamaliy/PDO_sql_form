<?php
	session_start();
	require_once('../vendor/autoload.php');

	use Validations\RegisterCheck\RegCityValidate;
	use Validations\RegisterCheck\RegEmailValidate;
	use Validations\RegisterCheck\RegNameValidate;
	use Validations\RegisterCheck\RegPasswordValidate;
	use Validations\RegisterCheck\RegSexValidate;
	use Validations\RegisterCheck\RegTelephoneValidate;

	$regError = [];

	$reg_name_validate = new RegNameValidate();
	if ($reg_name_validate->validate($_POST["user_login"])) {
		$regError["user_login"] = $reg_name_validate->validate($_POST["user_login"]);
	}

	$reg_email_validate = new RegEmailValidate();
	if ($reg_email_validate->validate($_POST["user_email"])) {
		$regError["user_email"] = $reg_email_validate->validate($_POST["user_email"]);
	}

	$reg_city_validate = new RegCityValidate();
	if ($reg_city_validate->validate($_POST["user_city"])) {
		$regError["user_city"] = $reg_city_validate->validate($_POST["user_city"]);
	}

	$reg_sex_validate = new RegSexValidate();
	if ($reg_sex_validate->validate($_POST["user_sex"])) {
		$regError["user_sex"] = $reg_sex_validate->validate($_POST["user_sex"]);
	}

	$reg_telephone_validate = new RegTelephoneValidate();
	if ($reg_telephone_validate->validate($_POST["user_telephone"])) {
		$regError["user_telephone"] = $reg_telephone_validate->validate($_POST["user_telephone"]);
	}

	$reg_password_validate = new RegPasswordValidate();
	if ($reg_password_validate->validate($_POST["user_password"])) {
		$regError["user_password"] = $reg_password_validate->validate($_POST["user_password"]);
	}

	if ($_POST["user_confirm_password"] !== $_POST["user_password"]) {
		$regError["user_confirm_password"] = "Неправильно введён повторный пароль";
	}

	$connection = new PDO("mysql:host=db;dbname=mydatabase;charset=utf8", "root", "myrootpassword");
    if(!$connection){
        die("Fatal Error: Connection Failed!");
    }

    if($_POST['user_login'] != "" && $_POST['user_email'] != "" && $_POST['user_city'] != "" && $_POST['user_sex'] != "" && $_POST['user_telephone'] != "" && $_POST['user_password'] != "" && $_POST['user_confirm_password'] != "" && !$regError){
        try{
            $sql = "SELECT user_login, user_email FROM users WHERE user_login = :u_login OR user_email = :u_email";
            $query = $connection->prepare($sql);
            $query->execute(['u_login' => $_POST["user_login"], 'u_email' => $_POST["user_email"]]);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($result) && (!isset($regError["user_login"]) || !isset($regError["user_email"]))) {
                foreach ($result as $row) {
                    if ($row['user_login'] === $_POST["user_login"]) {
                        $regError["user_login"] = "Этот логин уже занят";
                    }
                    if ($row['user_email'] === $_POST["user_email"]) {
                        $regError["user_email"] = "Этот email уже зарегестрирован";
                    }
                }
            } else if (isset($regError)){
							$sql = "INSERT users(user_login, user_email, user_password, user_city, user_sex, user_telephone) VALUE (:u_login, :u_email, :u_password, :u_city, :u_sex, :u_telephone)";
							$query = $connection->prepare($sql);
							$query->execute(['u_login' => $_POST["user_login"], 'u_email' => $_POST["user_email"], 'u_password' => $_POST["user_password"], 'u_city' => $_POST["user_city"], 'u_sex' => $_POST["user_sex"], 'u_telephone' => $_POST["user_telephone"]]);
	
	            $sql = "SELECT * FROM `users` WHERE `user_login`=? AND `user_password`=? ";
	            $query = $connection->prepare($sql);
	            $query->execute([$_POST['user_login'], $_POST['user_password']]);
	
	            $row = $query->rowCount();
	            $fetch = $query->fetch();
	
	            $_SESSION['user'] = $fetch['id'];
						}

        
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    

    if ($regError){
	    $_SESSION['registerErrors'] = $regError;
	    $_SESSION['registerData'] = $_POST;
			
			header('Location: http://localhost:85/registration/registerForm.php');
			die();
    } else{
			unset($_SESSION['registerErrors']);
			unset($_SESSION['registerData']);
			
			header('Location: http://localhost:85/');
			die();
    }


