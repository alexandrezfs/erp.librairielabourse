<?php

	require_once(__DIR__ . "/../class/Access.class.php");

	if(isset($_POST)){

		$Access = new Access();
		$Access->setUsername($_POST['username']);
		$Access->setModule($_POST['module']);
		$Access->addAllowed();
		header("location:/users.admin.php?event=added-allowed");

	}

?>