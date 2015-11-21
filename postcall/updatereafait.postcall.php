<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Reassort.class.php");

	if(isset($_POST)){

		$Reassort = new Reassort();

		$Reassort->setIdProd($_POST['id']);
		$Reassort->setRestant($_POST['restant']);
		$Reassort->setPris($_POST['pris']);

		echo $Reassort->updateReaStat();

	}

?>