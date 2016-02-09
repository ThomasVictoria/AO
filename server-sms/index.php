<?php

require '../inc/config.php';
require 'class/Request.php';

$api = new Request($pdo, $config['journal'], $config['numero'], $config['compteur'], $config['proches'], $config['proches_msg'], $admins);

// work with get or post
$request = array_merge($_GET, $_POST);

// check that request is inbound message
if(!isset($request['to']) OR !isset($request['msisdn']) OR !isset($request['text']))
{
  return;
}
else
{

  if($api->admin_verify($request['msisdn']) == true){

    $api->admin_post($request['msisdn'], $request['text'], time());

  } else if($api->proche_verify($request['msisdn']) == true) {

    $api->proches_post($request['msisdn'], $request['text'], time());

  } else {
    
    $api->send($request['msisdn'], $request['to'], $api->get_last_messages($request['msisdn']));

    $api->number_incomming($request['msisdn']);    
    
  }

}
