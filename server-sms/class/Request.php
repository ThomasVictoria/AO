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
  * Numéro pouvant poster dans le journal
  *
  */

  private $admin = array();

  public function __construct($pdo, $journal_base, $number_base, $count_base, $admin)
  {

    $this->pdo     = $pdo;
    $this->journal = $journal_base;
    $this->number  = $number_base;
    $this->countB  = $count_base;
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

      $prepare = $this->pdo->prepare("INSERT INTO ".$this->number."(number) VALUES (:number)");

      $prepare->bindValue(':number', $number);

      $prepare->execute();

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

    return $result;

  }

  /** 
 * 
 * Récupère les messages posté il y a 24h 
 * 
 */

  public function get_last_messages()
  {

    setlocale(LC_TIME, "fr_FR");

    $query = $this->pdo->query("SELECT * FROM ".$this->journal."");
    $messages = $query->fetchAll();

    $text = "Journal de bord : \n\n ";

    foreach($messages as $message)
    {

      if((time() - 24*60*60) <= $message->time){

        $text .= "Le ".strftime('%A', $message->time) ." ".date('d.m.y', $message->time)." à ".date('G:i', $message->time).", ". $message->name ." à dit : \n ";
        $text .= $message->message." \n \n ";

      }

    }

    $text .= "----- \n";
    $text .= "Venez vivre comme nous, une expérience exceptionnelle en participant au 4L Trophy ! Soutenez l’association sur www.enfantsdudesert.org";

    return $text;
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

  }

  /** 
 * 
 * Retourne tout les messages 
 * 
 */

  public function all_messages()
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

    $this->detect_message($number);
    $this->save_number($number);

  }

}