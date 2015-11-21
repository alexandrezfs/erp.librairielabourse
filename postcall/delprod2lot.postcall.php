<?php

  	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Acheteur.class.php");

  	if (isset($_POST)) {
  		Acheteur::deleteProd($_POST['prodID']);
  	}

?>