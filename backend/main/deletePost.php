<?php
	session_start();
	require_once('../vendor/autoload.php');
	
	unset($_SESSION['forms_data']);

	$connection = new PDO("mysql:host=db;dbname=mydatabase;charset=utf8", "root", "myrootpassword");
	if(!$connection){
    die("Fatal Error: Connection Failed!");
	}

	$post_id = $_POST['post_id'];

	$stmt = $connection->prepare("DELETE FROM `forms` WHERE id = :id");
	$stmt->bindParam(':id', $post_id);

	$stmt->execute();

	if ($stmt->rowCount() > 0) {
    header('Location: http://localhost:85/main/getPosts.php');
    die();
	} else {
    echo "No posts were deleted";
	}