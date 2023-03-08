<?php
	
	namespace Validations;
	
	class isAuth
	{
		private $path;
		private $user;
		
		public function __construct($path, $user)
		{
			$this->path = $path;
			$this->user = $user;
		}
		
		public function is_auth () {
			if (!$this->user) {
				return header('Location: http://localhost:85/' . $this->path);
			}
		}
	}