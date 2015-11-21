<?php

  	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/db.autoload.php");

	class Module{

		function Module()
		{
			
		}

		public static function getModules()
		{
			$query = getDb()->prepare("SELECT * FROM modules ORDER BY module_name ASC");
			$query->execute();
			return $query->fetchAll();
		}

	}

?>