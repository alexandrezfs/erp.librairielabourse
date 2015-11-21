<?php

	class ProduitAchete{

		private $code;
		private $titre;
		private $auteur;
		private $editeur;
		private $type;
		private $prixesp;
		private $prixvente;
		private $prixech;
		private $purchaser;
		private $lotID;

		function ProduitAchete()
		{
			
		}

		/**
		 * Getter for lotID
		 *
		 * @return mixed
		 */
		public function getLotID()
		{
		    return $this->lotID;
		}
		
		/**
		 * Setter for lotID
		 *
		 * @param mixed $lotID Value to set
		
		 * @return self
		 */
		public function setLotID($lotID)
		{
		    $this->lotID = $lotID;
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
		 * Getter for purchaser
		 *
		 * @return mixed
		 */
		public function getPurchaser()
		{
		    return $this->purchaser;
		}
		
		/**
		 * Setter for purchaser
		 *
		 * @param mixed $purchaser Value to set
		
		 * @return self
		 */
		public function setPurchaser($purchaser)
		{
		    $this->purchaser = $purchaser;
		    return $this;
		}
		

		/**
		 * Getter for prixech
		 *
		 * @return mixed
		 */
		public function getPrixech()
		{
		    return $this->prixech;
		}
		
		/**
		 * Setter for prixech
		 *
		 * @param mixed $prixech Value to set
		
		 * @return self
		 */
		public function setPrixech($prixech)
		{
		    $this->prixech = $prixech;
		    return $this;
		}
		

		/**
		 * Getter for prixvente
		 *
		 * @return mixed
		 */
		public function getPrixvente()
		{
		    return $this->prixvente;
		}
		
		/**
		 * Setter for prixvente
		 *
		 * @param mixed $prixvente Value to set
		
		 * @return self
		 */
		public function setPrixvente($prixvente)
		{
		    $this->prixvente = $prixvente;
		    return $this;
		}
		

		/**
		 * Getter for prixesp
		 *
		 * @return mixed
		 */
		public function getPrixesp()
		{
		    return $this->prixesp;
		}
		
		/**
		 * Setter for prixesp
		 *
		 * @param mixed $prixesp Value to set
		
		 * @return self
		 */
		public function setPrixesp($prixesp)
		{
		    $this->prixesp = $prixesp;
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
		

	}

?>