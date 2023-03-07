<?php
session_start();
if (!isset($_SESSION['registerData'])) {
	header('Location: http://localhost:85/loginForm.php');
	die();
} else if (isset($_SESSION['errors']) && isset($_SESSION['data'])) {
    $errors = $_SESSION['errors'];
    $data = $_SESSION['data'];
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

<br>
<div class="container">
    <div class="row">

        <form style="width: 100%" method="post" action="form.php">
            <div class="form-group row">
                <label for="title" class="col-md-2 col-form-label">Заголовок</label>
                <div class="col-md-10">
                    <div class="input-group">
                        <input
                                type="text"
                                class="form-control <?php echo isset($errors['title']) ? 'border border-danger' : '' ?>"
                                id="title"
                                name="title"
                                value="<?php echo $data['title'] ?? '' ?>"
                        >

                    </div>
                    <div><?php echo $errors['title'] ?? '' ?></div>
                </div>
            </div>

            <div class="form-group row">
                <label for="annotation" class="col-md-2 col-form-label">Аннотация</label>
                <div class="col-md-10">
                    <div class="input-group">
                        <textarea
                                name="annotation"
                                id="annotation"
                                class="form-control <?php echo isset($errors['annotation']) ? 'border border-danger' : '' ?>"
                                cols="30"
                                rows="10"><?php echo $data['annotation'] ?? '' ?></textarea>
                    </div>
                    <div><?php echo $errors['annotation'] ?? '' ?></div>
                </div>
            </div>

            <div class="form-group row">
                <label for="content" class="col-md-2 col-form-label">Текст новости</label>
                <div class="col-md-10">
                    <div class="input-group">
                        <textarea
                                name="content"
                                id="content"
                                class="form-control <?php echo isset($errors['content']) ? 'border border-danger' : '' ?>"
                                cols="30"
                                rows="10"><?php echo $data['content'] ?? '' ?></textarea>
                    </div>
                    <div><?php echo $errors['content'] ?? '' ?></div>
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-2 col-form-label">Email  автора для связи</label>
                <div class="col-md-10">
                    <div class="input-group">
                        <input
                                type="email"
                                class="form-control <?php echo isset($errors['email']) ? 'border border-danger' : '' ?>"
                                id="email"
                                name="email"
                                value="<?php echo $data['email'] ?? '' ?>"
                        >
                    </div>
                    <div><?php echo $errors['email'] ?? '' ?></div>
                </div>
            </div>

            <div class="form-group row">
                <label for="views" class="col-md-2 col-form-label">Кол-во просмотров</label>
                <div class="col-md-10">
                    <div class="input-group">
                        <input
                                type="text"
                                class="form-control <?php echo isset($errors['views']) ? 'border border-danger' : '' ?>"
                                id="views"
                                name="views"
                                value="<?php echo $data['views'] ?? '' ?>"
                        >
                    </div>
                    <div><?php echo $errors['views'] ?? '' ?></div>
                </div>
            </div>

            <div class="form-group row">
                <label for="date" class="col-md-2 col-form-label">Дата публикации</label>
                <div class="col-md-10">
                    <div class="input-group">
                        <input
                                type="date"
                                class="form-control <?php echo isset($errors['date']) ? 'border border-danger' : '' ?>"
                                id="date"
                                name="date"
                                value="<?php echo $data['date'] ?? '' ?>"
                        >
                    </div>
                    <div><?php echo $errors['date'] ?? '' ?></div>
                </div>
            </div>

            <div class="form-group row">
                <label for="is_publish" class="col-md-2 col-form-label">Публичная новость</label>
                <div class="col-md-10">
                    <input
                            type="checkbox"
                            class="form-control"
                            id="is_publish"
                            name="is_publish"
                            <?php echo isset($data['is_publish']) && $data['is_publish'] === "on" ? "checked" : "" ?>
                    >
                    <div class="invalid-feedback"></div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label">Публиковать на главной</label>
                <div class="col-md-10">
                    <div class="form-check <?php echo isset($errors['publish_in_index']) ? 'text-danger' : '' ?>">
                        <input
                                class="form-check-input"
                                type="radio"
                                name="publish_in_index"
                                id="publish_in_index_yes"
                                value="true"
                                <?php echo isset($data['publish_in_index']) && $data['publish_in_index'] === "true" ? "checked" : "" ?>
                        >
                        <label class="form-check-label" for="publish_in_index_yes">
                            Да
                        </label>
                    </div>
                    <div class="form-check <?php echo isset($errors['publish_in_index']) ? 'text-danger' : '' ?>">
                        <input
                                class="form-check-input"
                                type="radio"
                                name="publish_in_index"
                                id="publish_in_index_no"
                                value="false"
                                <?php echo isset($data['publish_in_index']) && $data['publish_in_index'] === "false" ? "checked" : "" ?>
                        >
                        <label class="form-check-label" for="publish_in_index_no">
                            Нет
                        </label>
                    </div>
                    <div><?php echo $errors['publish_in_index'] ?? '' ?></div>
                </div>
            </div>

            <div class="form-group row">
                <label for="category" class="col-md-2 col-form-label">Публичная новость</label>
                <div class="col-md-10">
                    <div>
                        <select id="category" class="form-control <?php echo isset($errors['category']) ? 'border border-danger' : '' ?>" name="category" >
                            <option disabled selected>Выберете категорию из списка..</option>
                            <option value="1" <?php echo isset($data['category']) && $data['category'] === "1" ? "selected" : "" ?>>Спорт</option>
                            <option value="2" <?php echo isset($data['category']) && $data['category'] === "2" ? "selected" : "" ?>>Культура</option>
                            <option value="3" <?php echo isset($data['category']) && $data['category'] === "3" ? "selected" : "" ?>>Политика</option>
                        </select>
                    </div>
                    <div><?php echo $errors['category'] ?? '' ?></div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-9">
	                <button type="submit" class="btn btn-primary">Отправить</button>
	                <a href="loginForm.php" class="btn btn-primary">Выйти из аккаунта</a>
                </div>
                <div class="col-md-3 <?php if (!isset($errors)) echo 'd-none' ?>">
                    <div class="alert <?php echo isset($errors) && count($errors) > 0 ? 'alert-danger' : 'alert-success'?>">
                        <?php echo isset($errors) && count($errors) > 0 ? 'Неверно заполнена форма' : 'Форма валидна' ?>
                    </div>
                </div>
            </div>
        </form>
	    <div><?php var_dump($_SESSION["registerData"]) ?></div>

    </div>
</div>
</body>
</html>