<?php

  	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/db.autoload.php");

	class EmailAlert{

		private $email;
		private $emails;

		function EmailAlert(){

			$query = getDb()->prepare("SELECT * FROM ia_emails");
			$query->execute();

			$this->emails = array();

			while ($row = $query->fetch()) {
				$this->emails[] = $row['email'];
			}

		}

		public function addEmail()
		{
			$query = getDb()->prepare("INSERT INTO ia_emails(email) VALUES(?)");
			$query->execute(array($this->email));

			return true;
		}

		public function removeEmail()
		{
			$query = getDb()->prepare("DELETE FROM ia_emails WHERE email LIKE ?");
			$query->execute(array($this->email));

			return true;
		}

		/**
		 * Getter for emails
		 *
		 * @return mixed
		 */
		public function getEmails()
		{
		    return $this->emails;
		}
		
		/**
		 * Setter for emails
		 *
		 * @param mixed $emails Value to set
		
		 * @return self
		 */
		public function setEmails($emails)
		{
		    $this->emails = $emails;
		    return $this;
		}
		

		/**
		 * Getter for email
		 *
		 * @return mixed
		 */
		public function getEmail()
		{
		    return $this->email;
		}
		
		/**
		 * Setter for email
		 *
		 * @param mixed $email Value to set
		
		 * @return self
		 */
		public function setEmail($email)
		{
		    $this->email = $email;
		    return $this;
		}

	}
		

?>