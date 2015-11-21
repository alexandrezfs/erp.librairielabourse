<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Acheteur.class.php");

	if(isset($_GET)){

		$Acheteur = new Acheteur();

		$Acheteur->setLotID($_GET['lotID']);
		$Acheteur->setVentelot($_GET['vente']);
		$Acheteur->setAchatesplot($_GET['achatesp']);
		$Acheteur->setAchatechlot($_GET['achatech']);

		$Acheteur->validLot();

	}

?>