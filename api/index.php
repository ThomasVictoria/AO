<?php

require '../inc/config.php';
require '../server-sms/class/Request.php';

$api = new Request($pdo, $config['journal'], $config['numero'], $config['compteur'], $admins);

<<<<<<< HEAD
<<<<<<< HEAD
if(time() < )

$data = $api->all_messages();
=======
=======
>>>>>>> 3dcc8b7c9fd33b04d2f1282c396b2d504833e7d0
if(time() < strtotime('29/02/2016')){

  $data = array(
    "code" => 404,
  );


} else {

  $data = array(
    "code"     => 200,
    "messages" => $api->all_messages()
  );

}

<<<<<<< HEAD
>>>>>>> 3dcc8b7c9fd33b04d2f1282c396b2d504833e7d0
=======
>>>>>>> 3dcc8b7c9fd33b04d2f1282c396b2d504833e7d0
header('Content-Type: application/json');
echo json_encode($data);