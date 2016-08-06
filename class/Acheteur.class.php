<?php

  	require_once(__DIR__ . "/../autoload/session.autoload.php");
	require_once(__DIR__ . "/../autoload/db.autoload.php");
	require_once(__DIR__ . "/../class/Produit.class.php");

	class Acheteur{

		private $lotID;
		private $description;
		private $nom;
		private $produitAchete;
		private $ventelot;
		private $achatesplot;
		private $achatechlot;

		function __construct(){

		}

		public function addProd()
		{
			
			$query = getDb()->prepare("INSERT INTO produits_achetes(code, type, titre, auteur, editeur, date, time, achesp, achech, vente, purchaser, validated, lotID)
				VALUES (:code, :type, :titre, :auteur, :editeur, :date, :time, :achesp, :achech, :vente, :purchaser, :validated, :lotID)");
			$query->execute(array(
				'code' => $this->produitAchete->getCode(),
				'type' => $this->produitAchete->getType(),
				'titre' => $this->produitAchete->getTitre(),
				'auteur' => $this->produitAchete->getAuteur(),
				'editeur' => $this->produitAchete->getEditeur(),
				'date' => date("d/m/Y"),
				'time' => date("H:i"),
				'achesp' => $this->produitAchete->getPrixesp(),
				'achech' => $this->produitAchete->getPrixech(),
				'vente' => $this->produitAchete->getPrixvente(),
				'purchaser' => $this->produitAchete->getPurchaser(),
				'validated' => '0',
				'lotID' => $this->produitAchete->getLotID()
				));

		}

		public static function deleteProd($id)
		{
			$query = getDb()->prepare("DELETE FROM produits_achetes WHERE id = ?");
			$query->execute(array($id));
		}

		public function printProdLots()
		{

			$returnStr = '';

			$esp = 0;
			$ech = 0;
			$vente = 0;

            $query = getDb()->prepare("SELECT * FROM produits_achetes WHERE lotID = ?");
            $query->execute(array($this->lotID));
            $query = $query->fetchAll();

            if (count($query) > 0) {

				$returnStr = '

		          <table class="table table-bordered table-striped">
		            <thead>
		              <tr>
		                <td>Vente</td>
		                <td>Achat ESP</td>
		                <td>Achat ECH</td>
		                <td>Code</td>
		                <td>Titre</td>
		                <td>Auteur</td>
		                <td>Editeur</td>
		                <td>Acheteur</td>
		                <td>#</td>
		              </tr>
		            </thead>
		            <tbody>';

		            foreach ($query as $key => $value) {

		            	$returnStr .= '<tr>';
		            		$returnStr .= '<td>' . $value['vente'] . '</td>';
		            		$returnStr .= '<td>' . $value['achesp'] . '</td>';
		            		$returnStr .= '<td>' . $value['achech'] . '</td>';
		            		$returnStr .= '<td>' . $value['code'] . '</td>';
		            		$returnStr .= '<td>' . $value['titre'] . '</td>';
		            		$returnStr .= '<td>' . $value['auteur'] . '</td>';
		            		$returnStr .= '<td>' . $value['editeur'] . '</td>';
		            		$returnStr .= '<td>' . $value['purchaser'] . '</td>';
		            		$returnStr .= '<td><button onclick="deleteProd(' . $value['id'] . ')">Supprimer</button></td>';
		            	$returnStr .= '</tr>';

						$esp += $value['achesp'];
						$ech += $value['achech'];
						$vente += $value['vente'];
		            }

		        $returnStr .= '

		            </tbody>
		          </table>

				';

	            $returnStr .= 'Total VENTE : <input type="text" value="' . $vente . '" class="input-mini" id="venteFinal" disabled> ';
	            $returnStr .= 'Total ESP : <input type="text" value="' . $esp . '" class="input-mini" id="achatespFinal"> ';
	            $returnStr .= 'Total ECH : <input type="text" value="' . $ech . '" class="input-mini" id="achatechFinal">';

	        }

			return $returnStr;
		}

		public function printLots()
		{
			$lots = $this->getLots();

			$returnStr = '
			<table class="table table-bordered">
              <thead>
                <tr>
                  <td>Date</td>
                  <td>Nom</td>
                  <td>Description</td>
                  <td>#</td>
                </tr>
              </thead>
              <tbody>';

			foreach ($lots as $key => $value) {

		    	$bgcolor = 'yellow';

		    	if ($value['fait'] == '1') {
		    		$bgcolor = '#CCCCCC';
		    	}

				$returnStr .= '
				<tr style="background-color:' . $bgcolor . ';">
					<td>' . $value['date'] . '<br>' . $value['time'] . '</td>
					<td>' . $value['nom'] . '</td>
					<td>' . $value['description'] . '</td>
					<td><a href="acheteur.php?lotid=' . $value['id'] . '&nom=' . $value['nom'] . '"><button>Ouvrir</button></a></td>
				</tr>';
			}

			$returnStr .= '</tbody>
                    </table>';

            return $returnStr;
		}

		public function getLots()
		{
			$query = getDb()->prepare("SELECT * FROM lots ORDER BY id DESC");
			$query->execute();

			return $query->fetchAll();
		}

		public function markAsFait()
		{
			$query = getDb()->prepare("UPDATE lots SET fait = ? WHERE id = ?");
			$query->execute(array('1', $this->lotID));
		}

		public function addLot()
		{
			$query = getDb()->prepare("INSERT INTO lots(nom, description, date, time, fait) VALUES(:nom, :description, :date, :time, :fait)");
			$query->execute(array(
				'nom' => $this->nom,
				'description' => $this->description,
				'date' => date("d/m/Y"),
				'time' => date("H:i"),
				'fait' => '0'
				));
		}

		public function validLot()
		{
			$query = getDb()->prepare("UPDATE lots SET fait = 1, achesp = ?, achech = ?, vente = ?, purchaser = ? WHERE id = ?");
			$query->execute(array($this->achatesplot, $this->achatechlot, $this->ventelot, $_SESSION['username'], $this->lotID));

			$query = getDb()->prepare("UPDATE produits_achetes SET validated = 1 WHERE lotID = ?");
			$query->execute(array($this->lotID));

			$query = getDb()->prepare("SELECT * FROM produits_achetes WHERE lotID = ?");
			$query->execute(array($this->lotID));

			while ($row = $query->fetch()) {

				$Produit = new Produit();

				$Produit->setTitre($row['titre']);
				$Produit->setAuteur($row['auteur']);
				$Produit->setEditeur($row['editeur']);
				$Produit->setCode($row['code']);
				$Produit->setType($row['type']);				
				
				$Produit->updateInfo();

			}
		}

		public function deleteLot()
		{
			$query = getDb()->prepare("DELETE FROM lots WHERE id = ?");
			$query->execute(array($this->lotID));

			$query = getDb()->prepare("DELETE FROM produits_achetes WHERE lotID = ?");
			$query->execute(array($this->lotID));
		}

		/**
		 * Getter for achatechlot
		 *
		 * @return mixed
		 */
		public function getAchatechlot()
		{
		    return $this->achatechlot;
		}
		
		/**
		 * Setter for achatechlot
		 *
		 * @param mixed $achatechlot Value to set
		
		 * @return self
		 */
		public function setAchatechlot($achatechlot)
		{
		    $this->achatechlot = $achatechlot;
		    return $this;
		}
		

		/**
		 * Getter for ventelot
		 *
		 * @return mixed
		 */
		public function getVentelot()
		{
		    return $this->ventelot;
		}
		
		/**
		 * Setter for ventelot
		 *
		 * @param mixed $ventelot Value to set
		
		 * @return self
		 */
		public function setVentelot($ventelot)
		{
		    $this->ventelot = $ventelot;
		    return $this;
		}
		

		/**
		 * Getter for achatesplot
		 *
		 * @return mixed
		 */
		public function getAchatesplot()
		{
		    return $this->achatesplot;
		}
		
		/**
		 * Setter for achatesplot
		 *
		 * @param mixed $achatesplot Value to set
		
		 * @return self
		 */
		public function setAchatesplot($achatesplot)
		{
		    $this->achatesplot = $achatesplot;
		    return $this;
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
		 * Getter for description
		 *
		 * @return mixed
		 */
		public function getDescription()
		{
		    return $this->description;
		}
		
		/**
		 * Setter for description
		 *
		 * @param mixed $description Value to set
		
		 * @return self
		 */
		public function setDescription($description)
		{
		    $this->description = $description;
		    return $this;
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
	
	    /**
	     * Gets the value of produitAchete.
	     *
	     * @return mixed
	     */
	    public function getProduitAchete()
	    {
	        return $this->produitAchete;
	    }

	    /**
	     * Sets the value of produitAchete.
	     *
	     * @param mixed $produitAchete the produitAchete
	     *
	     * @return self
	     */
	    public function setProduitAchete($produitAchete)
	    {
	        $this->produitAchete = $produitAchete;

	        return $this;
	    }
}

?>