<?php

require_once(__DIR__ . "/../autoload/db.autoload.php");
require_once(__DIR__ . "/../class/IosPushNotificationCenter.php");

class RainSensor {

    private $iosNotificationCenter;

    public function sendRainingNotification() {

        new IosPushNotificationCenter();
        $this->iosNotificationCenter->broadcastNotification("Pluie détectée au magasin ! Prenez les mesures nécéssaires.");
    }
}
