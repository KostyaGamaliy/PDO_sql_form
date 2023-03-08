<?php
    session_start();
	
		unset($_SESSION['postErrors']);

    if (!isset($_SESSION['forms_data'])) {
        header('Location: http://localhost:85/main/getPosts.php');
        die();
    }
		
		if (isset($_SESSION['errors']) || isset($_SESSION['data'])) {
			unset($_SESSION['errors']);
			unset($_SESSION['data']);
		}

    $allData = $_SESSION['forms_data'];
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
    <div class="container d-flex justify-content-around  flex-wrap ">
        <a type="button" class="btn btn-primary btn-block mt-5 mb-1 mx-5" href="../index.php">Вернутся на создание поста</a>
        <?php
            foreach ($allData as $data) {
        ?>
        <div class="card m-3" style="width: 24rem;">
            <form method="post" action="deletePost.php">
                <input type="hidden" name="post_id" value="<?php echo $data['id']; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $data['form_title'] ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $data['user_login'] ?></h6>
                    <p class="card-text text-truncate"><?php echo $data['form_text'] ?></p>
                    <a href="fullPostInfo.php?id=<?php echo $data['id']; ?>" class="card-link">Полный обзор</a>
                    <a href="updatePost.php?id=<?php echo $data['id']; ?>" class="card-link">Редактировать</a>
                    <button type="submit" class="card-link">Удалить</button>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>