<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Alert.class.php");
	$Alert = new Alert();
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 	
		echo $Alert->GO();
        $Alert->alertIosDevices();
	?>
</body>
</html>