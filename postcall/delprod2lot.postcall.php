<?php

  	require_once(__DIR__ . "/../class/Acheteur.class.php");

  	if (isset($_POST)) {
  		Acheteur::deleteProd($_POST['prodID']);
  	}

?>