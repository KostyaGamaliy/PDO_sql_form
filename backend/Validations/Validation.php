<?php

	namespace Validations;

	abstract class Validation
	{
		abstract public function validate($value);
	}