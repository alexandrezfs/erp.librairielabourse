<?php

require_once(__DIR__ . "/../class/RainSensor.class.php");

if(isset($_POST)){

    $RainSenor = new RainSensor();
    $RainSenor->sensRainingNotification();

}
