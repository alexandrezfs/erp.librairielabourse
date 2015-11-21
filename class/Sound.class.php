<?php

  	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/db.autoload.php");

	class Sound
	{

		private $activated;
		private $username;
		
		function Sound()
		{
			
		}

		public function toggle()
		{
			if($this->isSoundActivated()){
				$this->disable();
			}
			else{
				$this->activated = 1;
				$this->enable();
			}
		}

		public function isSoundActivated()
		{
			$query = getDb()->prepare("SELECT * FROM sound WHERE username = ?");
			$query->execute(array($this->username));

			if($query->rowCount() > 0){
				return true;
			}
			else{
				return false;
			}
		}

		public function enable()
		{
			$query = getDb()->prepare("INSERT INTO sound(username, activated) VALUES(?,?)");
			$query->execute(array($this->username, $this->activated));
		}

		public function disable()
		{
			$query = getDb()->prepare("DELETE FROM sound WHERE username = ?");
			$query->execute(array($this->username));
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
		 * Getter for activated
		 *
		 * @return mixed
		 */
		public function getActivated()
		{
		    return $this->activated;
		}
		
		/**
		 * Setter for activated
		 *
		 * @param mixed $activated Value to set
		
		 * @return self
		 */
		public function setActivated($activated)
		{
		    $this->activated = $activated;
		    return $this;
		}
		
	}

?>