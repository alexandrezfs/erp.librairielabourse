<?php

  	require_once(__DIR__ . "/../autoload/session.autoload.php");
	require_once(__DIR__ . "/../autoload/db.autoload.php");

	class Access{

		private $module;
		private $username;

		function Access(){

		}

		public function isAllowedRedirect()
		{
			if(!$this->isAllowed()){
				header("location:/accessgranted.php");
			}
		}

		public function removeAllowed()
		{
			$query = getDb()->prepare("DELETE FROM module_allowed WHERE username = ? AND module_name = ?");
			$query->execute(array($this->username, $this->module));
		}

		public function addAllowed()
		{
			if(!$this->isAllowed()){
				$query = getDb()->prepare("INSERT INTO module_allowed(module_name, username) VALUES(?,?)");
				$query->execute(array($this->module, $this->username));
			}
		}

		public function isAllowed()
		{
			$query = getDb()->prepare("SELECT id FROM module_allowed WHERE module_name = ? AND username = ?");
			$query->execute(array($this->module, $this->username));

			if($query->rowCount() > 0){
				return true;
			}
			else{
				return false;
			}
		}

		/**
		 * Getter for username
		 *
		 * @return mixed
		 */
		public function getUsername()
		{
		    return $this->username;
		}
		
		/**
		 * Setter for username
		 *
		 * @param mixed $username Value to set
		
		 * @return self
		 */
		public function setUsername($username)
		{
		    $this->username = $username;
		    return $this;
		}
						

		/**
		 * Getter for module
		 *
		 * @return mixed
		 */
		public function getModule()
		{
		    return $this->module;
		}
		
		/**
		 * Setter for module
		 *
		 * @param mixed $module Value to set
		
		 * @return self
		 */
		public function setModule($module)
		{
		    $this->module = $module;
		    return $this;
		}
		

	}

?>