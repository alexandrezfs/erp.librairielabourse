<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Viewer.class.php");

	if(isset($_POST)){

		$Viewer = new Viewer();
		$Viewer->getPrintedView();

	}

?>