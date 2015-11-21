<?php

	class SuspectProduct{

		private $magasin;
		private $date;
		private $heure;
		private $code;
		private $titre;
		private $auteur;
		private $editeur;
		private $prix;
		private $usualPrice;
		private $type;

		function SuspectProduct()
		{
			
		}

		/**
		 * Getter for prix
		 *
		 * @return mixed
		 */
		public function getPrix()
		{
		    return $this->prix;
		}
		
		/**
		 * Setter for prix
		 *
		 * @param mixed $prix Value to set
		
		 * @return self
		 */
		public function setPrix($prix)
		{
		    $this->prix = $prix;
		    return $this;
		}
		

		/**
		 * Getter for editeur
		 *
		 * @return mixed
		 */
		public function getEditeur()
		{
		    return $this->editeur;
		}
		
		/**
		 * Setter for editeur
		 *
		 * @param mixed $editeur Value to set
		
		 * @return self
		 */
		public function setEditeur($editeur)
		{
		    $this->editeur = $editeur;
		    return $this;
		}
		

		/**
		 * Getter for auteur
		 *
		 * @return mixed
		 */
		public function getAuteur()
		{
		    return $this->auteur;
		}
		
		/**
		 * Setter for auteur
		 *
		 * @param mixed $auteur Value to set
		
		 * @return self
		 */
		public function setAuteur($auteur)
		{
		    $this->auteur = $auteur;
		    return $this;
		}
		

		/**
		 * Getter for titre
		 *
		 * @return mixed
		 */
		public function getTitre()
		{
		    return $this->titre;
		}
		
		/**
		 * Setter for titre
		 *
		 * @param mixed $titre Value to set
		
		 * @return self
		 */
		public function setTitre($titre)
		{
		    $this->titre = $titre;
		    return $this;
		}
		

		/**
		 * Getter for code
		 *
		 * @return mixed
		 */
		public function getCode()
		{
		    return $this->code;
		}
		
		/**
		 * Setter for code
		 *
		 * @param mixed $code Value to set
		
		 * @return self
		 */
		public function setCode($code)
		{
		    $this->code = $code;
		    return $this;
		}
		

		/**
		 * Getter for heure
		 *
		 * @return mixed
		 */
		public function getHeure()
		{
		    return $this->heure;
		}
		
		/**
		 * Setter for heure
		 *
		 * @param mixed $heure Value to set
		
		 * @return self
		 */
		public function setHeure($heure)
		{
		    $this->heure = $heure;
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
		 * Getter for magasin
		 *
		 * @return mixed
		 */
		public function getMagasin()
		{
		    return $this->magasin;
		}
		
		/**
		 * Setter for magasin
		 *
		 * @param mixed $magasin Value to set
		
		 * @return self
		 */
		public function setMagasin($magasin)
		{
		    $this->magasin = $magasin;
		    return $this;
		}
		
		/**
		 * Getter for usualPrice
		 *
		 * @return mixed
		 */
		public function getUsualPrice()
		{
		    return $this->usualPrice;
		}
		
		/**
		 * Setter for usualPrice
		 *
		 * @param mixed $usualPrice Value to set
		
		 * @return self
		 */
		public function setUsualPrice($usualPrice)
		{
		    $this->usualPrice = $usualPrice;
		    return $this;
		}

		/**
		 * Getter for type
		 *
		 * @return mixed
		 */
		public function getType()
		{
		    return $this->type;
		}
		
		/**
		 * Setter for type
		 *
		 * @param mixed $type Value to set
		
		 * @return self
		 */
		public function setType($type)
		{
		    $this->type = $type;
		    return $this;
		}
		

	}

?>