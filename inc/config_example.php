<?php

// Identifiants à la BDD
define('DB_HOST','');
define('DB_NAME','');
define('DB_USER','');
define('DB_PASS','');

define("SALT","");

// Generate with test.php
define("PWDPAULINE","");
define("PWDMARGAUX","");


// Chemins vers les différents chemins utiles au fonctionnement du site

define('CONTROLEURS', 'pages/');

error_reporting(E_ALL);
ini_set('display_errors',1);

/** 
 * 
 * STRUCTURE BASES : 
 * 
   TYPE TABLE MESSAGES (nom a spécifié dans le tableaux config) : 
      - id        INT PRIMARY AUTO_INCREMENT
      - message   TEXT 250
      - time      INT
      - name      VARCHAR
 *
 *
 *
   TYPE TABLE NUMERO (nom a spécifié dans le tableaux config) : 
      - id        INT PRIMARY AUTO_INCREMENT
      - number    INT
 *    
 *    
   TYPE TABLE COMPTEUR (nom a spécifié dans le tableaux config) :
      - id        INT PRIMARY AUTO_INCREMENT
      - num       INT
      -> insert dans cette table un row avec 0 dans num pour que ça fonctionne
      
 */

/** 
 * 
 * Pour ajouter un admin ajoutez le numéro en premier et le nom 
 * son nom en second
 * 
 */

$admins = array(
  'pauline'  => 'Pauline',
  'margaux'   => 'Margaux'
);

/** 
  * 
  * var journal = nom de TABLE MESSAGES
  *
  * var numero  = nom de TABLE NUMERO
  *
  * var count   = nom de TABLE 
  * 
  */

$config = array(

  'journal'  => 'Messages',
  'numero'   => 'Numeros',
  'compteur' => 'Compteur'

);

try
{
  // Try to connect to database
  $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);

  // Set fetch mode to object
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
}
catch (Exception $e)
{
  // Failed to connect
  die('Could not connect');
}

?>