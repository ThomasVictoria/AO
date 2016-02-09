<div class="container">
  <div class="animated fadeInDown">
    <div class="pull-left">
      <div class="title-proches">
        <h1>Proches</h1>
        <button class="btn btn-success btn-xs btn-add">Ajouter</button>
      </div>
      <ul class="proche-numbers">

        <li>
        <span><strong>Maman</strong><span class="number"> (0670414930)</span></span>
        <button class="btn btn-info btn-xs btn-edit">Edit</button>
        <button class="btn btn-danger btn-xs btn-delete">Supprimer</button>
      </li>

      </ul>
    </div>
    <div class="pull-right form-proches" data-session="<?php echo $_SESSION["authenticated"] ?>" >

      <form class="m-t" data-number="" data-name="" data-action="" role="form" id="formProche" method="post">
        <div class="form-group text">
          <input type="text" class="form-control" placeholder="Nom" id="name" name="name" required="">
          <input type="text" class="form-control" placeholder="Numéro de téléphone" id="phone" name="phone" required="">
        </div>
        <div class="btn btn-primary btn-action block full-width m-b" ></div>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="state"></div>
    <div class="col-lg-12">
      <div class="wrapper wrapper-content animated fadeInRight">

      </div>
    </div>
  </div>


</div>

