<?php

	require_once(__DIR__ . "/../class/Concurrence.class.php");
	require_once(__DIR__ . "/../class/File.class.php");

	if(isset($_POST)){

		$Concurrence = new Concurrence();
		$File = new File();

		if(is_uploaded_file($_FILES['file']['tmp_name']))
		{
			$File->setFile($_FILES['file']);

			$replyFile = $File->uploadImg();

			if (!$replyFile) {
				header("location:/error.php");
			}
			else{
				$Concurrence->setAfterPattern($_POST['afterPattern']);
				$Concurrence->setBeforePattern($_POST['beforePattern']);
				$Concurrence->setTitreSite($_POST['titreSite']);
				$Concurrence->setFileLink($File->getFileLink());
				$Concurrence->addPattern();
				header("location:/concur.admin.php?event=added");
			}
		}
		else{
			header("location:/concur.admin.php?event=error");
		}

	}

?>