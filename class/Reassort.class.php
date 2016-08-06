<?php

  	require_once(__DIR__ . "/../autoload/session.autoload.php");
	require_once(__DIR__ . "/../autoload/db.autoload.php");
	require_once(__DIR__ . "/../autoload/produitType.autoload.php");

	class Reassort{

		private $date;
		private $fait;
		private $type;
		private $id_prod;
		private $magasin;
		private $restant;
		private $pris;

		function Reassort()
		{
			
		}

		public function findReaStat()
		{
			$query = getDb()->prepare("SELECT pris, restant FROM reassorts WHERE id_produit_encaisse = ?");
			$query->execute(array($this->id_prod));

			$row = $query->fetch();

			$this->restant = $row['restant'];
			$this->pris = $row['pris'];
		}

		public function updateReaStat()
		{
			
			$query = getDb()->prepare("SELECT id FROM reassorts WHERE id_produit_encaisse = ?");

			$query->execute(array($this->id_prod));

			if($query->rowCount() > 0){
				$query = getDb()->prepare("UPDATE reassorts SET restant = :restant, pris = :pris, date = :date, heure = :heure WHERE id_produit_encaisse = :id_produit_encaisse");
				$query->execute(array(
					'restant' => $this->restant,
					'pris' => $this->pris,
					'date' => date("d/m/Y"),
					'heure' => date("H:i"),
					'id_produit_encaisse' => $this->id_prod
					));
			}
			else{
				$query = getDb()->prepare("INSERT INTO 
					reassorts (id_produit_encaisse, restant, pris, date, heure) 
					VALUES (:id_produit_encaisse, :restant, :pris, :date, :heure)");
				$query->execute(array(
					'id_produit_encaisse' => $this->id_prod,
					'restant' => $this->restant,
					'pris' => $this->pris,
					'date' => date("d/m/Y"),
					'heure' => date("H:i")
					));
			}

			$query = getDb()->prepare("UPDATE produits_encaisses SET reafait = 1 WHERE id_table = ?");
			$query->execute(array($this->id_prod));

		}

		public function getReaList()
		{
			$query = getDb()->prepare("SELECT * FROM produits_encaisses WHERE magasin = ? AND date = ? AND type = ? 
				AND reassorts = ? ORDER BY titre ASC
			");
			$query->execute(array($this->magasin, $this->date, $this->type, 'REASSORTI'));

			return $query->fetchAll();
		}

		public function getNoReaList()
		{
			$query = getDb()->prepare("SELECT * FROM produits_encaisses WHERE magasin = ? AND date = ? AND type = ? 
				AND reassorts = ? ORDER BY titre ASC
			");
			$query->execute(array($this->magasin, $this->date, $this->type, 'NON REA'));

			return $query->fetchAll();
		}

		public function updateRea()
		{
			$query = getDb()->prepare("UPDATE produits_encaisses SET reafait = :reafait WHERE id_table = :id_table");
			$query->execute(array(
				'reafait' => $this->fait,
				'id' => $this->id_prod
				));
		}

		public function isReaFait()
		{
			
			$query = getDb()->prepare("SELECT * FROM recap_global WHERE date = ? AND reafait = ? AND magasin = ?");
			$query->execute(array($this->date, '1', $this->magasin));

			if($query->rowCount() > 0){
				$this->fait = 1;
			}
			else{
				$this->fait = 0;
			}

		}

		public function getReaPercent()
		{

			$total = 0;
			$fait = 0;

			$query = getDb()->prepare("SELECT reafait FROM produits_encaisses
				WHERE date = ? AND type = ? AND magasin = ?");
			$query->execute(array($this->date, $this->type, $this->magasin));

			$total = $query->rowCount();


			$query = getDb()->prepare("SELECT reafait FROM produits_encaisses WHERE
				date = ? AND reafait = ? AND type = ? AND magasin = ?");
			$query->execute(array($this->date, '1', $this->type, $this->magasin));

			$fait = $query->rowCount();

			if($total != 0){
				$percent = $fait * 100 / $total;
			}
			else{
				$percent = 0;
			}

			return round($percent, 2);

		}

		/**
		 * Getter for pris
		 *
		 * @return mixed
		 */
		public function getPris()
		{
		    return $this->pris;
		}
		
		/**
		 * Setter for pris
		 *
		 * @param mixed $pris Value to set
		
		 * @return self
		 */
		public function setPris($pris)
		{
		    $this->pris = $pris;
		    return $this;
		}
		

		/**
		 * Getter for restant
		 *
		 * @return mixed
		 */
		public function getRestant()
		{
		    return $this->restant;
		}
		
		/**
		 * Setter for restant
		 *
		 * @param mixed $restant Value to set
		
		 * @return self
		 */
		public function setRestant($restant)
		{
		    $this->restant = $restant;
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
		 * Getter for fait
		 *
		 * @return mixed
		 */
		public function getFait()
		{
		    return $this->fait;
		}
		
		/**
		 * Setter for fait
		 *
		 * @param mixed $fait Value to set
		
		 * @return self
		 */
		public function setFait($fait)
		{
		    $this->fait = $fait;
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
		 * Getter for id_prod
		 *
		 * @return mixed
		 */
		public function getIdProd()
		{
		    return $this->id_prod;
		}
		
		/**
		 * Setter for id_prod
		 *
		 * @param mixed $idProd Value to set
		
		 * @return self
		 */
		public function setIdProd($idProd)
		{
		    $this->id_prod = $idProd;
		    return $this;
		}
		

	}

?>