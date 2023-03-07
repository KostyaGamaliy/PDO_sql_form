<?php

	namespace Validations\FormCheck;

	use Validations\Validation;

	class ViewsValidate extends Validation
	{
		public function validate($value): ?string
		{
			if (!is_numeric($value) || $value < 0 || !filter_var($value, FILTER_VALIDATE_INT)) {
				return "Количество просмотров должно быть целым положительным числом";
			} else {
				return null;
			}
		}
	}