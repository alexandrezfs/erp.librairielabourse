<?php

require_once(__DIR__ . "/../autoload/db.autoload.php");
require_once(__DIR__ . "/../class/IosPushNotificationCenter.php");

class RainSensor {

    private $iosNotificationCenter;

    function RainSensor() {

        $this->iosNotificationCenter = new IosPushNotificationCenter();
    }

    public function sendRainingNotification() {

        $this->iosNotificationCenter->broadcastNotification("Pluie détectée au magasin ! Prenez les mesures nécéssaires.");
    }

    public function sendStoppedRainingNotification() {

        $this->iosNotificationCenter->broadcastNotification("La pluie a cessé au magasin.");
    }
}
