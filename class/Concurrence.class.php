<?php

  	require_once(__DIR__ . "/../autoload/session.autoload.php");
	require_once(__DIR__ . "/../autoload/db.autoload.php");
	require_once(__DIR__ . "/../class/File.class.php");

	class Concurrence{

		private $beforePattern;
		private $afterPattern;
		private $titreSite;
		private $fileLink;
		private $file;
		private $patternId;

		function __construct(){

		}

		public function removePattern()
		{
			$query = getDb()->prepare("DELETE FROM pattern_concur WHERE id = ?");
			$query->execute(array($this->patternId));
		}

		public function getPatterns()
		{
			$query = getDb()->prepare("SELECT * FROM pattern_concur ORDER BY titre ASC");
			$query->execute();

			return $query->fetchAll();
		}

		public function addPattern()
		{
			$query = getDb()->prepare("INSERT INTO pattern_concur(after_pattern, before_pattern, titre, image)
			VALUES(:after_pattern, :before_pattern, :titre, :image)");
			$query->execute(array(
				'after_pattern' => $this->afterPattern,
				'before_pattern' => $this->beforePattern,
				'titre' => $this->titreSite,
				'image' => $this->fileLink
				));
		}

		/**
		 * Getter for file
		 *
		 * @return mixed
		 */
		public function getFile()
		{
		    return $this->file;
		}

		/**
		 * Getter for patternId
		 *
		 * @return mixed
		 */
		public function getPatternId()
		{
		    return $this->patternId;
		}
		
		/**
		 * Setter for patternId
		 *
		 * @param mixed $patternId Value to set
		
		 * @return self
		 */
		public function setPatternId($patternId)
		{
		    $this->patternId = $patternId;
		    return $this;
		}
		
		
		/**
		 * Setter for file
		 *
		 * @param mixed $file Value to set
		
		 * @return self
		 */
		public function setFile($file)
		{
		    $this->file = $file;
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
		

		/**
		 * Getter for titreSite
		 *
		 * @return mixed
		 */
		public function getTitreSite()
		{
		    return $this->titreSite;
		}
		
		/**
		 * Setter for titreSite
		 *
		 * @param mixed $titreSite Value to set
		
		 * @return self
		 */
		public function setTitreSite($titreSite)
		{
		    $this->titreSite = $titreSite;
		    return $this;
		}

		/**
		 * Getter for beforePattern
		 *
		 * @return mixed
		 */
		public function getBeforePattern()
		{
		    return $this->beforePattern;
		}
		
		/**
		 * Setter for beforePattern
		 *
		 * @param mixed $beforePattern Value to set
		
		 * @return self
		 */
		public function setBeforePattern($beforePattern)
		{
		    $this->beforePattern = $beforePattern;
		    return $this;
		}

		/**
		 * Getter for afterPattern
		 *
		 * @return mixed
		 */
		public function getAfterPattern()
		{
		    return $this->afterPattern;
		}
		
		/**
		 * Setter for afterPattern
		 *
		 * @param mixed $afterPattern Value to set
		
		 * @return self
		 */
		public function setAfterPattern($afterPattern)
		{
		    $this->afterPattern = $afterPattern;
		    return $this;
		}
		
		
	}