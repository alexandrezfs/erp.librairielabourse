<?php

  	require_once(__DIR__ . "/../autoload/session.autoload.php");
	require_once(__DIR__ . "/../autoload/db.autoload.php");

	class Magasin{

		private $nom;

		function Magasin()
		{
			
		}

		public function getMagasins()
		{
			$query = getDb()->prepare("SELECT localisation FROM alive ORDER BY localisation ASC");
			$query->execute();
			return $query->fetchAll();
		}

		public function isAlive()
		{
			$query = getDb()->prepare("SELECT timestamp FROM alive WHERE localisation = ?");
			$query->execute(array($this->nom));

			$row = $query->fetch();

			if($row['timestamp']/1000 > time()-15000){
				return true;
			}
			else{
				return false;
			}
		}

		/**
		 * Getter for nom
		 *
		 * @return mixed
		 */
		public function getNom()
		{
		    return $this->nom;
		}
		
		/**
		 * Setter for nom
		 *
		 * @param mixed $nom Value to set
		
		 * @return self
		 */
		public function setNom($nom)
		{
		    $this->nom = $nom;
		    return $this;
		}
		
	}