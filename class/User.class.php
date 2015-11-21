<?php

  	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/db.autoload.php");

	class User{

		private $username;
		private $password;
		private $addeddate;
		private $id;

		function __construct(){

		}

		public function rememberMe()
		{
			setcookie('erpusername', $_SESSION['username'], time() + 1000*24*3600, null, null, false, true);
		}

		public function removeRemeberMe()
		{
			setcookie('erpusername', '', time() + 1000*24*3600, null, null, false, true);
		}

		public function logout()
		{
			if(isset($_SESSION)){
				$this->removeRemeberMe();
				session_destroy();
				header("location:/");
			}
			else{
				header("location:/");
			}
		}

		public function checkConnected()
		{
			if(!isset($_SESSION['username'])){
				header("location:/index.php");
			}
		}

		public function autoConnec()
		{
			if(isset($_COOKIE['erpusername']) && $_COOKIE['erpusername'] != ''){
				$_SESSION['username'] = $_COOKIE['erpusername'];
				header("location:/app.php");
			}
			else if(isset($_SESSION['username'])){
				header("location:/app.php");
			}
		}

		public function logIn()
		{
			if($this->username == 'Admin'){

				if($this->password == 'moderator'){
					$_SESSION['admin'] = 1;
					header("location:/admin.php");
				}
				else{
					header("location:/?error=connec");
				}				
			}
			else{
				$query = getDb()->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
				$query->execute(array($this->username, $this->password));

				if($query->rowCount() == 0){
					header("location:/?event=connec");
				}
				else{
					$_SESSION['username'] = $this->username;
					header("location:/app.php");
				}
			}
		}

		public function addUser()
		{
			if(strlen($this->username) == 0 || strlen($this->password) == 0){

				header("location:/users.admin.php?event=noinfo");

			}
			else{
				$query = getDb()->prepare("INSERT INTO users(username, password, addeddate) VALUES(?,?,?)");
				$query->execute(array($this->username, $this->password, $this->addeddate));

				header("location:/users.admin.php?event=added");
			}

		}

		public function deluser()
		{
			$query = getDb()->prepare("DELETE FROM users WHERE id = ?");
			$query->execute(array($this->id));

			header("location:/users.admin.php?event=deleted");
		}

		public function getUsers()
		{
			$query = getDb()->prepare("SELECT * FROM users");
			$query->execute();

			$rows = $query->fetchAll();

			return $rows;
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
		 * Getter for password
		 *
		 * @return mixed
		 */
		public function getPassword()
		{
		    return $this->password;
		}
		
		/**
		 * Setter for password
		 *
		 * @param mixed $password Value to set
		
		 * @return self
		 */
		public function setPassword($password)
		{
		    $this->password = $password;
		    return $this;
		}
		
		/**
		 * Getter for addeddate
		 *
		 * @return mixed
		 */
		public function getAddeddate()
		{
		    return $this->addeddate;
		}
		
		/**
		 * Setter for addeddate
		 *
		 * @param mixed $addeddate Value to set
		
		 * @return self
		 */
		public function setAddeddate($addeddate)
		{
		    $this->addeddate = $addeddate;
		    return $this;
		}
		
		/**
		 * Getter for id
		 *
		 * @return mixed
		 */
		public function getId()
		{
		    return $this->id;
		}
		
		/**
		 * Setter for id
		 *
		 * @param mixed $id Value to set
		
		 * @return self
		 */
		public function setId($id)
		{
		    $this->id = $id;
		    return $this;
		}
		
		
	}

?>
