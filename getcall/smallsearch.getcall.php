<?php

	require_once(__DIR__ . "/../class/Searcher.class.php");

	header('Content-Type: text/html; charset=utf-8');

	if(isset($_GET)){

		$Searcher = new Searcher($_GET['keyword']);

		$Searcher->buildSmallResult();
		echo $Searcher->getResult();

	}

?>