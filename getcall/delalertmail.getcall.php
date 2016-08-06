<?php

	require_once(__DIR__ . "/../class/EmailAlert.class.php");

	if(isset($_GET)){

		$EmailAlert = new EmailAlert();
		$EmailAlert->setEmail($_GET['email']);
		$EmailAlert->removeEmail();
		header("location:/alert.admin.php?event=deleted");

	}

?>