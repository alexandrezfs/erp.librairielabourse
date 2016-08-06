<?php

	require_once(__DIR__ . "/autoload/session.autoload.php");
	require_once(__DIR__ . "/class/User.class.php");

	$User = new User();

	$User->logout();

?>