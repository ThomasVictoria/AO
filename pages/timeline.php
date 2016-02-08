<div class="row animated fadeInRight">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="text-center float-e-margins p-md">
        <h1>Timeline</h1>
      </div>
      <div class="ibox-content" id="ibox-content">

        <div id="vertical-timeline" class="vertical-container dark-timeline center-orientation">

          <?php 

          $messages = $api->all_messages();

          foreach($messages as $message){

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

          <?php } ?>

        </div>

      </div>
    </div>
  </div>