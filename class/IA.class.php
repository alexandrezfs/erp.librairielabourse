<?php

  	require_once(__DIR__ . "/../autoload/session.autoload.php");
	require_once(__DIR__ . "/../autoload/db.autoload.php");
	require_once(__DIR__ . "/../class/Mail.class.php");
	require_once(__DIR__ . "/../class/Transaction.class.php");
	require_once(__DIR__ . "/../class/Viewer.class.php");
	require_once(__DIR__ . "/../class/Searcher.class.php");
	require_once(__DIR__ . "/../class/Reassort.class.php");


	class IA
	{

		protected $email;
		protected $emails;
		protected $Mail;
		protected $Transaction;
		protected $Viewer;
		protected $Reassort;
		protected $Fraude;
		protected $Magasin;
		protected $magasins;
		
		function IA()
		{
			$this->emails = array();

			$query = getDb()->prepare("SELECT * FROM ia_emails");
			$query->execute();

			while ($row = $query->fetch()) {
				$this->emails[] = $row['email'];
			}

			$this->Mail = new Mail();
			$this->Transaction = new Transaction();
			$this->Viewer = new Viewer();
			$this->Reassort = new Reassort();
			$this->Fraude = new Fraude();
			$this->Magasin = new Magasin();

			$this->magasins = $this->Magasin->getMagasins();
		}

		public function addEmailAddr()
		{
			$query = getDb()->prepare("INSERT INTO ia_emails(email) VALUES(?)");
			$query->execute(array($this->email));
		}

		public function removeEmailAddr()
		{
			$query = getDb()->prepare("DELETE FROM ia_emails WHERE email = ?");
			$query->execute(array($this->email));
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
		

	}

?>