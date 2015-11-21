<?php

  	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/db.autoload.php");

	class Document{

		private $fileLink;
		private $date;
		private $author;

		function Document(){

		}

		public function addDoc()
		{
			$query = getDb()->prepare("INSERT INTO documents(date, filelink, author) VALUES(:date, :filelink, :author)");
			$query->execute(array(
				'date' => $this->date,
				'filelink' => $this->fileLink,
				'author' => $this->author
				));
		}

		public function getDocs()
		{
			$query = getDb()->prepare("SELECT * FROM documents ORDER BY id DESC LIMIT 500");
			$query->execute();
			return $query->fetchAll();
		}

		/**
		 * Getter for author
		 *
		 * @return mixed
		 */
		public function getAuthor()
		{
		    return $this->author;
		}
		
		/**
		 * Setter for author
		 *
		 * @param mixed $author Value to set
		
		 * @return self
		 */
		public function setAuthor($author)
		{
		    $this->author = $author;
		    return $this;
		}
		

		/**
		 * Getter for date
		 *
		 * @return mixed
		 */
		public function getDate()
		{
		    return $this->date;
		}
		
		/**
		 * Setter for date
		 *
		 * @param mixed $date Value to set
		
		 * @return self
		 */
		public function setDate($date)
		{
		    $this->date = $date;
		    return $this;
		}
		

		/**
		 * Getter for fileLink
		 *
		 * @return mixed
		 */
		public function getFileLink()
		{
		    return $this->fileLink;
		}
		
		/**
		 * Setter for fileLink
		 *
		 * @param mixed $fileLink Value to set
		
		 * @return self
		 */
		public function setFileLink($fileLink)
		{
		    $this->fileLink = $fileLink;
		    return $this;
		}
		

	}

?>