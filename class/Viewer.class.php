<?php

  	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/db.autoload.php");
  	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Transaction.class.php");
  	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Magasin.class.php");
  	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/MobileDetect.class.php");

	class Viewer{

		private $date;
		private $transaction;
		private $globals;
		private $magasin;
		private $magasinObj;
		private $MobileDetect;
		private $totalChiffreJournee = 0;
		private $totalProduits = 0;

		//SPE
		private $totalChiffreJourneeLYON = 0;
		private $totalChiffreJourneePARIS = 0;
		private $totalProduitsLYON = 0;
		private $totalProduitsPARIS = 0;
		//END SPE

		function Viewer()
		{
		  $this->MobileDetect = new Mobile_Detect();

		  $this->transaction = new Transaction();
		  $this->magasinObj = new Magasin();
		  
		  $this->transaction->setDate(date("d/m/Y"));
		  $this->globals = $this->transaction->getGlobalsWithDATE();

		  $this->date = date("d/m/Y");
		}

		public function getNbProduits()
		{
			$query = getDb()->prepare("SELECT id_table FROM produits_encaisses
				WHERE date = ? AND magasin = ?");
			$query->execute(array($this->date, $this->magasin));

			return $query->rowCount();
		}

		public function getPrintedView()
		{
          if(count($this->globals) == 0){echo '<h4>Aucun chiffre pour le moment</h4>';}
          else{

            echo '

              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Magasin</th>
                    <th>Ventes</th>
                    <th>NB de produits</th>
                    <th>Moy. / produit</th>
                    <th>En ligne</th>
                    <th>#</th>
                  </tr>
                </thead>
                <tbody>
            ';

            foreach ($this->globals as $key => $value) {

              $this->magasin = $value['magasin'];
              $this->magasinObj->setNom($this->magasin);

              $rank = $key + 1;

              echo '<tr>';
	            echo '<td><strong>#' . $rank . '</strong> ' .  $value['magasin'] . '</td>';
                echo '<td><strong>' .  $value['chiffre_journee'] . '€</strong></td>';
                echo '<td>' . $this->getNbProduits() . '</td>';

                //making totals
                $this->totalChiffreJournee += $value['chiffre_journee'];
                $this->totalProduits += $this->getNbProduits();

                	//SPE
                	if ($this->magasin == 'Cine Corner') {
                		$this->totalChiffreJourneePARIS += $value['chiffre_journee']; 
                		$this->totalProduitsPARIS += $this->getNbProduits();
                	}

                	if ($this->magasin == 'Principale Annexe' 
                		|| $this->magasin == 'Principale'
                		|| $this->magasin == 'Principale Reception'
                		|| $this->magasin == 'Bourse Bis'
                		|| $this->magasin == 'Serlin') {
                		
                		$this->totalChiffreJourneeLYON += $value['chiffre_journee']; 
                		$this->totalProduitsLYON += $this->getNbProduits();
                	}
                	//END SPE
                //end making totals

                if($this->getNbProduits() != 0){
                	$moyenne = $value['chiffre_journee'] / $this->getNbProduits();
                }
               	else{
               		$moyenne = 0;
               	}

                echo '<td>' . number_format($moyenne, 2, '.', ' ') . ' €</td>';

                if($this->magasinObj->isAlive()){
                	echo '<td><i class="fa fa-check-square" style="font-size:1.2em;"></i></td>';
                }
                else{
                	echo '<td><img src="images/design/warning.png"></td>';
                }

                echo '<td><a href="rea.php?date=' . $value['date'] . '&magasin=' . $value['magasin'] . '"><button class="btn">Réassort</button></a></td>';
                
              echo '</tr>';

            }

              echo '<tr>';
                echo '<td>> LYON</td>';
                echo '<td><strong>' . number_format($this->totalChiffreJourneeLYON, 2, '.', ' ') . '€</strong></td>';
                echo '<td><strong>' . $this->totalProduitsLYON . '</strong></td>';

                if($this->totalProduitsLYON != 0){
                	$moyenne = $this->totalChiffreJourneeLYON / $this->totalProduitsLYON;
                }
               	else{
               		$moyenne = 0;
               	}

                echo '<td><strong>' . number_format($moyenne, 2, '.', ' ') . '€</strong></td>';
                echo '<td>X</td>';
                echo '<td>X</td>';

              echo '</tr>';

              echo '<tr>';
                echo '<td>> PARIS</td>';
                echo '<td><strong>' . number_format($this->totalChiffreJourneePARIS, 2, '.', ' ') . '€</strong></td>';
                echo '<td><strong>' . $this->totalProduitsPARIS . '</strong></td>';

                if($this->totalProduitsPARIS != 0){
                	$moyenne = $this->totalChiffreJourneePARIS / $this->totalProduitsPARIS;
                }
               	else{
               		$moyenne = 0;
               	}

                echo '<td><strong>' . number_format($moyenne, 2, '.', ' ') . '€</strong></td>';
                echo '<td>X</td>';
                echo '<td>X</td>';

              echo '</tr>';

              echo '<tr>';
                echo '<td><strong>TOTAUX</strong></td>';
                echo '<td><strong>' . number_format($this->totalChiffreJournee, 2, '.', ' ') . '€</strong></td>';
                echo '<td><strong>' . $this->totalProduits . '</strong></td>';

                if($this->totalProduits != 0){
                	$moyenne = $this->totalChiffreJournee / $this->totalProduits;
                }
               	else{
               		$moyenne = 0;
               	}

                echo '<td><strong>' . number_format($moyenne, 2, '.', ' ') . '€</strong></td>';
                echo '<td>X</td>';
                echo '<td>X</td>';

              echo '</tr>';

            echo '
              </tbody>

            </table>';

            if(!$this->MobileDetect->isMobile()){

	            echo '
				<table class="table table-striped table-bordered small-text">
	              <thead>
	                <tr>
	                  <th>Magasin</th>
	                  <th>Heure</th>
	                  <th>Prix</th>
	                  <th>Titre</th>
	                  <th>Auteur</th>
	                  <th>Editeur</th>
	                  <th>Edition</th>
	                </tr>
	              </thead>
	              <tbody>
	            ';

					$this->transaction->setDate(date("d/m/Y"));
					$products = $this->transaction->getProductsByDATE();

					foreach ($products as $subKey => $subValue) {
						echo '
						<tr>
							<td><strong>' . $subValue['magasin'] . '</strong></td>
							<td>' . $subValue['heure'] . '</td>
							<td>' . $subValue['prix'] . '€</td>
							<td>' . $subValue['titre'] . '</td>
							<td>' . $subValue['auteur'] . '</td>
							<td>' . $subValue['editeur'] . '</td>
							<td>' . $subValue['edition'] . '</td>
						</tr>
						';
					}

	            echo '
	            	</tbody>

	            </table>
	            ';
            }

          }

		}

		public function getMobilePrintedView()
		{
          if(count($this->globals) == 0){echo '<h4>Aucun chiffre pour le moment</h4>';}
          else{

            echo '

              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Magasin</th>
                    <th>Ventes</th>
                    <th>NB de produits</th>
                    <th>Moyenne / produit</th>
                  </tr>
                </thead>
                <tbody>
            ';

            foreach ($this->globals as $key => $value) {

              $this->magasin = $value['magasin'];
              $this->magasinObj->setNom($this->magasin);

              echo '<tr>';
                echo '<td>' .  $value['magasin'] . '</td>';
                echo '<td><strong>' .  $value['chiffre_journee'] . '€</strong></td>';
                echo '<td>' . $this->getNbProduits() . '</td>';

                //making totals
                $this->totalChiffreJournee += $value['chiffre_journee'];
                $this->totalProduits += $this->getNbProduits();
                //end making totals

                if($this->getNbProduits() != 0){
                	$moyenne = $value['chiffre_journee'] / $this->getNbProduits();
                }
               	else{
               		$moyenne = 0;
               	}

                echo '<td>' . number_format($moyenne, 2, '.', ' ') . '€</td>';

              echo '</tr>';

            }

              echo '<tr>';
                echo '<td>TOTAUX</td>';
                echo '<td><strong>' .  $this->totalChiffreJournee . '€</strong></td>';
                echo '<td>' . $this->totalProduits . '</td>';

                if($this->getNbProduits() != 0){
                	$moyenne = $this->totalChiffreJournee / $this->totalProduits;
                }
               	else{
               		$moyenne = 0;
               	}

                echo '<td>' . number_format($moyenne, 2, '.', ' ') . '€</td>';

              echo '</tr>';

            echo '
              </tbody>

            </table>';
            }

          }

		/**
		 * Getter for transaction
		 *
		 * @return mixed
		 */
		public function getTransaction()
		{
		    return $this->transaction;
		}
		
		/**
		 * Setter for transaction
		 *
		 * @param mixed $transaction Value to set
		
		 * @return self
		 */
		public function setTransaction($transaction)
		{
		    $this->transaction = $transaction;
		    return $this;
		}
		

		/**
		 * Getter for globals
		 *
		 * @return mixed
		 */
		public function getGlobals()
		{
		    return $this->globals;
		}
		
		/**
		 * Setter for globals
		 *
		 * @param mixed $globals Value to set
		
		 * @return self
		 */
		public function setGlobals($globals)
		{
		    $this->globals = $globals;
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

?>