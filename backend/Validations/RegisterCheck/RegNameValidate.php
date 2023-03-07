<?php

	namespace Validations\RegisterCheck;

	use Validations\Validation;

	class RegNameValidate extends Validation
	{
		public function validate($value): ?string
		{
			if (strlen($value) === 0 || strlen($value) > 25) {
				return "Имя не должно быть пустым или быть больше 25 символов";
			} else {
				return null;
			}
		}
	}