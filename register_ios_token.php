<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/db.autoload.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/IosPushNotificationCenter.php");

$iosPushNotificationCenter = new IosPushNotificationCenter();

if(isset($_GET['token'])) {

    $token = $_GET['token'];
    $iosPushNotificationCenter->registerToken($token);

    echo "{register: 'success'}";
}