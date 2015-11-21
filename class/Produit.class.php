<?php

  	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/db.autoload.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/produitType.autoload.php");

	class Produit{

		private $id;
		private $titre;
		private $auteur;
		private $editeur;
		private $edition = null;
		private $code;
		private $type;

		function Produit()
		{

		}

		public function updateInfo()
		{

			$query = getDb()->prepare("SELECT code FROM produits WHERE code = ?");
			$query->execute(array($this->code));

			if ($query->rowCount() > 0) {
				if($this->edition == null){
					$query = getDb()->prepare("UPDATE produits SET titre = :titre, auteur = :auteur, editeur = :editeur, type = :type WHERE code = :code");
					$query->execute(array(
						"titre" => $this->titre,
						"auteur" => $this->auteur,
						"editeur" => $this->editeur,
						"type" => $this->type,
						"code" => $this->code
					));
				}
				else{
					$query = getDb()->prepare("UPDATE produits SET titre = :titre, auteur = :auteur, editeur = :editeur, edition = :edition, type = :type WHERE code = :code");
					$query->execute(array(
						"titre" => $this->titre,
						"auteur" => $this->auteur,
						"editeur" => $this->editeur,
						"edition" => $this->edition,
						"type" => $this->type,
						"code" => $this->code
					));
				}
			}
			else{
				if($this->edition == null){
					$query = getDb()->prepare("INSERT INTO produits(code, type, titre, auteur, editeur) VALUES(:code, :type, :titre, :auteur, :editeur)");
					$query->execute(array(
						"titre" => $this->titre,
						"auteur" => $this->auteur,
						"editeur" => $this->editeur,
						"type" => $this->type,
						"code" => $this->code
					));
				}
				else{
					$query = getDb()->prepare("INSERT INTO produits(code, type, titre, auteur, editeur, edition) VALUES(:code, :type, :titre, :auteur, :editeur, :edition)");
					$query->execute(array(
						"titre" => $this->titre,
						"auteur" => $this->auteur,
						"editeur" => $this->editeur,
						"edition" => $this->edition,
						"type" => $this->type,
						"code" => $this->code
					));
				}

			}

		}

		public function getPrintedModal()
		{
			$modal .= '

				<h4>EAN / ISBN ' . $this->code . '</h4>

				<input type="hidden" id="code-input" value="' . $this->code . '">

				<p>Edition</p>';

				$modal .= '
				<select id="type-input">';

					$types = getProduitsTypes();
					
					foreach ($types as $key => $value){
						if($value == $this->type){
							$modal .= '<option value="' . $value . '" SELECTED>' . $value . '</option>';
						}
						else{
							$modal .= '<option value="' . $value . '">' . $value . '</option>';
						}
					}

				$modal .= '
				</select>

				<p>Titre</p>
				<input type="text" id="titre-input" value="' . $this->titre . '" class="full-middle-width">

				<p>Auteur</p>
				<input type="text" id="auteur-input" value="' . $this->auteur . '" class="full-middle-width">

				<p>Editeur</p>
				<input type="text" id="editeur-input" value="' . $this->editeur . '" class="full-middle-width">';

				$editions = array("NORMALE", "SPECIALE");

				$modal .= '
				<p>Edition</p>
				<select id="edition-input">';
				
					foreach ($editions as $key => $value){
						if($value == $this->edition){
							$modal .= '<option value="' . $value . '" SELECTED>' . $value . '</option>';
						}
						else{
							$modal .= '<option value="' . $value . '">' . $value . '</option>';
						}
					}

				$modal .= '
				</select>

			';

			return $modal;

		}

		public function initInfoWithCODE()
		{
			$query = getDb()->prepare("SELECT * FROM produits WHERE code = ?");
			$query->execute(array($this->code));

			$row = $query->fetch();

			$this->titre = $row['titre'];
			$this->auteur = $row['auteur'];
			$this->editeur = $row['editeur'];
			$this->edition = $row['edition'];
			$this->id = $row['id'];
			$this->type = $row['type'];
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
		 * Getter for edition
		 *
		 * @return mixed
		 */
		public function getEdition()
		{
		    return $this->edition;
		}
		
		/**
		 * Setter for edition
		 *
		 * @param mixed $edition Value to set
		
		 * @return self
		 */
		public function setEdition($edition)
		{
		    $this->edition = $edition;
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
		 * Getter for id
		 *
		 * @return mixed
		 */
		public function getId()
		{
		    return $this->id;
		}
		
		/**
		 * Setter for id
		 *
		 * @param mixed $id Value to set
		
		 * @return self
		 */
		public function setId($id)
		{
		    $this->id = $id;
		    return $this;
		}
		

	}

?>