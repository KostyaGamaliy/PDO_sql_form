<?php

	namespace Validations\RegisterCheck;

	use Validations\Validation;

	class RegTelephoneValidate extends Validation
	{
		public function validate($value): ?string
		{
			$phoneNumber = preg_replace('/\D/', '', $value);

			if (!preg_match('/^1?\d{10}$/', $phoneNumber)) {
				return "Неверный формат ввода telephone";
			} else {
				return null;
			}
		}
	}