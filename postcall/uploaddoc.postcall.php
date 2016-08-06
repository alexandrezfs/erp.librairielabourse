<?php

  	require_once(__DIR__ . "/../autoload/session.autoload.php");
	require_once(__DIR__ . "/../class/Document.class.php");
	require_once(__DIR__ . "/../class/File.class.php");
	require_once(__DIR__ . "/../class/Time.class.php");

	if(isset($_POST)){

		$Document = new Document();
		$File = new File();

		if(is_uploaded_file($_FILES['file']['tmp_name']))
		{
			$File->setFile($_FILES['file']);

			$replyFile = $File->uploadFile();

			if (!$replyFile) {
				header("location:/error.php");
			}
			else{
				$Document->setDate(Time::getFrenchDate());
				$Document->setFileLink($File->getFileLink());
				$Document->setAuthor($_SESSION['username']);
				$Document->addDoc();
				header("location:/documents.php?event=added");
			}
		}
		else{
			header("location:/documents.php?event=error");
		}

	}

?>