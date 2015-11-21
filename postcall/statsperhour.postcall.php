<?php  

	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Stats.class.php");

	if(isset($_POST)){
		$Stats = new Stats();

		echo $Stats->SearchSalesPerHour(
			$_POST['day_start'],
			$_POST['month_start'],
			$_POST['year_start'],
			$_POST['day_end'],
			$_POST['month_end'],
			$_POST['year_end'],
			$_POST['magasin'],
			$_POST['averageByDay']);
	}

?>