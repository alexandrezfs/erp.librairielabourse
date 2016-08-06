<?php

require_once(__DIR__ . "/autoload/session.autoload.php");
require_once(__DIR__ . "/autoload/db.autoload.php");
require_once(__DIR__ . "/class/IosPushNotificationCenter.php");

$iosPushNotificationCenter = new IosPushNotificationCenter();

if(isset($_GET['token'])) {

    $token = $_GET['token'];
    $iosPushNotificationCenter->registerToken($token);

    echo "{register: 'success'}";
}