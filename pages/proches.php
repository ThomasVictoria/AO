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
          <span><strong><?php echo $proche->name ?></strong> <span class="number">(<?php echo substr_replace($proche->number, '0', 0, 2) ?>)</span></span>
          <button class="btn btn-info btn-xs btn-edit">Edit</button>
          <button class="btn btn-danger btn-xs btn-delete">Supprimer</button>
        </li>

        <?php } ?>

      </ul>
    </div>
    <div class="pull-right form-proches" data-session="<?php echo $_SESSION["authenticated"] ?>" >
    </div>
  </div>
  <div class="row">
    <div class="state"></div>
    <div class="col-lg-12">
      <div class="wrapper wrapper-content animated fadeInRight">

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
              - <i>par <b><?php echo $message->name ?></b> il y a <?php echo date('i' ,(time() - $message->time)) ?> minutes</i> 
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>


</div>

