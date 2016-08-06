<?php

  	require_once(__DIR__ . "/../autoload/session.autoload.php");
	require_once(__DIR__ . "/../autoload/db.autoload.php");
	require_once(__DIR__ . "/../class/MobileDetect.class.php");

	class Network{

		private $message;
		private $username;
		private $datesent;

		function __construct(){

		}

		public function callSmallNetwork()
		{

			$MobileDetect = new Mobile_Detect();

			if(!$MobileDetect->isMobile() && !isset($_SESSION['called'])){
				echo '
					<script>
						window.open("small-network.php","Network","menubar=no, status=no, scrollbars=no, menubar=no, resizable=no, width=300, height=670");
					</script>
				';	

				$_SESSION['called'] = 1;
			}
		}

		public function findPossibleProduct()
		{
			$query = getDb()->prepare("SELECT * FROM produits WHERE code = :code");
			$query->execute(array(
				'code' => $this->message
				));

			$row = $query->fetch();

			if($query->rowCount() > 0){
				return $this->message . ' TITRE : ' . $row['titre'] . ' AUTEUR : ' . $row['auteur'] . ' EDITEUR : ' . $row['editeur'];
			}
			else{
				return $this->message;
			}

		}

		public function addMsg()
		{
			if(strlen($this->message) > 0){
				$this->message = $this->findPossibleProduct();
				$query = getDb()->prepare("INSERT INTO network_msg(username, msg, datesent) VALUES(?,?,?)");
				$query->execute(array($this->username, $this->message, $this->datesent));
			}
		}

		public function getMsg()
		{
			$query = getDb()->prepare("SELECT * FROM network_msg ORDER BY id DESC LIMIT 100");
			$query->execute();

			return $query->fetchAll();
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
		 * Getter for datesent
		 *
		 * @return mixed
		 */
		public function getDatesent()
		{
		    return $this->datesent;
		}
		
		/**
		 * Setter for datesent
		 *
		 * @param mixed $datesent Value to set
		
		 * @return self
		 */
		public function setDatesent($datesent)
		{
		    $this->datesent = $datesent;
		    return $this;
		}
		

		/**
		 * Getter for message
		 *
		 * @return mixed
		 */
		public function getMessage()
		{
		    return $this->message;
		}
		
		/**
		 * Setter for message
		 *
		 * @param mixed $message Value to set
		
		 * @return self
		 */
		public function setMessage($message)
		{
		    $this->message = $message;
		    return $this;
		}
		
		
	}

?>