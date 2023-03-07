<?php

	namespace Validations\FormCheck;

	use Validations\Validation;

	class ContentValidate extends Validation
	{
		public function validate($value): ?string
		{
			if (strlen($value) > 30000) {
				return "Поле контента не должно превышать 30000 символов";
			} else {
				return null;
			}
		}
	}