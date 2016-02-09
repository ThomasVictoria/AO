<div class="container">
  <div class="animated fadeInDown">
    <div class="pull-left">
      <div class="title-proches">
        <h1>Proches</h1>
        <button class="btn btn-success btn-xs btn-add">Ajouter</button>
      </div>
      <ul class="proche-numbers">

        <?php 
        $proches = $api->get_proches($_SESSION["authenticated"]);

        foreach($proches as $proche){
        ?>

        <li data-id="<?php echo $proche->id ?>">
          <span class="info-container"><strong><?php echo $proche->name ?></strong> <span class="number"> (<?php echo substr_replace($proche->number, '0', 0, 2) ?>)</span></span>
          <button class="btn btn-info btn-xs btn-edit">Edit</button>
          <button class="btn btn-danger btn-xs btn-delete">Supprimer</button>
        </li>

        <?php } ?>

      </ul>
    </div>
    <div class="pull-right form-proches" data-session="<?php echo $_SESSION["authenticated"] ?>" >

      <form class="m-t" data-number="" data-name="" role="form" id="editProche" method="post">
        <div class="form-group text">
          <input type="text" class="form-control form-name" placeholder="Nom" id="name" name="name" required=""></input>
          <input type="text" class="form-control form-number" placeholder="Numéro de téléphone" id="phone" name="phone" required=""></input>
        </div>
        <div class="btn btn-primary btn-action block full-width m-b" >Éditer</div>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="wrapper wrapper-content animated fadeInRight">

      <h1 class="h1-msg">Messages</h1>

        <?php 
        $messages = $api->get_proches_messages($_SESSION["authenticated"]); 

        foreach($messages as $message){
        ?>
        <div class="ibox-content forum-post-container">
          <div class="media">
            <div class="media-body">
              <?php echo $message->message ?> 
              <br>
              <br>
              - <i>par <b><?php echo $message->name ?></b> le <?php echo date('d/m/Y',$message->time) ?> à <?php echo date('G:i', $message->time) ?></i> 
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>


</div>

