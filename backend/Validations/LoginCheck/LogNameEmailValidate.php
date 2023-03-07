<?php

	namespace Validations\LoginCheck;

	use Validations\Validation;

	class LogNameEmailValidate extends Validation
	{
		public function validate($value): ?string
		{
			if (strlen($value) === 0) {
				return "Данное поле не должно быть пустым";
			} else {
				return null;
			}
		}
	}