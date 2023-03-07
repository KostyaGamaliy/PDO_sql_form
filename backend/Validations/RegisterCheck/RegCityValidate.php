<?php

	namespace Validations\RegisterCheck;

	use Validations\Validation;

	class RegCityValidate extends Validation
	{
		public function validate($value): ?string
		{
			if (empty($value)) {
				return "City не должно быть пустым";
			} elseif (is_numeric($value)) {
				return "Поле city не может содержать числа";
			} else {
				return null;
			}
		}
	}