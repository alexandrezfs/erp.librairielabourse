<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/User.class.php");

	$User = new User();

	$User->logout();

?>