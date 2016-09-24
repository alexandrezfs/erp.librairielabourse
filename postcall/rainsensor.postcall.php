<?php

require_once(__DIR__ . "/../class/RainSensor.class.php");

if(isset($_POST)){

    $RainSenor = new RainSensor();

    if(isset($_POST['stoppedRaining'])) {
        $RainSenor->sendStoppedRainingNotification();
    }
    else {
        $RainSenor->sendRainingNotification();
    }
}
