<div class="row">


            <div class="col-lg-3 col-sm-6">

              <div class="teaser info_bg_color counter-background-teaser text-center">
                <span class="counter counter-background" data-from="0" data-to="<?php echo $total_clients; ?>" data-speed="300">0</span>
                <h3 class="counter-wrap highlight" data-from="0" data-to="<?php echo $total_clients; ?>" data-speed="300">
                  <!-- <small><i class="fa fa-users"></i></small> -->
                  <span class="counter" data-from="0" data-to="<?php echo $total_clients; ?>" data-speed="350">0</span>
                  <!-- <small class="counter-add">k</small> -->
                </h3>
                <p>Registered Clients</p>
              </div>

            </div>

            <div class="col-lg-3 col-sm-6">

              <div class="teaser warning_bg_color counter-background-teaser text-center">
                <span class="counter counter-background" data-from="0" data-to="<?php echo $total_gadgets; ?>" data-speed="300">0</span>
                <h3 class="counter highlight" data-from="0" data-to="<?php echo $total_gadgets; ?>" data-speed="350">0</h3>
                <p>Disposable gadgets</p>
              </div>

            </div>

            <div class="col-lg-3 col-sm-6">

              <div class="teaser success_bg_color counter-background-teaser text-center">
                <span class="counter counter-background" data-from="0" data-to="<?php echo $approved_disposes; ?>" data-speed="300">0</span>
                <h3 class="counter highlight" data-from="0" data-to="<?php echo $approved_disposes; ?>" data-speed="350">0</h3>
                <p>Approved Disposes</p>
              </div>

            </div>

            <div class="col-lg-3 col-sm-6">

              <div class="teaser danger_bg_color counter-background-teaser text-center">
                <span class="counter counter-background" data-from="0" data-to="<?php echo $pending_disposes; ?>" data-speed="300">0</span>
                <h3 class="counter highlight" data-from="0" data-to="<?php echo $pending_disposes; ?>" data-speed="350">0</h3>
                <p>Pending Disposes</p>
              </div>

            </div>
          </div>

          <div class="row">

            <div class="col-xs-12 col-md-8">
              <!-- <div class="with_border with_padding"> -->
              <h3 class="module-title darkgrey_bg_color">My Calendar</h3>
              <div class="events_calendar"></div>
                
              <!-- </div> -->
              <!-- .with_border -->
            </div>
            <!-- .col-* -->

            <div class="col-xs-12 col-md-4">
              <div class="with_border with_padding">
                <h4>
                  Latest Updates
                </h4>
                <div class="admin-scroll-panel scrollbar-macosx">

                  <ul class="list1 no-bullets">


                   <?php
                     $i=1;
                     foreach($logs_query as $row):
                      $message=$row['message'];
                      $trigger_date=$row['trigger_date'];
                      $priority=$row['priority'];
                    ?>
                    <li>
                      <div class="media small-teaser">
                        <div class="media-left media-middle">
                          <div class="teaser_icon 
                            <?php if($priority==0 || $priority==3){ 
                                echo 'label-success';
                              }else if($priority==1){
                                echo 'label-info';
                              }else if($priority==2){
                                echo 'label-warning';
                              }else if($priority==4){
                                echo 'label-default';
                              }
                            ?> 
                            round">
                            <i class=" 
                              <?php if($priority==0){ 
                                  echo 'fa fa-user';
                                }else if($priority==1){
                                  echo 'rt-icon2-tv';
                                }else if($priority==2){
                                echo 'rt-icon2-cup';
                                }else if($priority==3 || $priority==4){
                                  echo 'fa fa-check';
                                }
                              ?> "></i>
                          </div>
                        </div>
                        <div class="media-body media-left">
                          <span class="grey">
                            <?php echo $message.' on <small><b>'.date('D, d/M/Y',$trigger_date).'</b> at <b>'.date('h:i:a',$trigger_date) ?></b></small>
                          </span>
                        </div>
                      </div>
                    </li>
                  <?php endforeach?>

                  </ul>
                </div>
                <br>
                  <div class="row">
                    <div col-sm-12>
                      <button class="btn btn-success" onclick="showLogsUrl('<?php echo base_url() ?>admin/logs')"> see all logs<?php ?></button>
                    </div>
                  </div>
                <!-- .admin-scroll-panel -->
              </div>
              <!-- .with_border -->
            </div>
            <!-- .col-* -->


          </div>
          <!-- .row -->