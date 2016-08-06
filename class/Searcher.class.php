<?php

  	require_once(__DIR__ . "/../autoload/session.autoload.php");
	require_once(__DIR__ . "/../autoload/db.autoload.php");

	class Searcher{

		private $keyword;
		private $result;

		function Searcher($_keyword){

			$this->keyword = $_keyword;

		}

		public function buildSmallResult()
		{
			$this->result .= '<div class="tab-pane active margin-top-2" id="produits-encaisses">';

				$this->result .= '<legend>Résultats du searcher pour ' . $this->keyword . '</legend>';

				$this->findConcurrence();
				$this->findProduitsEncaisses();

			$this->result .= '</div>';
		}

		public function buildFullResult()
		{

			//$this->result .= correct_text($this->keyword);

			$this->result .= '

			<script>
	            $(\'#tab a\').click(function (e) {
	              e.preventDefault();
	              $(this).tab(\'show\');
	            })
          	</script>

          <ul class="nav nav-pills margin-top-1" id="tab">
            <li class="active"><a href="#produits-encaisses"><strong>Produits vendus</strong></a></li>
            <li><a href="#produits"><strong>Produits en base de données</strong></a></li>
            <li><a href="#fiches-reassorts"><strong>Fiches réassorts</strong></a></li>
            <li><a href="#fiches-comptabilite"><strong>Fiches comptabilité</strong></a></li>
            <li><a href="#transactions"><strong>Transactions</strong></a></li>
          </ul>
				 
			<div class="tab-content">

				<div class="tab-pane active" id="produits-encaisses">';

					$this->findConcurrence();
					$this->findProduitsEncaisses();

				$this->result .= '</div>';

				$this->result .= '<div class="tab-pane" id="fiches-reassorts">';

					$this->findFichesRea();

				$this->result .= '</div>';

				$this->result .= '<div class="tab-pane" id="fiches-comptabilite">';

					$this->findFichesCompta();

				$this->result .= '</div>';

				$this->result .= '<div class="tab-pane" id="produits">';

					$this->findProduits();

				$this->result .= '</div>';

				$this->result .= '<div class="tab-pane" id="transactions">';

					$this->findTransactions();

				$this->result .= '</div>

			</div>
			';

		}

		public function findConcurrence()
		{
			$query = getDb()->prepare("SELECT * FROM pattern_concur ORDER BY titre ASC");
			$query->execute(array('keyword' => '%' . $this->keyword . '%'));

			if($query->rowCount() == 0){

				$this->result .= '<h3>Aucun pattern marché n\'a été défini !</h3>';

			}
			else{

				$this->result .= '<div class="img-concur-container">';

						while ($row = $query->fetch()) {
							$this->result .= '
							<a href="' .  $row['before_pattern'] . htmlspecialchars($this->keyword) . $row['after_pattern'] . '" target="_blank"><img src="http://' .  $row['image'] . '" class="tooltip-me" data-toggle="tooltip" title="Trouver ' . htmlspecialchars($this->keyword) . ' sur ' . htmlspecialchars($row['titre']) . '"></a>';
						}

				$this->result .= '</div>';

				$this->result .= '
					<script>
						$(".tooltip-me").tooltip();
					</script>
				';

			}
		}

		private function findTransactions()
		{

			$query = getDb()->prepare("SELECT * FROM transactions WHERE 
			date LIKE :keyword OR heure LIKE :keyword OR magasin LIKE :keyword
			OR no_transaction LIKE :keyword
			ORDER BY no_transaction DESC LIMIT 100");
			$query->execute(array('keyword' => '%' . $this->keyword . '%'));

			if($query->rowCount() == 0){

				$this->result .= '<h3>Aucune transaction n\'a été trouvée !</h3>';

			}
			else{

				$this->result .= '<h3>' . $query->rowCount() . ' transactions trouvées</h3>';

				$this->result .= '<div>';

					$this->result .= '<table class="table table-striped table-bordered">
				              <thead>
				                <tr>
				                  <th>No</th>
				                  <th>Date</th>
				                  <th>Magasin</th>
				                  <th>Total ventes</th>
				                  <th>Total achats</th>
				                  <th>#</th>
				                </tr>
				              </thead>
				              <tbody>
					';

						while ($row = $query->fetch()) {
							$this->result .= '<tr>';
								$this->result .= '<td>' .  $row['no_transaction'] . '</td>';
								$this->result .= '<td>' .  $row['date'] . ' le ' . $row['heure'] . '</td>';
								$this->result .= '<td>' .  htmlspecialchars($row['magasin']) . '</td>';
								$this->result .= '<td>' .  $row['total_ventes'] . '€</td>';
								$this->result .= '<td>' .  $row['total_achats'] . '€</td>';
								$this->result .= '<td><a href="#modal" role="button" class="btn" data-toggle="modal" onclick="buildTransacModal(' . $row['no_transaction'] . ', \'' . $row['magasin'] . '\'); return false;">Consulter</a></td>';
							$this->result .= '</tr>';
						}


					$this->result .= '
						</tbody>

					</table>

				</div>';

			}

		}

		private function findProduits()
		{

			$query = getDb()->prepare("SELECT * FROM produits WHERE code LIKE :keyword OR 
			titre LIKE :keyword OR auteur LIKE :keyword OR editeur LIKE :keyword
			OR edition LIKE :keyword OR type LIKE :keyword
			ORDER BY id DESC LIMIT 100");
			$query->execute(array('keyword' => '%' . $this->keyword . '%'));

			if($query->rowCount() == 0){

				$this->result .= '<h3>Aucun produit n\'a été trouvé !</h3>';

			}
			else{

				$this->result .= '<h3>' . $query->rowCount() . ' produits trouvés</h3>';

				$this->result .= '<div>';

					$this->result .= '<table class="table table-striped table-bordered">
				              <thead>
				                <tr>
				                  <th>EAN / ISBN</th>
				                  <th>Titre</th>
				                  <th>Auteur</th>
				                  <th>Editeur</th>
				                  <th>Edition</th>
				                  <th>#</th>
				                </tr>
				              </thead>
				              <tbody>
					';

						while ($row = $query->fetch()) {
							$this->result .= '<tr>';
								$this->result .= '<td>' .  $row['code'] . '</td>';
								$this->result .= '<td>' .  $row['titre'] . '</td>';
								$this->result .= '<td>' .  $row['auteur'] . '</td>';
								$this->result .= '<td>' .  $row['editeur'] . '</td>';
								$this->result .= '<td>' .  $row['edition'] . '</td>';
								$this->result .= '<td><a href="#modal" role="button" class="btn" data-toggle="modal" onclick="buildProduitsModal(\'' . $row['code'] . '\'); return false;">Corriger</a></td>';
							$this->result .= '</tr>';
						}

					$this->result .= '
						</tbody>

					</table>

				</div>';

			}

		}

		private function findFichesCompta()
		{

			$query = getDb()->prepare("SELECT * FROM recap_global WHERE date LIKE :keyword OR magasin LIKE :keyword ORDER BY id DESC LIMIT 100");
			$query->execute(array('keyword' => '%' . $this->keyword . '%'));

			if($query->rowCount() == 0){

				$this->result .= '<h3>Aucune fiche comptabilité n\'a été trouvée !</h3>';

			}
			else{

				$this->result .= '<div>';

					$this->result .= '<table class="table table-striped table-bordered">
				              <thead>
				                <tr>
				                  <th>Date</th>
				                  <th>Magasin</th>
				                  <th>#</th>
				                </tr>
				              </thead>
				              <tbody>
					';

						while ($row = $query->fetch()) {
							$this->result .= '<tr>';
								$this->result .= '<td>' .  $row['date'] . '</td>';
								$this->result .= '<td>' .  htmlspecialchars($row['magasin']) . '</td>';
								$this->result .= '<td><a href="fiche-compta.php?date=' . $row['date'] . '&magasin=' . $row['magasin'] . '" class="btn">Consulter</a></td>';
							$this->result .= '</tr>';
						}

					$this->result .= '
						</tbody>

					</table>

				</div>';

			}

		}

		private function findFichesRea()
		{

			$query = getDb()->prepare("SELECT * FROM recap_global WHERE date LIKE :keyword OR magasin LIKE :keyword ORDER BY id DESC LIMIT 100");
			$query->execute(array('keyword' => '%' . $this->keyword . '%'));

			if($query->rowCount() == 0){

				$this->result .= '<h3>Aucune fiche réassort n\'a été trouvée !</h3>';

			}
			else{

				$this->result .= '<div>';

					$this->result .= '<table class="table table-striped table-bordered">
				              <thead>
				                <tr>
				                  <th>Date</th>
				                  <th>Magasin</th>
				                  <th>#</th>
				                </tr>
				              </thead>
				              <tbody>
					';

						while ($row = $query->fetch()) {
							$this->result .= '<tr>';
								$this->result .= '<td>' .  $row['date'] . '</td>';
								$this->result .= '<td>' .  htmlspecialchars($row['magasin']) . '</td>';
								$this->result .= '<td><a href="rea.php?date=' . $row['date'] . '&magasin=' . htmlspecialchars($row['magasin']) . '"><button class="btn">Consulter</button></a></td>';
							$this->result .= '</tr>';
						}

					$this->result .= '
						</tbody>

					</table>

				</div>';

			}

		}

		private function findProduitsEncaisses(){

			$query = getDb()->prepare("SELECT * FROM produits_encaisses 
				WHERE titre LIKE :keyword OR auteur LIKE :keyword OR 
				editeur LIKE :keyword OR code LIKE :keyword OR 
				date LIKE :keyword OR heure LIKE :keyword OR magasin 
				LIKE :keyword OR edition LIKE :keyword
				OR reassorts LIKE :keyword 
				OR no_transaction LIKE :keyword
				OR type LIKE :keyword
				ORDER BY id_table DESC LIMIT 400");
			$query->execute(array('keyword' => '%' . $this->keyword . '%'));

			if($query->rowCount() == 0){

				$this->result .= '<h5>Aucun produit vendu n\'a été trouvé !</h5>';

			}
			else{

				$this->result .= '<div>';

					$this->result .= '<h5>Produit vendu ' . $query->rowCount() . ' fois</h5>';

					$this->result .= '<table class="table table-striped table-bordered">
				              <thead>
				                <tr>
				                  <th>Date de vente</th>
				                  <th>Prix</th>
				                  <th>EAN / ISBN</th>
				                  <th>Réassorti</th>
				                  <th>Titre</th>
				                  <th>Auteur</th>
				                  <th>Editeur</th>
				                  <th>Edition</th>
				                  <th>#</th>
				                </tr>
				              </thead>
				              <tbody>
					';

						while ($row = $query->fetch()) {
							$this->result .= '<tr>';
								$this->result .= '<td>#' . $row['no_transaction'] . '<br>' .  $row['date'] . ' à ' . $row['heure'] . ' sur ' . $row['magasin'] . '</td>';
								$this->result .= '<td>' .  $row['prix'] . '€</td>';
								$this->result .= '<td class="' . $row['code'] . '">' .  $row['code'] . '</td>';
								$this->result .= '<td>' .  $row['reassorts'] . '</td>';
								$this->result .= '<td>' .  $row['titre'] . '</td>';
								$this->result .= '<td>' .  $row['auteur'] . '</td>';
								$this->result .= '<td>' .  $row['editeur'] . '</td>';
								$this->result .= '<td>' .  $row['edition'] . '</td>';
								$this->result .= '<td><a href="#modal" role="button" class="btn" data-toggle="modal" onclick="buildProduitsModal(\'' . $row['code'] . '\'); return false;">Corriger</a></td>';
							$this->result .= '</tr>';

							//$this->result .= '<script>$(".' . $row['code'] . '").barcode("' . $row['code'] . '", "code128", {barWidth:1, barHeight:15})</script>';
						}

					$this->result .= '
						</tbody>

					</table>

				</div>';

			}

		}

		/**
		 * Getter for result
		 *
		 * @return mixed
		 */
		public function getResult()
		{
		    return $this->result;
		}
		
		/**
		 * Setter for result
		 *
		 * @param mixed $result Value to set
		
		 * @return self
		 */
		public function setResult($result)
		{
		    $this->result = $result;
		    return $this;
		}
		

		/**
		 * Getter for keyword
		 *
		 * @return mixed
		 */
		public function getKeyword()
		{
		    return $this->keyword;
		}
		
		/**
		 * Setter for keyword
		 *
		 * @param mixed $keyword Value to set
		
		 * @return self
		 */
		public function setKeyword($keyword)
		{
		    $this->keyword = $keyword;
		    return $this;
		}
		
	}

?>