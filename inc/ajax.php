<?php

require 'config.php';

if(!empty($_POST['name']) && !empty($_POST['text']))
{

  $time = time();
  
  $prepare = $pdo->prepare("INSERT INTO ".$config['journal']."(message,name,time) VALUES (:message,:name,:time)");

  $prepare->bindValue(':message', $_POST['text']);
  $prepare->bindValue(':name', $_POST['name']);
  $prepare->bindValue(':time', $time);

  $result = $prepare->execute();

  $reponse = 'Message poste dans le journal';
  
}
else
{
  
  $reponse = 'Erreur lors de l\'envoie';
  
}
echo json_encode(['response' => $reponse]);