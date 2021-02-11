<section class="ls with_bottom_border">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <ol class="breadcrumb darklinks">
                <?php if($crumb==1){?>
                <li>
                  <a href="<?php echo base_url()?>">Homepage</a>
                </li>
                <li class="active"><?php echo ucwords($page_title)?></li>
              <?php }else{?>
                <li>
                  <a href="<?php echo base_url()?>">Homepage</a>
                </li>
                <li>
                  <a href="<?php echo base_url().$url?>"><?php echo ucwords($sub)?></a>
                </li>
                <li class="active"><?php echo ucwords($page_title)?></li>
              <?php }?>
              </ol>
            </div>
            <!-- .col-* -->
            <div class="col-md-6 text-md-right">
              <span class="dashboard-daterangepicker">
                <i class="fa fa-calendar"></i>
                <span  style="cursor: text;"><?php 
                echo date('l d, M-Y')?></span>
                <!-- <i class="caret"></i> -->
              </span>
            </div>
            <!-- .col-* -->
          </div>
          <!-- .row -->
        </div>
        <!-- .container -->
      </section>