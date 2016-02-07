<?php

require '../inc/config.php';
require '../server-sms/class/Request.php';

$api = new Request($pdo, $config['journal'], $config['numero'], $config['compteur'], $admins);

if(time() < )

$data = $api->all_messages();
header('Content-Type: application/json');
echo json_encode($data);