<?php

	require_once(__DIR__ . "/../class/User.class.php");

	if(isset($_GET)){

		$User = new User();

		$User->setId($_GET['id']);

		$User->delUser();

	}

?>