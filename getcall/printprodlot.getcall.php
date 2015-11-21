<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Acheteur.class.php");

	header('Content-Type: text/html; charset=utf-8');

	if(isset($_GET)){

		$Acheteur = new Acheteur();

		$Acheteur->setLotID($_GET['lotID']);

		echo $Acheteur->printProdLots();

	}

?>