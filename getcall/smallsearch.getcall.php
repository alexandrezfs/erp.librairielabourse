<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Searcher.class.php");

	header('Content-Type: text/html; charset=utf-8');

	if(isset($_GET)){

		$Searcher = new Searcher($_GET['keyword']);

		$Searcher->buildSmallResult();
		echo $Searcher->getResult();

	}

?>