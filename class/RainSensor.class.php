<?php

require_once(__DIR__ . "/../autoload/db.autoload.php");
require_once(__DIR__ . "/../class/IosPushNotificationCenter.class.php");

class RainSensor {

    private $iosNotificationCenter;

    public function sensRainingNotification() {

        $this->iosNotificationCenter = new IosPushNotificationCenter();
        $this->iosNotificationCenter->broadcastNotification("Pluie détectée au magasin ! Prenez les mesures nécéssaires.");
    }
}
