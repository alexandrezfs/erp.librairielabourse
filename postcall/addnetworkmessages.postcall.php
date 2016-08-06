<?php

  	require_once(__DIR__ . "/../autoload/session.autoload.php");
	require_once(__DIR__ . "/../class/Network.class.php");
	require_once(__DIR__ . "/../class/Time.class.php");

	if(isset($_POST)){

		$Network = new Network();

		$Network->setMessage($_POST['message']);
		$Network->setUsername($_SESSION['username']);
		$Network->setDatesent(Time::getFrenchDate());

		$Network->addMsg();

	}

?>