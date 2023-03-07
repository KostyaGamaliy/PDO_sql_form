<?php

	namespace Validations\FormCheck;

	use Validations\Validation;

	class PublishInIndexValidate extends Validation
	{
		public function validate($value): ?string
		{
			if (empty($value) || (!$value && $value)) {
				return "Поле публикация на главной является обязательным и должно содержать значение 'yes' или 'no'";
			} else {
				return null;
			}
		}
	}