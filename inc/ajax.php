<?php

require 'config.php';

if(!empty($_POST['name']) && !empty($_POST['text']))
{

  $time = time();
  
  $prepare = $pdo->prepare("INSERT INTO ".$config['journal']."(message,name,time) VALUES (:message,:name,:time)");

  $prepare->bindValue(':message', $_POST['text']);
  $prepare->bindValue(':name', $_SESSION["authenticated"];
  $prepare->bindValue(':time', $time);

  $result = $prepare->execute();

  $reponse = 'Message posté dans le journal';
  
}
else
{
  
  $reponse = 'Erreur lors de l\'envoi';
  
}
echo json_encode(['response' => $reponse]);