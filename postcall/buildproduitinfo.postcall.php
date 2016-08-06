<?php

	require_once(__DIR__ . "/../class/Produit.class.php");

	if(isset($_POST)){

		$Produit = new Produit();

		$Produit->setCode($_POST['code']);

		$Produit->initInfoWithCODE();

		echo $Produit->getPrintedModal();

	}

?>