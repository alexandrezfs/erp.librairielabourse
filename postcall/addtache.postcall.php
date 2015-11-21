<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Tache.class.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Time.class.php");

	if(isset($_POST)){

		$Tache = new Tache();
		$Tache->setDescription($_POST['description']);
		$Tache->setAuthor($_SESSION['username']);
		$Tache->setDate(Time::getFrenchDate());
		$Tache->setFait('non');

		$Tache->addTache();

	}

?>