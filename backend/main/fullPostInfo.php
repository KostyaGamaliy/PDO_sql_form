<?php
session_start();
require_once('../vendor/autoload.php');

$connection = new PDO("mysql:host=db;dbname=mydatabase;charset=utf8", "root", "myrootpassword");
if(!$connection){
    die("Fatal Error: Connection Failed!");
}

$form_id = $_GET['id'];

$sql = "SELECT * FROM `forms` LEFT JOIN users ON users.id = forms.form_author_id WHERE forms.id = :f_id; ";
$query = $connection->prepare($sql);
$query->execute(["f_id" => $form_id]);

$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
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
<div class="container">
    <h1>Form Info</h1>
    <div class="row">
        <div class="col-sm-3">Title:</div>
        <div class="col-sm-9"><?php echo $fetch[0]['form_title']; ?></div>
    </div>
    <div class="row">
        <div class="col-sm-3">Annotation:</div>
        <div class="col-sm-9"><?php echo $fetch[0]['form_annotation']; ?></div>
    </div>
    <div class="row">
        <div class="col-sm-3">Text:</div>
        <div class="col-sm-9"><?php echo $fetch[0]['form_text']; ?></div>
    </div>
    <div class="row">
        <div class="col-sm-3">Username:</div>
        <div class="col-sm-9"><?php echo $fetch[0]['user_login']; ?></div>
    </div>
    <div class="row">
        <div class="col-sm-3">Email:</div>
        <div class="col-sm-9"><?php echo $fetch[0]['user_email']; ?></div>
    </div>
    <div class="row">
        <div class="col-sm-3">Telephone:</div>
        <div class="col-sm-9"><?php echo $fetch[0]['user_telephone']; ?></div>
    </div>
    <div class="row">
        <div class="col-sm-3">City:</div>
        <div class="col-sm-9"><?php echo $fetch[0]['user_city']; ?></div>
    </div>
    <div class="row">
        <div class="col-sm-3">Watchers:</div>
        <div class="col-sm-9"><?php echo $fetch[0]['form_watchers_count']; ?></div>
    </div>
    <div class="row">
        <div class="col-sm-3">Post theme:</div>
        <div class="col-sm-9"><?php echo $fetch[0]['form_theme']; ?></div>
    </div>
    <div class="row">
        <div class="col-sm-3">Is public?</div>
        <div class="col-sm-9"><?php echo $fetch[0]['form_is_public'] ? "yes" : "no"; ?></div>
    </div>
    <div class="row">
        <div class="col-sm-3">Place in main?</div>
        <div class="col-sm-9"><?php echo $fetch[0]['form_is_public_home'] ? "yes" : "no"; ?></div>
    </div>
    <div class="row">
        <div class="col-sm-3">Date publication:</div>
        <div class="col-sm-9"><?php echo $fetch[0]['form_date_public']; ?></div>
    </div>
    <div class="row">
        <a href="all_posts.php" type="button" class="btn btn-primary col-sm-3 btn-block m-2">Вернутся назад</a>
    </div>
</div>

<?php
$sql = "UPDATE `forms` SET form_watchers_count = form_watchers_count + 1 WHERE id = $form_id";
$affectedRowsNumber = $connection->exec($sql);
?>
</body>
</html>