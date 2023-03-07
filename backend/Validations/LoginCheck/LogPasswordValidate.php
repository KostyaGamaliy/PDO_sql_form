<?php

	namespace Validations\LoginCheck;

	use Validations\Validation;

	class LogPasswordValidate extends Validation
	{
		public function validate($value): ?string
		{
			if (empty($value)) {
				return "Password не должно быть пустым";
			} elseif (strlen($value) < 5) {
				return "Пароль должен быть меньше 5 символов";
			} else {
				return null;
			}
		}
	}