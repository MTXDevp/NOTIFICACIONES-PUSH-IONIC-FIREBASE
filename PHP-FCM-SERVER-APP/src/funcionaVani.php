<?php

namespace MyApp;


require dirname(__DIR__) . '/vendor/autoload.php';

//API URL of FCM
$url = 'https://fcm.googleapis.com/fcm/send';

$device_id = "DEBES INCLUIR EL TOKEN DE ACCESO QUE SE MOSTRARÁ EN LA CONSOLA (IONIC)";
//$device_id = "fq_ocI3pad8:APA91bF61PYur50FEbPj3qsi7_-qHvdzoiJ66sg1H15in_df3g6eFDagUJgmoSTlv4xGsGgVRghoxSwBg1D5SllBSEYvGB8Ww_C3HVZPl1rpbdwFZXPYyyi1j3a8Ck0s4kNxv82kqNk6";
$message = "Funciona";

/*api_key available in:
  Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key*/
  $api_key = 'AAAAW7_Ke74:APA91bE7bRXlJwTHah1uCVpl-89V1hsofK_jIl4qW17tAGvxqmm6erARdw0XCU_JqlCbJUiEM-N79yuMou5ZdEpro8TS0PPDceRny9U91qnKoSaBAzD4lpoVcdbZsGh-4PlDHFFRz_63';

  $fields = array (
      'registration_ids' => array (
              $device_id
      ),
      'data' => array (
              "message" => $message
      ),
      'notification' => array (
          "title" =>"Notification title",
          "body"=>"Estamos working",
          "sound"=>"default",
          "click_action"=>"FCM_PLUGIN_ACTIVITY",
      ),
  );

  //header includes Content type and api key
  $headers = array(
      'Content-Type:application/json',
      'Authorization:key='.$api_key
  );

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
  $result = curl_exec($ch);

  if ($result === FALSE) {
      die('FCM Send Error: ' . curl_error($ch));
  }else{

    print("Mensaje enviado con éxito!!!");
  }


  curl_close($ch);
  return $result;
