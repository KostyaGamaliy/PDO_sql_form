<?php

	namespace Validations\RegisterCheck;

	use Validations\Validation;

	class RegSexValidate extends Validation
	{
		public function validate($value): ?string
		{
			if (mb_strlen($value, 'utf8') != 1) {
				return "Поле sex долно быть в формате М/Ж";
			} else if (mb_strtolower($value, 'utf8') !== 'м' && mb_strtolower($value, 'utf8') !== 'ж') {
				return "Поле sex долно быть в формате М/Ж  22" ;
			}	else {
				return null;
			}
		}
	}