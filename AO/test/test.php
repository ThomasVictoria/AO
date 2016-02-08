<?php
//Générer une chaine aléatoire pour SALT
/*
function random($car) {
$string = "";
$chaine = "abcdefghijklmnpqrstuvwxy1234567890";
srand((double)microtime()*1000000);
for($i=0; $i<$car; $i++) {
$string .= $chaine[rand()%strlen($chaine)];
}
return $string;
}

// APPEL
// Génère une chaine de longueur 20
$chaine = random(50);

echo $chaine;
*/

$ch = curl_init('http://127.0.0.1/AO-callr/api/');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$response = json_decode($response);
echo '<pre>'; 
print_r($response); 
echo '</pre>';


?>