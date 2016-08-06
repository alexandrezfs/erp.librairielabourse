<?php

	require_once(__DIR__ . "/../class/SuspectProduct.class.php");
  	require_once(__DIR__ . "/../autoload/session.autoload.php");
	require_once(__DIR__ . "/../autoload/db.autoload.php");

	class Fraude{

		private $date;

		function Fraude()
		{

		}

		public function getSuspectProducts()
		{
			$suspectTab = array();

			$query = getDb()->prepare("SELECT * FROM produits_encaisses WHERE date = ?");
			$query->execute(array($this->date));

			while ($row = $query->fetch()) {

				if(strlen($row['code']) > 3){

					$moyenne = 0;

					$query2 = getDb()->prepare("SELECT prix FROM produits_encaisses WHERE code = ? AND id_table < ?");
					$query2->execute(array($row['code'], $row['id_table']));

					if ($query2->rowCount() > 0) {
						
						while ($row2 = $query2->fetch()) {
							$moyenne += $row2['prix'];
						}

						$moyenne = $moyenne / $query2->rowCount();

						$intervalleI = $moyenne - 5;
						$intervalleO = $moyenne + 5;

						if(!($row['prix'] > $intervalleI && $row['prix'] < $intervalleO)){

							$sp = new SuspectProduct();
							$sp->setMagasin($row['magasin']);
							$sp->setDate($row['date']);
							$sp->setHeure($row['heure']);
							$sp->setCode($row['code']);
							$sp->setTitre($row['titre']);
							$sp->setAuteur($row['auteur']);
							$sp->setEditeur($row['editeur']);
							$sp->setPrix($row['prix']);
							$sp->setType($row['type']);
							$sp->setUsualPrice(number_format($moyenne, 2, '.', ' '));

							$suspectTab[] = $sp;
						}
					}

				}

			}

			return $suspectTab;
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
		

	}