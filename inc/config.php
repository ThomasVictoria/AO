<?php

// Identifiants à la BDD
define('DB_HOST','localhost');
define('DB_NAME','callr');
define('DB_USER','root');
define('DB_PASS','');

define("SALT","9hb876s06xclkg461i6h4y1n1dskfpcm6ej2h30cxjxhrqcp8f");

define("PWDPAULINE","5eef8a2d9d90ceb22949ec268807d2a9d9ba7c59");
define("PWDMARGAUX","5eef8a2d9d90ceb22949ec268807d2a9d9ba7c59");


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

  //[numero, nom]
  ['33631772046', 'Pauline'],
  ['33666666666', 'Margaux']  

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

  'journal'  => 'messages',
  'numero'   => 'test',
  'compteur' => 'compteur'

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