<?php

	namespace Validations\FormCheck;

	use Validations\Validation;

	class DateValidate extends Validation
	{
		public function validate($value): ?string
		{
			$date_timestamp = strtotime($value);
			$today = time();
			$YearToCurrent = date_create(date("Y", $today) . "-" . date("m", $date_timestamp) . "-" . date("d", $date_timestamp));

			$diff = date_diff(date_create(date("d-m-Y", $today)), $YearToCurrent);
			$days = $diff->format("%R%a");

			if ($date_timestamp === false || $days < 0) {
				return "Дата публикации должна быть действительной и не ранее сегодняшнего дня";
			} else {
				return null;
			}
		}
	}