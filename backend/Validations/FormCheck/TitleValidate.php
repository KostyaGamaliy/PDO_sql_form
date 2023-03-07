<?php

	namespace Validations\FormCheck;

	use Validations\Validation;

	class TitleValidate extends Validation
	{
		public function validate($value): ?string
		{
			if (empty($value)) {
				return "Заголовок не должен быть пустым";
			} elseif (strlen($value) < 3) {
				return "Заголовок не должен быть меньше 3 символов";
			} elseif (strlen($value) > 255) {
				return "Заголовок не должен быть больше 255 символов";
			} else {
				return null;
			}
		}
	}