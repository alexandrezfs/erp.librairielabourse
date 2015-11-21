<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Tache.class.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Time.class.php");

	if(isset($_POST)){

		$Tache = new Tache();
		$Tache->printTachesView();

	}

?>