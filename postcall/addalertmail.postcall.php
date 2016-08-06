<?php

	require_once(__DIR__ . "/../class/EmailAlert.class.php");

	if(isset($_POST)){

		$EmailAlert = new EmailAlert();
		$EmailAlert->setEmail($_POST['email']);
		$EmailAlert->addEmail();
		header("location:/alert.admin.php?event=added");

	}

?>