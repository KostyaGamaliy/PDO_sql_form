<?php
session_start();
	require_once('vendor/autoload.php');

	use Validations\FormCheck\AnnotationValidate;
	use Validations\FormCheck\CategoryValidate;
	use Validations\FormCheck\ContentValidate;
	use Validations\FormCheck\DateValidate;
	use Validations\FormCheck\EmailValidate;
	use Validations\FormCheck\PublishInIndexValidate;
	use Validations\FormCheck\TitleValidate;
	use Validations\FormCheck\ViewsValidate;

	if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $errors = [];

		$title_validate = new TitleValidate();
		if ($title_validate->validate($_POST["title"])) {
			$errors["title"] = $title_validate->validate($_POST["title"]);
		}

		$annotation_validate = new AnnotationValidate();
		if ($annotation_validate->validate($_POST["annotation"])) {
			$errors["annotation"] = $annotation_validate->validate($_POST["annotation"]);
		}

		$content_validate = new ContentValidate();
		if ($content_validate->validate($_POST["content"])) {
			$errors["content"] = $content_validate->validate($_POST["content"]);
		}

		$email_validate = new EmailValidate();
		if ($email_validate->validate($_POST["email"])) {
			$errors["email"] = $email_validate->validate($_POST["email"]);
		}

		$views_validate = new ViewsValidate();
		if ($views_validate->validate($_POST["views"])) {
			$errors["views"] = $views_validate->validate($_POST["views"]);
		}

		$date_validate = new DateValidate();
		if ($date_validate->validate($_POST["date"])) {
			$errors["date"] = $date_validate->validate($_POST["date"]);
		}

		$publish_in_index_validate = new PublishInIndexValidate();
		if ($publish_in_index_validate->validate($_POST["publish_in_index"] ?? "")) {
			$errors["publish_in_index"] = $publish_in_index_validate->validate($_POST["publish_in_index"] ?? "");
		}

		$category_validate = new CategoryValidate();
		if ($category_validate->validate($_POST["category"] ?? "")) {
			$errors["category"] = $category_validate->validate($_POST["category"] ?? "");
		}

        $connection = new PDO("mysql:host=db;dbname=mydatabase;charset=utf8", "root", "myrootpassword");
        if(!$connection){
            die("Fatal Error: Connection Failed!");
        }

        if(!$errors){
            try{
                $sql = "SELECT form_title FROM forms WHERE form_title = :f_title";
                $query = $connection->prepare($sql);
                $query->execute(['f_title' => $_POST["title"]]);
                $result = $query->fetchAll(PDO::FETCH_ASSOC);

                if (!empty($result) && !isset($errors["title"])) {
                    foreach ($result as $row) {
                        if ($row['form_title'] === $_POST["title"]) {
                            $errors["title"] = "Такое название уже занято";
                        }
                    }
                } else if (isset($errors)){
                    $sql = "INSERT forms(form_author_id, form_title, form_annotation, form_text, form_author_email, form_watchers_count, form_date_public, form_is_public, form_is_public_home, form_theme) 
                    VALUE (:f_author_id, :f_title, :f_annotation, :f_text, :f_author_email, :f_watchers_count, :f_date_public, :f_is_public, :f_is_public_home, :f_theme)";
                    $query = $connection->prepare($sql);

                    $form_category = ['Спорт', 'Культура', 'Политика'];

                    $query->execute(['f_author_id' => $_SESSION["user"], 'f_title' => $_POST["title"], 'f_annotation' => $_POST["annotation"],
                        'f_text' => $_POST["content"], 'f_author_email' => $_POST["email"], 'f_watchers_count' => $_POST["views"],
                        'f_date_public' => $_POST["date"], 'f_is_public' => isset($_POST["is_publish"]) ? 1 : 0,
                        'f_is_public_home' => $_POST["publish_in_index"] === "true" ? 1 : 0, 'f_theme' => $form_category[$_POST["category"] - 1]]);
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        if (!$errors) {
            unset($_SESSION['errors']);
            unset($_SESSION['data']);

            header('Location: http://localhost:85/main/getPosts.php');
            die();
        } else {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $_POST;

            header('Location: http://localhost:85/');
            die();
        }

	}