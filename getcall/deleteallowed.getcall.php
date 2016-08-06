<?php

  require_once(__DIR__ . "/../class/Access.class.php");

  if(isset($_GET)){
	  $Access = new Access();
	  $Access->setUsername($_GET['username']);
	  $Access->setModule($_GET['module']);
	  $Access->removeAllowed();
	  header("location:/users.admin.php?event=removed-allowed");
	}

?>