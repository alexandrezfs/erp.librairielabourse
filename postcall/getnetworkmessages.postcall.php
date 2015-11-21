<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Network.class.php");

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