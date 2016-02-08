<!DOCTYPE html>
<html>

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MP GAZ'L Board</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">


  </head>

  <body class="top-navigation">

    <div id="wrapper">
      <div id="page-wrapper" class="gray-bg">
        <?php
        if(!empty($_SESSION["authenticated"]) || $_SESSION["authenticated"] == 'true')   
        {

          require_once 'inc/config.php';          
          require_once 'server-sms/class/Request.php';

          $api = new Request($pdo, $config['journal'], $config['numero'], $config['compteur'], $config['proches'], $config['proches_msg'], $admins);

        ?>
        <div class="row border-bottom white-bg">
          <nav class="navbar navbar-static-top" role="navigation">
            <div class="navbar-header">
              <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                <i class="fa fa-reorder"></i>
              </button>
              <a href="index.php?page=main" class="navbar-brand">MP GAZ'L</a>
            </div>
            <div class="navbar-collapse collapse" id="navbar">
              <ul class="nav navbar-nav">
                <li>
                  <a aria-expanded="false" role="button" href="index.php?page=message">Diffuser un message</a>
                </li>
                <li>
                  <a aria-expanded="false" role="button" href="index.php?page=timeline">Timeline</a>
                </li>
                <li>
                  <a aria-expanded="false" role="button" href="index.php?page=proches">Messages de proches</a>
                </li>
              </ul>
              <ul class="nav navbar-top-links navbar-right">
                <li>
                  <a href="index.php?page=logout">
                    <i class="fa fa-sign-out"></i> Déconnexion
                  </a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
        <?php } ?>

        <div class="wrapper wrapper-content">