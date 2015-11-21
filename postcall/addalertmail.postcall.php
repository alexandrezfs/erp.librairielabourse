<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/EmailAlert.class.php");

	if(isset($_POST)){

		$EmailAlert = new EmailAlert();
		$EmailAlert->setEmail($_POST['email']);
		$EmailAlert->addEmail();
		header("location:/alert.admin.php?event=added");

	}

?>