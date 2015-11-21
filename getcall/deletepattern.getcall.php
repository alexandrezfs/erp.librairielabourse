<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Concurrence.class.php");

	if(isset($_GET)){

		$Concurrence = new Concurrence();
		$Concurrence->setPatternId($_GET['id']);
		$Concurrence->removePattern();

		header("location:/concur.admin.php?event=deleted");

	}

?>