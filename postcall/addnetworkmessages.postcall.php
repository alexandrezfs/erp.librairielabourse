<?php

  	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Network.class.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Time.class.php");

	if(isset($_POST)){

		$Network = new Network();

		$Network->setMessage($_POST['message']);
		$Network->setUsername($_SESSION['username']);
		$Network->setDatesent(Time::getFrenchDate());

		$Network->addMsg();

	}

?>