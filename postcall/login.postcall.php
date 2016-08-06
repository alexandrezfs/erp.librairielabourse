<?php

	require_once(__DIR__ . "/../class/User.class.php");

	if(isset($_POST)){

		$User = new User();

		$User->setPassword($_POST['password']);
		$User->setUsername($_POST['username']);

		$User->logIn();

	}

?>