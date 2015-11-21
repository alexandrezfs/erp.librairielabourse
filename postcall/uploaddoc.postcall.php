<?php

  	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Document.class.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/File.class.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Time.class.php");

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