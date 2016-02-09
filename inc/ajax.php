<?php

require 'config.php';

if(!empty($_POST['state'])){

  if($_POST['state'] == 'new_post'){

    if(!empty($_POST['text'] && !empty($_POST['name'])))
    {

      $time = time();

      $prepare = $pdo->prepare("INSERT INTO ".$config['journal']."(message,name,time) VALUES (:message,:name,:time)");

      $prepare->bindValue(':message', $_POST['text']);
      $prepare->bindValue(':name', ucfirst($_POST['name']));
      $prepare->bindValue(':time', $time);

      $result = $prepare->execute();

      $reponse = 'Message poste dans le journal';

    }
    else
    {

      $reponse = 'Erreur lors de l\'envoie';

    }

  }
  else if($_POST['state'] == 'delete_post'){

    if(!empty($_POST['id']))
    {

      $prepare = $pdo->prepare("DELETE FROM ".$config['proches']." WHERE id = '".$_POST['id']."'");

      $result = $prepare->execute();

      $reponse = 'Numéro supprimé';

    }

  }
  else if($_POST['state'] == 'edit_post'){

    if(!empty($_POST['id']) && !empty($_POST['number']) && !empty($_POST['nom']))
    {

      $prepare = $pdo->prepare("UPDATE ".$config['proches']." SET name = :name, number = :number");

      $prepare->bindValue(':name', $_POST['nom']);
      $prepare->bindValue(':number', $_POST['number']);

      $result = $prepare->execute();

      $reponse = 'Numéro mis à jour';

    }
    
  }
  else if($_POST['state'] == 'new_proche'){

    if(!empty($_POST['relation']) && !empty($_POST['number']) && !empty($_POST['nom']))
    {

      if($_POST['relation'] == 'pauline')
        $relation = 0;
      else
        $relation = 1;
      
      $prepare = $pdo->prepare("INSERT INTO ".$config['proches']."(name,number,relation) VALUES (:name,:number,:relation)");

      $prepare->bindValue(':name', $_POST['nom']);
      $prepare->bindValue(':number', $_POST['number']);
      $prepare->bindValue(':relation', $relation);

      $result = $prepare->execute();

      $reponse = 'Numéro créé';

    }

  }

}
else
{
  $reponse = 'Erreur de connexion';
}
echo json_encode(['response' => $reponse]);