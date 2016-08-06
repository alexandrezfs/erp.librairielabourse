<?php

	require_once(__DIR__ . "/../class/Produit.class.php");

	if(isset($_POST)){

		$Produit = new Produit();

		$Produit->setCode($_POST['code']);
		$Produit->setTitre($_POST['titre']);
		$Produit->setAuteur($_POST['auteur']);
		$Produit->setEditeur($_POST['editeur']);
		$Produit->setEdition($_POST['edition']);
		$Produit->setType($_POST['type']);

		echo $Produit->updateInfo();

	}

?>