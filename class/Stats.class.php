<?php 

  	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/db.autoload.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/TheHour.class.php");

	class Stats {

		function Stats() {

		}

		public function SearchSalesPerHour($day_start, $month_start, $year_start, $day_end, $month_end, $year_end, $magasin, $averageByDay) {

			$dayCount = 0;

			$TheHour = array();
			$TheHour["nbProduit"] = 0;
			$TheHour["nbTransac"] = 0;
			$TheHour["totalVentes"] = 0;	
			$TheHour["hour"] = "08";	
			$TheHour["magasin"] = $magasin;		

			$openingHours = array(
				"08" => $TheHour,
				"09" => $TheHour, 
				"10" => $TheHour, 
				"11" => $TheHour, 
				"12" => $TheHour, 
				"13" => $TheHour, 
				"14" => $TheHour, 
				"15" => $TheHour, 
				"16" => $TheHour, 
				"17" => $TheHour, 
				"18" => $TheHour, 
				"19" => $TheHour, 
				"20" => $TheHour, 
				"21" => $TheHour
			);

			$average = 0;

			$startTime = strtotime($year_start . '-' . $month_start . '-' . $day_start);
			$endTime = strtotime($year_end . '-' . $month_end . '-' . $day_end);

			for ($i = $startTime; $i <= $endTime; $i = $i + 86400) {

				$dayCount++;
			  	$thisDate = date('d/m/Y', $i);

				foreach ($openingHours as $key => $content) {
					
					$query = getDb()->prepare('SELECT * FROM transactions WHERE heure LIKE "' . $key . '%" AND date = "' . $thisDate . '" AND magasin = "' . $magasin . '"');
					$query->execute(array("%" . $key . "%", $thisDate, $magasin));

					while ($row = $query->fetch()) {
						$openingHours[$key]["nbProduit"] = $openingHours[$key]["nbProduit"] += $row['nb_produits'];
						$openingHours[$key]["nbTransac"] = $openingHours[$key]["nbTransac"] += $query->rowCount();
						$openingHours[$key]["totalVentes"] = $openingHours[$key]["totalVentes"] += $row['total_ventes'];
					}

					$openingHours[$key]["hour"] = $key;

				}
			}

			if ($averageByDay == "true") {
				//dividing all by daycount to get the average by day
				foreach ($openingHours as $key => $content) {
					
					$openingHours[$key]["nbProduit"] = $openingHours[$key]["nbProduit"] / $dayCount;
					$openingHours[$key]["nbTransac"] = $openingHours[$key]["nbTransac"] / $dayCount;
					$openingHours[$key]["totalVentes"] = $openingHours[$key]["totalVentes"] / $dayCount;

				}
			}

			//putting all in a normal array

			$finalStatsResult = array();

			foreach ($openingHours as $key => $opHour) {

				$finalStatsResult[] = $opHour;
			}

			$finalStatsResult = json_encode($finalStatsResult);

			echo $finalStatsResult;
		}
	}

?>