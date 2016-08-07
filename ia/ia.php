<?php
    require_once(__DIR__ . "/../class/Alert.class.php");
    $Alert = new Alert();
    echo $Alert->GO();
    $Alert->alertIosDevices();