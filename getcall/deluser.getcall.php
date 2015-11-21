<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/User.class.php");

	if(isset($_GET)){

		$User = new User();

		$User->setId($_GET['id']);

		$User->delUser();

	}

?>