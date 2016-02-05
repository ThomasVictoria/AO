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

include 'inc/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$password = sha1($_POST["password"].SALT);
echo $password;
} else {
?>
            <form class="m-t" role="form" id="login" method="post">
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" id="password" name="password" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
            </form>
<?php
}
?>