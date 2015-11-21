<?php

	class Time
	{
		function Time()
		{
		
		}
	
		public static function getFrenchDate()
		{
			$Jour = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi","Samedi");
			$Mois = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
			
			$datefr = $Jour[date("w")]." ".date("d")." ".$Mois[date("n")-1]." ".date("Y") . ' à ' . date("H:i");
			
			return $datefr;
		}
	}

?>