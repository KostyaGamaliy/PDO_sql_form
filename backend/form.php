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
		if ($publish_in_index_validate->validate($_POST["publish_in_index"])) {
			$errors["publish_in_index"] = $publish_in_index_validate->validate($_POST["publish_in_index"] ?? "");
		}

		$category_validate = new CategoryValidate();
		if ($category_validate->validate($_POST["category"])) {
			$errors["category"] = $category_validate->validate($_POST["category"] ?? "");
		}

		$_SESSION['errors'] = $errors;
		$_SESSION['data'] = $_POST;

		header('Location: http://localhost:85/');
		die();
	}