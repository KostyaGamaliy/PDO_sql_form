<?php

	namespace Validations\FormCheck;

	use Validations\Validation;

	class CategoryValidate extends Validation
	{
		public function validate($value): ?string
		{
			if (!is_numeric($value) || !in_array($value, [1, 2, 3])) {
				return "Поле категории должно быть числом и иметь одно из значений [1, 2, 3]";
			} else {
				return null;
			}
		}
	}