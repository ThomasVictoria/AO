<?php
session_start();

// On appelle le fichier de config
include 'inc/config.php';

$page = isset($_GET['page']) ? $page = $_GET['page'] : $page = '';

//On inclut le contrôleur s'il existe et s'il est spécifié, sinon on renvoit vers l'accueil
if($page == 'logout'){

    include CONTROLEURS.'/logout.php';

}
elseif (!empty($page) && is_file(CONTROLEURS.'/'.$page.'.php'))
{
            if(empty($_SESSION["authenticated"]) || $_SESSION["authenticated"] != 'true') {
             header('Location: index.php');
             exit;
            }
         // On appelle le haut de la page
        include 'header.php';   

        include CONTROLEURS.'/'.$page.'.php';

        // On appelle le bas de la page
        include 'footer.php';
}
else
{
        include CONTROLEURS.'/login.php';
}



?>

