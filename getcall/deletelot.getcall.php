<?php

	require_once(__DIR__ . "/../class/Acheteur.class.php");

	if(isset($_GET)){

		$Acheteur = new Acheteur();

		$Acheteur->setLotID($_GET['lotID']);

		$Acheteur->deleteLot();

		header("location:/acheteur.php");

	}

?>