<?php
$username = null;
$password = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //echo 'test 1';
  if(!empty($_POST["username"]) && !empty($_POST["password"])) {
    $username = $_POST["username"];
    $password = sha1($_POST["password"].SALT);
    //echo $password;
    if(($username == 'margaux' && $password == PWDMARGAUX) || ($username == 'pauline' && $password == PWDPAULINE)) {
      $_SESSION["authenticated"] = $username;
      header('Location: index.php?page=main');
      exit;

      echo '<pre>';
      print_r($admins[$_SESSION["authenticated"]]);
      print_r($_SESSION["authenticated"]);
      echo '</pre>';

    }

    else {

      header('Location: index.php');
      exit;
    }

  } else {

    header('Location: index.php');
    exit;
  }
} else {

?>  



<!DOCTYPE html>
<html>

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>

  <body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
      <div>
        <div>

          <img src="img/logo-login.png" alt="logo" />

        </div>
        <p>Identifiez vous pour pouvoir continuer.</p>
        <form class="m-t" role="form" id="login" method="post">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Nom d'utilisatrice" id="username" name="username" required="">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Mot de passe" id="password" name="password" required="">
          </div>
          <button type="submit" class="btn btn-primary block full-width m-b">Connexion</button>
        </form>
      </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>


</html>

<?php } ?>