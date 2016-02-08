<div class="container">
  <div class="row">
    <div class="col-lg-12 center-block">
      <img src="img/logo.png" alt="accueil" class="img-responsive main-logo"/>
    </div>
    <div class="col-lg-12 text-center">
      <h1> Salut les Gazelles ! Bienvenue sur le Dashboard !</h1>
    </div>

    <div class="col-lg-12 text-center main-stats">

      <div class="row m-t-xs">
        <div class="col-xs-6">
          <h5 class="m-b-xs">Nombre de messages envoyés</h5>
          <h1 class="no-margins">
            <?php echo $api->count_abonne(); ?>
          </h1>
        </div>
        <div class="col-xs-6">
          <h5 class="m-b-xs">Nombre de messages reçus</h5>
          <h1 class="no-margins"><?php echo $api->count_messages(); ?></h1>
        </div>
      </div>
    </div>
  </div>
</div>
