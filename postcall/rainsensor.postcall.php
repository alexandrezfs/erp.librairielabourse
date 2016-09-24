<?php

require_once(__DIR__ . "/../class/RainSensor.class.php");

if(isset($_POST)){

    $RainSenor = new RainSensor();
    $RainSenor->sendRainingNotification();

    if(isset($_POST['stoppedRaining'])) {
        $RainSenor->sendStoppedRainingNotification();
    }
}
