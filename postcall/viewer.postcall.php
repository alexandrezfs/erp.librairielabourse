<?php

	require_once(__DIR__ . "/../class/Viewer.class.php");

	if(isset($_POST)){

		$Viewer = new Viewer();
		$Viewer->getPrintedView();

	}

?>