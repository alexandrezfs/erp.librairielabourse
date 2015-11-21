<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/EmailAlert.class.php");

	if(isset($_GET)){

		$EmailAlert = new EmailAlert();
		$EmailAlert->setEmail($_GET['email']);
		$EmailAlert->removeEmail();
		header("location:/alert.admin.php?event=deleted");

	}

?>