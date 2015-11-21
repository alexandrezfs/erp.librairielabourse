<?php  

	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Acheteur.class.php");

	if(isset($_POST)){
		$Acheteur = new Acheteur();
		$Acheteur->setNom($_POST['nom']);
		$Acheteur->setDescription($_POST['description']);

		echo $Acheteur->printLots();
	}

?>