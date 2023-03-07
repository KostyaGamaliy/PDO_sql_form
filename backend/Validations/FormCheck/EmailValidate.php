<?php

	namespace Validations\FormCheck;

	use Validations\Validation;

	class EmailValidate extends Validation
	{
		public function validate($value): ?string
		{
			if (empty($value)) {
				return "Поле email не должно быть пустым";
			} elseif (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
				return "Неверный формат";
			} else {
				return null;
			}
		}
	}