<?php

	require_once(__DIR__ . "/../class/Concurrence.class.php");

	if(isset($_GET)){

		$Concurrence = new Concurrence();
		$Concurrence->setPatternId($_GET['id']);
		$Concurrence->removePattern();

		header("location:/concur.admin.php?event=deleted");

	}

?>