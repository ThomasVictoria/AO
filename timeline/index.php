<?php include 'header.php' ?>

<div class="row animated fadeInRight">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="text-center float-e-margins p-md">
        <h1>Timeline 4L Trophy MP GAZ'L</h1>
      </div>
      <div class="ibox-content" id="ibox-content">

        <div id="vertical-timeline" class="vertical-container dark-timeline center-orientation">

          <?php 


          $ch = curl_init('http://91.121.107.122/api/');
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $response = curl_exec($ch);
          $response = json_decode($response);

          if ($response->code == 200) {

          foreach($response->messages as $message){

            $date = date('d/m-G:i', $message->time);
            $date = explode("-", $date);

          ?>

          <div class="vertical-timeline-block">
            <div class="vertical-timeline-icon navy-bg">
              <i class="fa fa-comment"></i>
            </div>
            <div class="vertical-timeline-content">
              <h2><?php echo $message->name ?></h2>
              <p><?php echo $message->message ?></p>
              <span class="vertical-date">
                <?php echo $date[0] ?> <br/>
                <small><?php echo $date[1] ?></small>
              </span>
            </div>
          </div>

          <?php }} ?>

        </div>

      </div>
    </div>
  </div>

<?php include 'footer.php' ?>