<?php

/**
 * Created by PhpStorm.
 * User: alexandrenguyen
 * Date: 29/11/15
 * Time: 17:01
 */
class IosPushNotificationCenter
{

    public function registerToken($token)
    {

        $query = getDb()->prepare("SELECT token_value FROM ios_devices_tokens WHERE token_value = ?");
        $query->execute(array($token));

        if ($query->rowCount() == 0) {
            $query = getDb()->prepare("INSERT INTO ios_devices_tokens (token_value) VALUES (?)");
            $query->execute(array($token));
        }
    }

    public function getAllTokens()
    {
        $query = getDb()->prepare("SELECT token_value FROM ios_devices_tokens");
        $query->execute();

        return $query->fetchAll();
    }

    public function broadcastNotification($message) {

        $tokens = $this->getAllTokens();

        foreach($tokens as $token) {
            $this->sendNotification($token['token_value'], $message);
        }
    }

    public function sendNotification($token, $message)
    {

        // Put your device token here (without spaces):
        $deviceToken = $token;
        $passphrase = 'kazuki69';

        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', __DIR__ . '/../ssl/ios_ck.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        $fp = stream_socket_client(
            'ssl://gateway.sandbox.push.apple.com:2195', $err,
            $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

        if (!$fp)
            exit("Failed to connect: $err $errstr" . PHP_EOL);

        echo 'Connected to APNS' . PHP_EOL;

        $body['aps'] = array(
            'alert' => $message,
            'sound' => 'default'
        );

        $payload = json_encode($body);

        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

        $result = fwrite($fp, $msg, strlen($msg));

        if (!$result)
            echo 'Message not delivered' . PHP_EOL;
        else
            echo 'Message successfully delivered' . PHP_EOL;

        fclose($fp);
    }
}