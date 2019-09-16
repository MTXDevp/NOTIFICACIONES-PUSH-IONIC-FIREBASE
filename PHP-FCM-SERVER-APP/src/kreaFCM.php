<?php

namespace MyApp;

require dirname(__DIR__) . '/vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Messaging\RawMessageFromArray;
use Kreait\Firebase\Messaging\Message;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Messaging\AndroidConfig;

//https://buildmedia.readthedocs.org/media/pdf/firebase-php/latest/firebase-php.pdf

$device_id = "DEBES INCLUIR EL TOKEN DE ACCESO QUE SE MOSTRARÁ EN LA CONSOLA (IONIC)";

//$deviceToken = 'fq_ocI3pad8:APA91bF61PYur50FEbPj3qsi7_-qHvdzoiJ66sg1H15in_df3g6eFDagUJgmoSTlv4xGsGgVRghoxSwBg1D5SllBSEYvGB8Ww_C3HVZPl1rpbdwFZXPYyyi1j3a8Ck0s4kNxv82kqNk6';

$firebase = (new Firebase\Factory())
    ->withServiceAccount('../ionicpushnotifire-e7e1c38eaef7.json')
    ->create();

    $messaging = $firebase->getMessaging();


    $config = AndroidConfig::fromArray([
        'ttl' => '3600s',
        'priority' => 'normal',
        'notification' => [
            'title' => '$GOOG up 1.43% on the day',
            'body' => '$GOOG gained 11.80 points to close at 835.67, up 1.43% on the day.',
            'click_action'=>'FCM_PLUGIN_ACTIVITY',
            'icon' => 'stock_ticker_update',
            'color' => '#f45342',
        ],
    ]);
    $message = CloudMessage::withTarget("token", $deviceToken)
    ->withAndroidConfig($config);

    $messaging->send($message);
