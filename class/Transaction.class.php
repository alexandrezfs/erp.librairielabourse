<?php

  	require_once(__DIR__ . "/../autoload/session.autoload.php");
	require_once(__DIR__ . "/../autoload/db.autoload.php");

	class Transaction{

		private $no_transaction;
		private $date;
		private $heure;
		private $magasin;

		function Transaction()
		{

		}

		public function getCheque()
		{
			$query = getDb()->prepare("SELECT SUM(cheque) FROM transactions WHERE date = ? AND magasin = ?");
			$query->execute(array($this->date, $this->magasin));

			$row = $query->fetch();

			return number_format($row['SUM(cheque)'], 2, '.', ' ');
		}

		public function getCB()
		{
			$query = getDb()->prepare("SELECT SUM(cb) FROM transactions WHERE date = ? AND magasin = ?");
			$query->execute(array($this->date, $this->magasin));

			$row = $query->fetch();

			return number_format($row['SUM(cb)'], 2, '.', ' ');
		}

		public function getEsp()
		{
			$query = getDb()->prepare("SELECT SUM(esp_reel) FROM transactions WHERE date = ? AND magasin = ?");
			$query->execute(array($this->date, $this->magasin));

			$row = $query->fetch();

			return number_format($row['SUM(esp_reel)'], 2, '.', ' ');
		}

		public function getEchange()
		{
			$query = getDb()->prepare("SELECT SUM(echange) FROM transactions WHERE date = ? AND magasin = ?");
			$query->execute(array($this->date, $this->magasin));

			$row = $query->fetch();

			return number_format($row['SUM(echange)'], 2, '.', ' ');
		}

		public function getEchangeUtil()
		{
			$query = getDb()->prepare("SELECT SUM(echange_util) FROM transactions WHERE date = ? AND magasin = ?");
			$query->execute(array($this->date, $this->magasin));

			$row = $query->fetch();

			return number_format($row['SUM(echange_util)'], 2, '.', ' ');
		}

		public function getAvoirUtil()
		{
			$query = getDb()->prepare("SELECT SUM(avoir_util) FROM transactions WHERE date = ? AND magasin = ?");
			$query->execute(array($this->date, $this->magasin));

			$row = $query->fetch();

			return number_format($row['SUM(avoir_util)'], 2, '.', ' ');
		}

		public function getAvoirEmis()
		{
			$query = getDb()->prepare("SELECT SUM(avoir_emis) FROM transactions WHERE date = ? AND magasin = ?");
			$query->execute(array($this->date, $this->magasin));

			$row = $query->fetch();

			return number_format($row['SUM(avoir_emis)'], 2, '.', ' ');
		}

		public function getEspEmis()
		{
			$query = getDb()->prepare("SELECT SUM(esp_reel_emis) FROM transactions WHERE date = ? AND magasin = ?");
			$query->execute(array($this->date, $this->magasin));

			$row = $query->fetch();

			return number_format($row['SUM(esp_reel_emis)'], 2, '.', ' ');
		}

		public function getTotalLIVREPrix()
		{
			$query = getDb()->prepare("SELECT SUM(prix) FROM produits_encaisses WHERE date = ? AND magasin = ? AND type = ?");
			$query->execute(array($this->date, $this->magasin, 'LIVRE'));

			$row = $query->fetch();

			return str_replace(' ', '', number_format($row['SUM(prix)'], 2, '.', ' '));
		}

		public function getTotalDVDPrix()
		{
			$query = getDb()->prepare("SELECT SUM(prix) FROM produits_encaisses WHERE date = ? AND magasin = ? AND type = ?");
			$query->execute(array($this->date, $this->magasin, 'DVD'));

			$row = $query->fetch();

			return str_replace(' ', '', number_format($row['SUM(prix)'], 2, '.', ' '));
		}

		public function getTotalBLURAYPrix()
		{
			$query = getDb()->prepare("SELECT SUM(prix) FROM produits_encaisses WHERE date = ? AND magasin = ? AND type = ?");
			$query->execute(array($this->date, $this->magasin, 'BLU-RAY'));

			$row = $query->fetch();

			return str_replace(' ', '', number_format($row['SUM(prix)'], 2, '.', ' '));
		}

		public function getTotalCDPrix()
		{
			$query = getDb()->prepare("SELECT SUM(prix) FROM produits_encaisses WHERE date = ? AND magasin = ? AND type = ?");
			$query->execute(array($this->date, $this->magasin, 'CD'));

			$row = $query->fetch();

			return str_replace(' ', '', number_format($row['SUM(prix)'], 2, '.', ' '));
		}

		public function getTotalVINYLEPrix()
		{
			$query = getDb()->prepare("SELECT SUM(prix) FROM produits_encaisses WHERE date = ? AND magasin = ? AND type = ?");
			$query->execute(array($this->date, $this->magasin, 'VINYLE'));

			$row = $query->fetch();

			return str_replace(' ', '', number_format($row['SUM(prix)'], 2, '.', ' '));
		}

		public function getTotalJEUPrix()
		{
			$query = getDb()->prepare("SELECT SUM(prix) FROM produits_encaisses WHERE date = ? AND magasin = ? AND type = ?");
			$query->execute(array($this->date, $this->magasin, 'JEU'));

			$row = $query->fetch();

			return str_replace(' ', '', number_format($row['SUM(prix)'], 2, '.', ' '));
		}

		public function getTotalCONSOLEPrix()
		{
			$query = getDb()->prepare("SELECT SUM(prix) FROM produits_encaisses WHERE date = ? AND magasin = ? AND type = ?");
			$query->execute(array($this->date, $this->magasin, 'CONSOLE'));

			$row = $query->fetch();

			return str_replace(' ', '', number_format($row['SUM(prix)'], 2, '.', ' '));
		}

		public function getTotalAUTREPrix()
		{
			$query = getDb()->prepare("SELECT SUM(prix) FROM produits_encaisses WHERE date = ? AND magasin = ? AND type = ?");
			$query->execute(array($this->date, $this->magasin, 'AUTRE'));

			$row = $query->fetch();

			return str_replace(' ', '', number_format($row['SUM(prix)'], 2, '.', ' '));
		}

		public function getTotalAUTRE()
		{
			$query = getDb()->prepare("SELECT id FROM produits_encaisses WHERE date = ? AND magasin = ? AND type = ?");
			$query->execute(array($this->date, $this->magasin, 'AUTRE'));

			return $query->rowCount();
		}

		public function getTotalCD()
		{
			$query = getDb()->prepare("SELECT id FROM produits_encaisses WHERE date = ? AND magasin = ? AND type = ?");
			$query->execute(array($this->date, $this->magasin, 'CD'));

			return $query->rowCount();
		}

		public function getTotalVINYLE()
		{
			$query = getDb()->prepare("SELECT id FROM produits_encaisses WHERE date = ? AND magasin = ? AND type = ?");
			$query->execute(array($this->date, $this->magasin, 'VINYLE'));

			return $query->rowCount();
		}

		public function getTotalJEU()
		{
			$query = getDb()->prepare("SELECT id FROM produits_encaisses WHERE date = ? AND magasin = ? AND type = ?");
			$query->execute(array($this->date, $this->magasin, 'JEU'));

			return $query->rowCount();
		}

		public function getTotalCONSOLE()
		{
			$query = getDb()->prepare("SELECT id FROM produits_encaisses WHERE date = ? AND magasin = ? AND type = ?");
			$query->execute(array($this->date, $this->magasin, 'CONSOLE'));

			return $query->rowCount();
		}

		public function getTotalDVD()
		{
			$query = getDb()->prepare("SELECT id FROM produits_encaisses WHERE date = ? AND magasin = ? AND type = ?");
			$query->execute(array($this->date, $this->magasin, 'DVD'));

			return $query->rowCount();
		}

		public function getTotalBLURAY()
		{
			$query = getDb()->prepare("SELECT id FROM produits_encaisses WHERE date = ? AND magasin = ? AND type = ?");
			$query->execute(array($this->date, $this->magasin, 'BLU-RAY'));

			return $query->rowCount();
		}

		public function getTotalLIVRE()
		{
			$query = getDb()->prepare("SELECT id FROM produits_encaisses WHERE date = ? AND magasin = ? AND type = ?");
			$query->execute(array($this->date, $this->magasin, 'LIVRE'));

			return $query->rowCount();
		}

		public function getTotalProdReaPrix()
		{
			$query = getDb()->prepare("SELECT SUM(prix) FROM produits_encaisses WHERE date = ? AND magasin = ? AND reassorts = ?");
			$query->execute(array($this->date, $this->magasin, 'REASSORTI'));

			$row = $query->fetch();

			return number_format($row['SUM(prix)'], 2, '.', ' ');
		}

		public function getTotalProdNoReaPrix()
		{
			$query = getDb()->prepare("SELECT SUM(prix) FROM produits_encaisses WHERE date = ? AND magasin = ? AND reassorts = ?");
			$query->execute(array($this->date, $this->magasin, 'NON REA'));

			$row = $query->fetch();

			return number_format($row['SUM(prix)'], 2, '.', ' ');
		}

		public function getTotalProdPrix()
		{
			$query = getDb()->prepare("SELECT SUM(prix) FROM produits_encaisses WHERE date = ? AND magasin = ?");
			$query->execute(array($this->date, $this->magasin));

			$row = $query->fetch();

			return number_format($row['SUM(prix)'], 2, '.', ' ');
		}

		public function getTotalProdNoRea()
		{
			$query = getDb()->prepare("SELECT id FROM produits_encaisses WHERE date = ? AND magasin = ? AND reassorts = ?");
			$query->execute(array($this->date, $this->magasin, 'NON REA'));

			return $query->rowCount();
		}

		public function getTotalProdRea()
		{
			$query = getDb()->prepare("SELECT id FROM produits_encaisses WHERE date = ? AND magasin = ? AND reassorts = ?");
			$query->execute(array($this->date, $this->magasin, 'REASSORTI'));

			return $query->rowCount();
		}

		public function getTotalProd()
		{
			$query = getDb()->prepare("SELECT id FROM produits_encaisses WHERE date = ? AND magasin = ?");
			$query->execute(array($this->date, $this->magasin));

			return $query->rowCount();
		}

		public function initHeure()
		{
			$query = getDb()->prepare("SELECT heure FROM transactions WHERE no_transaction = ? AND magasin = ?");
			$query->execute(array($this->no_transaction, $this->magasin));

			$row = $query->fetch();

			$this->heure = $row['heure'];
		}

		public function getPrintedDetailledContainer()
		{
			$this->initHeure();

			$avoirsEntres = $this->getAvoirsEntres();
			$avoirsEmisAchats = $this->getAvoirsEmisAchats();
			$avoirsEmisTransac = $this->getAvoirsEmisTransac();
			$echangesDirects = $this->getEchangesDirects();
			$achats = $this->getAchats();
			$products = $this->getProducts();

			if (count($avoirsEntres) > 0) {
				$modal .= '
				
				<p class="title-style-transac">Avoirs entrés(achats)</p>

				<table>
	              <thead>
	                <tr>
	                  <th>No avoir</th>
	                  <th>Provenance</th>
	                  <th>Montant</th>
	                  <th>NC</th>
	                  <th>CD</th>
	                  <th>Bon cadeau</th>
	                </tr>
	              </thead>
	              <tbody>

				';

				foreach ($avoirsEntres as $key => $value) {

					$modal .= '
					<tr>' 
						. '<td>' . $value['no_fichier'] . '</td>'
						. '<td>' . $value['magasin_hote'] . '</td>'
						. '<td>' . $value['montant'] . '</td>'
						. '<td>' . $value['nc'] . '</td>'
						. '<td>' . $value['uniquement_cd'] . '</td>'
						. '<td>' . $value['bon_cadeau'] . '</td>' .
					'</tr>';

				}

				$modal .= '</table>';
			}

			if(count($avoirsEmisTransac) > 0){
				$modal .= '
				
				<p class="title-style-transac">Avoirs émis (transactions)</p>

				<table>
	              <thead>
	                <tr>
	                  <th>No Avoir</th>
	                  <th>Montant</th>
	                  <th>type</th>
	                </tr>
	              </thead>
	              <tbody>

				';

				foreach ($avoirsEmisTransac as $key => $value) {

					$modal .= '
					<tr>' 
						. '<td>' . $value['no_avoir_sorti'] . '</td>'
						. '<td>' . $value['montant'] . '</td>'
						. '<td>' . $value['type'] . '</td>' .
					'</tr>';

				}

				$modal .= '</table>';
			}	

			if(count($avoirsEmisAchats) > 0){
				$modal .= '
				
				<p class="title-style-transac">Avoirs émis (achats)</p>

				<table>
	              <thead>
	                <tr>
	                  <th>No avoir</th>
	                  <th>Montant</th>
	                  <th>No fichier</th>
	                  <th>NC</th>
	                  <th>CD</th>
	                </tr>
	              </thead>
	              <tbody>

				';

				foreach ($avoirsEmisAchats as $key => $value) {

					$modal .= '
					<tr>' 
						. '<td>' . $value['no_avoir'] . '</td>'
						. '<td>' . $value['montant'] . '</td>'
						. '<td>' . $value['no_fichier'] . '</td>'
						. '<td>' . $value['nc'] . '</td>' .
						'<td>' . $value['cd'] . '</td>' .
					'</tr>';

				}

				$modal .= '</table>';
			}	

			if(count($echangesDirects) > 0){
				$modal .= '
				<p class="title-style-transac">Echanges directs</p>

				<table>
	              <thead>
	                <tr>
	                  <th>Nom</th>
	                  <th>Montant</th>
	                  <th>Client redondant</th>
	                </tr>
	              </thead>
	              <tbody>

				';

				foreach ($echangesDirects as $key => $value) {

					$modal .= '
					<tr>' 
						. '<td>' . $value['nom'] . '</td>'
						. '<td>' . $value['montant'] . '</td>'
						. '<td>' . $value['redondant'] . '</td>' .
					'</tr>';

				}

				$modal .= '</table>';
			}	

			if(count($achats) > 0){
				$modal .= '
				<p class="title-style-transac">Achats</p>			

				<table>
	              <thead>
	                <tr>
	                  <th>Montant</th>
	                  <th>No fichier</th>
	                  <th>Type</th>
	                  <th>Achats de</th>
	                </tr>
	              </thead>
	              <tbody>

				';

				foreach ($achats as $key => $value) {
					$modal .= '
					<tr>' 
						. '<td>' . $value['montant'] . '</td>'
						. '<td>' . $value['nofichier'] . '</td>'
						. '<td>' . $value['paiement_en'] . '</td>'
						. '<td>
							Livres : ' . $value['livre'] . '<br>
							Manga : ' . $value['manga'] . '<br>
							CD : ' . $value['cd'] . '<br>
							Vinyle : ' . $value['vinyle'] . '<br>
							DVD : ' . $value['dvd'] . '<br>
							Blu-Ray : ' . $value['bluray'] . '<br>
							Jeu : ' . $value['jeu'] . '<br>
							Console : ' . $value['console'] . '<br>
							Autre : ' . $value['autre'] . '<br>
						</td>' .
					'</tr>';

				}

				$modal .= '</table>';
			}

			if(count($products) > 0){
				$modal .= '

				<p class="title-style-transac">Produits vendus</p>

				<table>';

				foreach ($products as $key => $value) {

					$modal .= '
					<tr>' 
						. '<td>' . $value['titre'] . '</td>'
						. '<td>' . $value['code'] . '</td>'
						. '<td>' . $value['type'] . '</td>'
						. '<td>' . $value['prix'] . ' €</td>' .
					'</tr>';

				}

				$modal .= '</table>';

			}

			return $modal;

		}

		public function getPrintedDetailledModal()
		{
			$this->initHeure();

			$avoirsEntres = $this->getAvoirsEntres();
			$avoirsEmisAchats = $this->getAvoirsEmisAchats();
			$avoirsEmisTransac = $this->getAvoirsEmisTransac();
			$echangesDirects = $this->getEchangesDirects();
			$achats = $this->getAchats();
			$products = $this->getProducts();

			if (count($avoirsEntres) > 0) {
				$modal .= '
				
				<legend>Avoirs entrés</legend>

				<table class="table table-striped table-bordered">
	              <thead>
	                <tr>
	                  <th>No avoir</th>
	                  <th>Provenance</th>
	                  <th>Montant</th>
	                  <th>NC</th>
	                  <th>CD</th>
	                  <th>Bon cadeau</th>
	                </tr>
	              </thead>
	              <tbody>

				';

				foreach ($avoirsEntres as $key => $value) {

					$modal .= '
					<tr>' 
						. '<td>' . $value['no_fichier'] . '</td>'
						. '<td>' . $value['magasin_hote'] . '</td>'
						. '<td>' . $value['montant'] . '</td>'
						. '<td>' . $value['nc'] . '</td>'
						. '<td>' . $value['uniquement_cd'] . '</td>'
						. '<td>' . $value['bon_cadeau'] . '</td>' .
					'</tr>';

				}

				$modal .= '</table>';
			}

			if(count($avoirsEmisTransac) > 0){
				$modal .= '
				
				<legend>Avoirs émis (transactions)</legend>

				<table class="table table-striped table-bordered">
	              <thead>
	                <tr>
	                  <th>No Avoir</th>
	                  <th>Montant</th>
	                  <th>type</th>
	                </tr>
	              </thead>
	              <tbody>

				';

				foreach ($avoirsEmisTransac as $key => $value) {

					$modal .= '
					<tr>' 
						. '<td>' . $value['no_avoir_sorti'] . '</td>'
						. '<td>' . $value['montant'] . '</td>'
						. '<td>' . $value['type'] . '</td>' .
					'</tr>';

				}

				$modal .= '</table>';
			}	

			if(count($avoirsEmisAchats) > 0){
				$modal .= '
				
				<legend>Avoirs émis (achats)</legend>

				<table class="table table-striped table-bordered">
	              <thead>
	                <tr>
	                  <th>No avoir</th>
	                  <th>Montant</th>
	                  <th>No fichier</th>
	                  <th>NC</th>
	                  <th>CD</th>
	                </tr>
	              </thead>
	              <tbody>

				';

				foreach ($avoirsEmisAchats as $key => $value) {

					$modal .= '
					<tr>' 
						. '<td>' . $value['no_avoir'] . '</td>'
						. '<td>' . $value['montant'] . '</td>'
						. '<td>' . $value['no_fichier'] . '</td>'
						. '<td>' . $value['nc'] . '</td>' .
						'<td>' . $value['cd'] . '</td>' .
					'</tr>';

				}

				$modal .= '</table>';
			}	

			if(count($echangesDirects) > 0){
				$modal .= '
					<legend>Echanges directs</legend>

				<table class="table table-striped table-bordered">
	              <thead>
	                <tr>
	                  <th>Nom</th>
	                  <th>Montant</th>
	                  <th>Client redondant</th>
	                </tr>
	              </thead>
	              <tbody>

				';

				foreach ($echangesDirects as $key => $value) {

					$modal .= '
					<tr>' 
						. '<td>' . $value['nom'] . '</td>'
						. '<td>' . $value['montant'] . '</td>'
						. '<td>' . $value['redondant'] . '</td>' .
					'</tr>';

				}

				$modal .= '</table>';
			}	

			if(count($achats) > 0){
				$modal .= '
				<legend>Achats</legend>			

				<table class="table table-striped table-bordered">
	              <thead>
	                <tr>
	                  <th>Montant</th>
	                  <th>No fichier</th>
	                  <th>Type</th>
	                  <th>Achats de</th>
	                </tr>
	              </thead>
	              <tbody>

				';

				foreach ($achats as $key => $value) {
					$modal .= '
					<tr>' 
						. '<td>' . $value['montant'] . '</td>'
						. '<td>' . $value['nofichier'] . '</td>'
						. '<td>' . $value['paiement_en'] . '</td>'
						. '<td>
							Livres : ' . $value['livre'] . '<br>
							Manga : ' . $value['manga'] . '<br>
							CD : ' . $value['cd'] . '<br>
							Vinyle : ' . $value['vinyle'] . '<br>
							DVD : ' . $value['dvd'] . '<br>
							Blu-Ray : ' . $value['bluray'] . '<br>
							Jeu : ' . $value['jeu'] . '<br>
							Console : ' . $value['console'] . '<br>
							Autre : ' . $value['autre'] . '<br>
						</td>' .
					'</tr>';

				}

				$modal .= '</table>';
			}

			if(count($products) > 0){
				$modal .= '

				<legend>Produits vendus</legend>

				<table class="table table-bordered">';

				foreach ($products as $key => $value) {

					$modal .= '
					<tr>' 
						. '<td>' . $value['titre'] . '</td>'
						. '<td>' . $value['code'] . '</td>'
						. '<td>' . $value['type'] . '</td>'
						. '<td>' . $value['prix'] . ' €</td>' .
					'</tr>';

				}

				$modal .= '</table>';

			}

			return $modal;
		}

		public function getPrintedModal()
		{
			$transactions = $this->findTransactionsByID();

			$modal .= '

				<legend>Général</legend>

				<p>Date : ' . $transactions['date'] . ' ' . $transactions['heure'] . '</p>
				<p>Caisse : ' . $transactions['magasin'] . '</p>

				<legend>Pré-paiement</legend>

				<p>Avoir : ' . $transactions['avoir'] . ' €</p>
				<p>Avoir utilisé : ' . $transactions['avoir_util'] . ' €</p>
				<p>Echange : ' . $transactions['echange'] . ' €</p>
				<p>Echange utilisé : ' . $transactions['echange_util'] . ' €</p>
				<p>Avoir ou echange converti : ' . $transactions['avoir_echange_converti'] . ' €</p>
				<p>Remise : ' . $transactions['remise'] . ' €</p>
				<p>Echange direct : ' . $transactions['echange_direct'] . ' €</p>
				<p>Bon cadeau : ' . $transactions['bon_cadeau'] . ' €</p>

				<legend>Paiement</legend>

				<p>CB : ' . $transactions['cb'] . ' €</p>
				<p>Chèque : ' . $transactions['cheque'] . ' €</p>
				<p>Espèces : ' . $transactions['especes'] . ' €</p>
				<p>Espèces réel : ' . $transactions['esp_reel'] . ' €</p>

				<legend>Emission</legend>

				<p>Avoir emis : ' . $transactions['avoir_emis'] . ' €</p>
				<p>Espèces emis : ' . $transactions['esp_emis'] . ' €</p>
				<p>Espèces réel emis : ' . $transactions['esp_reel_emis'] . ' €</p>

				<legend>Totaux</legend>

				<p><strong>Total ventes : ' . $transactions['total_ventes'] . ' €</strong></p>
				<p><strong>Total achats : ' . $transactions['total_achats'] . ' €</strong></p>
				<p><strong>Nombre de produits : ' . $transactions['nb_produits'] . '</strong></p>

			';

			$products = $this->getProducts();

			$modal .= '

			<legend>Produits vendus</legend>

			<table class="table table-bordered">';

				foreach ($products as $key => $value) {

					$modal .= '
					<tr>' 
						. '<td>' . $value['titre'] . '</td>'
						. '<td>' . $value['code'] . '</td>'
						. '<td>' . $value['prix'] . ' €</td>' .
					'</tr>';

				}

			$modal .= '</table>';

			return $modal;
		}

		public function getMostExpensiveProducts()
		{
			$query = getDb()->prepare("SELECT * FROM produits_encaisses WHERE magasin = :magasin AND date = :date ORDER BY CAST(prix AS SIGNED) DESC LIMIT 10");
			$query->execute(array(
				'magasin' => $this->magasin,
				'date' => date("d/m/Y")
				));

			return $query->fetchAll();
		}

		public function getAvoirsEntres()
		{
			$query = getDb()->prepare("SELECT * FROM recap_avoirs_entres WHERE no_transaction = :no_transaction AND magasin = :magasin");
			$query->execute(array(
				'no_transaction' => $this->no_transaction,
				'magasin' => $this->magasin
				));

			return $query->fetchAll();
		}

		public function getAchats()
		{
			$query = getDb()->prepare("SELECT * FROM recap_achats WHERE no_transaction = :no_transaction AND magasin = :magasin");
			$query->execute(array(
				'no_transaction' => $this->no_transaction,
				'magasin' => $this->magasin
				));

			return $query->fetchAll();
		}

		public function getEchangesDirects()
		{
			$query = getDb()->prepare("SELECT * FROM recap_echanges_directs_entres WHERE magasin = :magasin AND no_transaction = :no_transaction");
			$query->execute(array(
				'no_transaction' => $this->no_transaction,
				'magasin' => $this->magasin
				));

			return $query->fetchAll();
		}

		public function getAvoirsEmisTransac()
		{
			$query = getDb()->prepare("SELECT * FROM recap_avoirs_rendus WHERE no_transaction = :no_transaction AND magasin = :magasin");
			$query->execute(array(
				'no_transaction' => $this->no_transaction,
				'magasin' => $this->magasin
				));

			return $query->fetchAll();
		}

		public function getAvoirsEmisAchats()
		{
			$query = getDb()->prepare("SELECT * FROM recap_avoirs_achats WHERE no_transac = :no_transac AND date = :date AND heure = :heure");
			$query->execute(array(
				'no_transac' => $this->no_transaction,
				'date' => $this->date,
				'heure' => $this->heure
				));

			return $query->fetchAll();
		}

		public function getTransactionsWithDATE()
		{
			$query = getDb()->prepare("SELECT * FROM transactions WHERE date = ? AND magasin = ? ORDER BY no_transaction ASC");
			$query->execute(array($this->date, $this->magasin));

			return $query->fetchAll();
		}

		public function getTransactionsWithONLYDATE()
		{
			$query = getDb()->prepare("SELECT * FROM transactions WHERE date = ? ORDER BY id DESC");
			$query->execute(array($this->date));

			return $query->fetchAll();
		}

		public function getProducts()
		{
			$query = getDb()->prepare("SELECT * FROM produits_encaisses WHERE no_transaction = ? AND magasin = ?");
			$query->execute(array($this->no_transaction, $this->magasin));

			return $query->fetchAll();
		}

		public function getProductsByDATE()
		{
			$query = getDb()->prepare("SELECT * FROM produits_encaisses WHERE date = ? ORDER BY id_table DESC");
			$query->execute(array($this->date));

			return $query->fetchAll();
		}

		public function getProductsByDATEMAGASIN()
		{
			$query = getDb()->prepare("SELECT * FROM produits_encaisses WHERE date = ? AND magasin = ?");
			$query->execute(array($this->date, $this->magasin));

			return $query->fetchAll();
		}

		public function findTransactionsByID()
		{
			$query = getDb()->prepare("SELECT * FROM transactions WHERE no_transaction = ? AND magasin = ?");
			$query->execute(array($this->no_transaction, $this->magasin));

			return $query->fetch();
		}

		public function getGlobalWithDATE()
		{
			$query = getDb()->prepare("SELECT * FROM recap_global WHERE date = ? AND magasin = ?");
			$query->execute(array($this->date, $this->magasin));

			return $query->fetch();
		}

		public function getGlobalsWithDATE()
		{
			$query = getDb()->prepare("SELECT * FROM recap_global WHERE date = ? AND chiffre_journee > 0 ORDER BY CAST(chiffre_journee AS SIGNED) DESC");
			$query->execute(array($this->date));

			return $query->fetchAll();
		}

        public function getOrderAverageByDateAndStore()
        {
            $query = getDb()->prepare("SELECT total_ventes FROM transactions WHERE date = ? AND magasin = ?");
            $query->execute(array($this->date, $this->magasin));
            $transactionCount = $query->rowCount();

            $query = getDb()->prepare("SELECT SUM(total_ventes) FROM transactions WHERE date = ? AND magasin = ?");
            $query->execute(array($this->date, $this->magasin));
            $total_ventes = $query->fetch();

            $total_ventes_value = $total_ventes[0];

            $orderAverage = $total_ventes_value / $transactionCount;

            return $orderAverage;
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
		 * Getter for no_transaction
		 *
		 * @return mixed
		 */
		public function getNoTransaction()
		{
		    return $this->no_transaction;
		}
		
		/**
		 * Setter for no_transaction
		 *
		 * @param mixed $noTransaction Value to set
		
		 * @return self
		 */
		public function setNoTransaction($noTransaction)
		{
		    $this->no_transaction = $noTransaction;
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
		
	}

?>