<?php  

	require_once(__DIR__ . "/../class/Acheteur.class.php");

	if(isset($_POST)){
		$Acheteur = new Acheteur();
		$Acheteur->setNom($_POST['nom']);
		$Acheteur->setDescription($_POST['description']);

		$Acheteur->addLot();
	}

?>