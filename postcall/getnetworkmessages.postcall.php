<?php

	require_once(__DIR__ . "/../class/Network.class.php");

	if(isset($_POST)){

		$Network = new Network();

		$msg = $Network->getMsg();

		foreach ($msg as $key => $value) {
			
			echo '
				<p>
					[' . $value['datesent'] . ']<br><strong>' . htmlspecialchars($value['username']) . '</strong><br>' . htmlspecialchars($value['msg']) . '
				</p>
			';

		}

	}

?>