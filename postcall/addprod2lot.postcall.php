<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Acheteur.class.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/ProduitAchete.class.php");

	if(isset($_POST)){

		$Acheteur = new Acheteur();

		$ProduitAchete = new ProduitAchete();
		$ProduitAchete->setCode($_POST['code']);
		$ProduitAchete->setType($_POST['type']);
		$ProduitAchete->setTitre($_POST['titre']);
		$ProduitAchete->setAuteur($_POST['auteur']);
		$ProduitAchete->setEditeur($_POST['editeur']);
		$ProduitAchete->setType($_POST['type']);
		$ProduitAchete->setPrixesp($_POST['prixesp']);
		$ProduitAchete->setPrixech($_POST['prixech']);
		$ProduitAchete->setPrixvente($_POST['vente']);
		$ProduitAchete->setPurchaser($_SESSION['username']);
		$ProduitAchete->setLotID($_POST['lotID']);

		$Acheteur->setProduitAchete($ProduitAchete);

		$Acheteur->addProd();

	}

?>