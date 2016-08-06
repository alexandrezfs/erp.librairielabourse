<?php

  	require_once(__DIR__ . "/../autoload/session.autoload.php");
	require_once(__DIR__ . "/../autoload/db.autoload.php");

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