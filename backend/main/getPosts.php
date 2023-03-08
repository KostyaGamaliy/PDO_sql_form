<?php
    session_start();
    require_once('../vendor/autoload.php');

    $connection = new PDO("mysql:host=db;dbname=mydatabase;charset=utf8", "root", "myrootpassword");
    if(!$connection){
        die("Fatal Error: Connection Failed!");
    }

    $sql = "SELECT forms.id, forms.form_title, forms.form_text, users.user_login FROM `forms` LEFT JOIN users ON users.id = forms.form_author_id; ";
    $query = $connection->query($sql);

    $fetch = $query->fetchAll(PDO::FETCH_ASSOC);

    $_SESSION['forms_data'] = $fetch;

    if (isset($_SESSION['forms_data'])) {
        header('Location: http://localhost:85/main/all_posts.php');
        die();
    } else {
        echo "No one post";
    }
