<?php

  	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Sound.class.php");

	if(isset($_POST)){

		$Sound = new Sound();

		$Sound->setUsername($_POST['username']);

		$Sound->toggle();

		header("location:/users.admin.php?event=param-changed");

	}

?>