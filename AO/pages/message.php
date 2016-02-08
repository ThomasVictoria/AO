<div class="middle-box-message text-center animated fadeInDown">
  <div>
    <h1>Diffuser un message</h1>
    <form class="m-t" role="form" id="login" method="post">
      <div class="form-group text">
        <textarea type="text" class="form-control" placeholder="Ton message" id="message" name="message" required=""></textarea>
      </div>
      <input type="hidden" value="<?php echo $_SESSION["authenticated"] ?>" name="name" id="name">
      <input type="submit" class="btn btn-primary block full-width m-b" value="Envoyer le message">
    </form>
  </div>
  <div class="state"></div>
</div>