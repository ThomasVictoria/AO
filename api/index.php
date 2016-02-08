<?php

require '../inc/config.php';
require '../server-sms/class/Request.php';

$api = new Request($pdo, $config['journal'], $config['numero'], $config['compteur'], $admins);

strtotime('29/02/2016')){

  $data = array(
    "code" => 404,
  );


} else {

  $data = array(
    "code"     => 200,
    "messages" => $api->all_messages()
  );

}

header('Content-Type: application/json');
echo json_encode($data);