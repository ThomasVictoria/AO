<?php

class Request
{

  /**
  *
  * Initialisation pdo 
  *
  */

  private $pdo;

  /**
  *
  * Nom base journal pauline
  *
  */

  private $journal_base;

  /**
  *
  * Nom base numéro téléphone
  *
  */

  private $number_base;

  /**
  *
  * Compteur nombre messages total envoyé
  *
  */

  private $count_base;

  /**
  *
  * Numéro et nom des proches ajouté 
  *
  */

  private $count_proches;

  /**
  *
  * Stockage messages proches
  *
  */

  private $count_proches_msg;

  /**
  *
  * Numéro pouvant poster dans le journal
  *
  */

  private $admin = array();

  public function __construct($pdo, $journal_base, $number_base, $count_base, $count_proches, $count_proches_msg, $admin)
  {

    $this->pdo     = $pdo;
    $this->journal = $journal_base;
    $this->number  = $number_base;
    $this->countB  = $count_base;
    $this->proches = $count_proches;
    $this->msg     = $count_proches_msg;
    $this->admin   = $admin;

  }

  /**
  *
  * Verifie si le numéro est admin
  *
  */

  public function admin_verify($number)
  {

    foreach($this->admin[0] as $admin)
    {

      if($admin == $number)
        return true;

    }

    return false;

  }

  /** 
  * 
  * Verifie si c'est le numéro d'un proche 
  * 
  */

  public function proche_verify($number)
  {

    $query = $this->pdo->query("SELECT number FROM ".$this->proches."");
    $query = $query->fetchAll();


    foreach($query as $id)
    {

      if($id->number == $number)
        return true;

    }

    return false;

  }

  /** 
  * 
  * Save proches messages 
  * 
  */

  public function proches_post($number, $text)
  {

    $query = $this->pdo->query("SELECT name,relation FROM ".$this->proches." WHERE number = '".$number."'");
    $query = $query->fetch();

    $name     = $query->name;
    $relation = $query->relation;

    $prepare = $this->pdo->prepare("INSERT INTO ".$this->msg."(message,name,time,id_proche) VALUES (:message,:name,:time,:relation)");

    $prepare->bindValue(':message', $text);
    $prepare->bindValue(':name', $name);
    $prepare->bindValue(':time', time());
    $prepare->bindValue(':relation', $relation);

    $prepare->execute();

  }

  /** 
  * 
  * Get message par en fonction de son profil 
  * 
  */

  public function get_proches_messages($id)
  {

    if($id == 'pauline')
      $select = 0;
    else
      $select = 1;

    $query = $this->pdo->query("SELECT * FROM ".$this->msg." WHERE id_proche = ".$select);
    $query = $query->fetchAll();

    return $query;

  }

  /** 
  * 
  * Retourne tout les proches 
  * 
  */

  public function get_proches($id)
  {

    if($id == 'pauline')
      $select = 0;
    else
      $select = 1;

    $query = $this->pdo->query("SELECT * FROM ".$this->proches." WHERE relation = ".$select);
    $query = $query->fetchAll();

    return $query;

  }

  /** 
 * 
 * Enregistre le numéro dans la base de données 
 * 
 */

  public function save_number($number)
  {

    $query = $this->pdo->query("SELECT number FROM ".$this->number."");
    $query = $query->fetchAll();

    $exists = 0;

    foreach($query as $data)
    {

      if($data->number == $number){
        $exists = 1;
      }

    }

    if($exists == 0){

      $prepare = $this->pdo->prepare("INSERT INTO ".$this->number."(number,last,first) VALUES (:number,:time,:first)");

      $prepare->bindValue(':number', $number);
      $prepare->bindValue(':time', time());
      $prepare->bindValue(':first', 'true');

      $result = $prepare->execute();

      return $result;

    } else {

      $prepare = $this->pdo->prepare("UPDATE ".$this->number." SET last = :time, first = :first WHERE number = ".$number);

      $prepare->bindValue(':time', time());
      $prepare->bindValue(':first', 'false');

      $result = $prepare->execute();

      return $result;

    }


  }

  /** 
  * 
  * Nombre de personne qui ont envoyé un message 
  * 
  */

  public function count_abonne()
  {

    $query = $this->pdo->query("SELECT id FROM ".$this->number." ORDER BY id DESC LIMIT 1");
    $query = $query->fetch();

    if($query == false)
      return "0";
    else
      return $query->id;

  }

  /** 
  * 
  * Augmente le compteur a chaque nouveau message 
  * 
  */

  public function detect_message()
  {

    $query = $this->pdo->query("SELECT num FROM ".$this->countB."");
    $query = $query->fetch();

    $insert = $query->num + 1;

    $prepare = $this->pdo->prepare("UPDATE ".$this->countB." SET num = :count WHERE id=1");

    $prepare->bindValue(':count', $insert);

    $result = $prepare->execute();

    return $result;

  }

  /** 
 * 
 * Compte le nombre de message envoyé 
 * 
 */

  public function count_messages()
  {

    $query = $this->pdo->query("SELECT num FROM ".$this->countB." WHERE id=1");
    $query = $query->fetch();

    return $query->num;

  }

  /** 
 * 
 * Admin post dans le journal 
 * 
 */

  public function admin_post($in_number, $message, $time)
  {

    foreach($this->admin as $admin)
    {

      if($in_number == $admin[0])
        $name = $admin[1];

    }

    $prepare = $this->pdo->prepare("INSERT INTO ".$this->journal."(message,name,time) VALUES (:message,:name,:time)");

    $prepare->bindValue(':message', $message);
    $prepare->bindValue(':name', $name);
    $prepare->bindValue(':time', $time);

    $result = $prepare->execute();

    $this->send($in_number, '06 44 63 63 65', 'Ok c\'est noté !');

  }

  /** 
 * 
 * Récupère les messages posté il y a 24h 
 * 
 */

  public function get_last_messages($number)
  {

    $last_time = $this->last_send($number);

    setlocale (LC_TIME, 'fr_FR.utf8','fra');

    $query = $this->pdo->query("SELECT * FROM ".$this->journal."");
    $messages = $query->fetchAll();

    $text = "Dernières nouvelles : \n\n ";

    if($last_time == false){

      $compteur = 1;

      foreach($messages as $message)
      {

        if((time() - 24*60*60) <= $message->time){

          $text .= "Le ".strftime('%A', $message->time) ." ".date('d.m.y', $message->time)." à ".date('G:i', $message->time).", ". $message->name ." a dit : \n ";
          $text .= $message->message." \n \n ";

        }

      }

    } else {

      $compteur = 0;

      foreach($messages as $message)
      {

        if($last_time->last < $message->time){

          $compteur = $compteur + 1; 
          $text .= "Le ".strftime('%A', $message->time) ." ".date('d.m.y', $message->time)." à ".date('G:i', $message->time).", ". $message->name ." a dit : \n ";
          $text .= $message->message." \n \n ";

        }

      }

    }

    if($compteur == 0)
      $text .= "\n Pauline et Margaux n'ont pas publié de messages récemment \n"; 

    $text .= "_______ \n";
    $text .= "Venez vivre comme nous, une expérience exceptionnelle en participant au 4L Trophy ! Soutenez l'association sur www.enfantsdudesert.org";

    return $text;
  }

  /** 
  * 
  * Get last time of last message send 
  * 
  */

  public function last_send($number)
  {

    $query = $this->pdo->query("SELECT last,first FROM test WHERE number = ".$number);
    $query = $query->fetch();

    return $query;

  }

  /** 
 * 
 * Envoie du message 
 * 
 */

  public function send($to, $from, $text)
  {

    $url = 'https://rest.nexmo.com/sms/json?' . http_build_query([
      'api_key' => 'b7416830',
      'api_secret' => '2154e21c',
      'to' => '+'.$to ,
      'from' => $from,
      'text' => $text
    ]);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    return $response;

  }

  /** 
 * 
 * Retourne tout les messages 
 * 
 */

  public function all_messages()
  {

    $query = $this->pdo->query("SELECT * FROM ".$this->journal." ORDER BY id DESC");
    $messages = $query->fetchAll();

    return $messages;

  }

  public function all_messages_api()
  {

    $query = $this->pdo->query("SELECT * FROM ".$this->journal." ORDER BY id ASC");
    $messages = $query->fetchAll();

    return $messages;

  }

  /** 
  * 
  * Automatisation enregistrement l'entré de sms 
  * 
  */

  public function number_incomming($number)
  {

    $this->detect_message();
    $this->save_number($number);

    return true;

  }

}
