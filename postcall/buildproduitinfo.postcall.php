<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Produit.class.php");

	if(isset($_POST)){

		$Produit = new Produit();

		$Produit->setCode($_POST['code']);

		$Produit->initInfoWithCODE();

		echo $Produit->getPrintedModal();

	}

?>