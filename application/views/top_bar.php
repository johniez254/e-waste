<?php
$user_id= $this->session->userdata('id');
$role=$this->db->get_where('login' , array('login_id'=>$user_id))->row()->role;
$name       = $this->db->get_where('login' , array('login_id'=>$id))->row()->name;
?>
<header class="page_header header_darkgrey">

        <!-- <div class="widget widget_search">
          <form method="get" class="searchform form-inline" action="http://webdesign-finder.com/html/gogreen/">
            <div class="form-group">
              <label class="screen-reader-text" for="widget-search-header">Search for:</label>
              <input id="widget-search-header" type="text" value="" name="search" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="theme_button">Search</button>
          </form>
        </div> -->


        <div class="pull-right big-header-buttons">
          <!-- <ul class="inline-dropdown inline-block">


            <li class="dropdown header-notes-dropdown">
              <a class="header-button" data-target="#" href="index-2.html" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                <i class="fa fa-bell-o grey"></i>
                <span class="header-button-text">Messages</span>
                <span class="header-dropdown-number">
                  12
                </span>
              </a>

              <div class="dropdown-menu ls">
                <div class="dropdwon-menu-title with_background">
                  <strong>12 Pending</strong> Notifications

                  <div class="pull-right darklinks">
                    <a href="#">View All</a>
                  </div>

                </div>
                <ul class="list-unstyled">

                  <li>
                    <div class="media with_background">
                      <div class="media-left media-middle">
                        <div class="teaser_icon label-success">
                          <i class="fa fa-user"></i>
                        </div>
                      </div>
                      <div class="media-body media-middle">
                        <span class="grey">
                          New user registered
                        </span>
                        <span class="pull-right">Just Now</span>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="media with_background">
                      <div class="media-left media-middle">
                        <div class="teaser_icon label-info">
                          <i class="fa fa-bullhorn"></i>
                        </div>
                      </div>
                      <div class="media-body media-middle">
                        <span class="grey">
                          New user registered
                        </span>
                        <span class="pull-right">20 minutes</span>
                      </div>
                    </div>
                  </li>

                  <li>
                    <div class="media with_background">
                      <div class="media-left media-middle">
                        <div class="teaser_icon label-danger">
                          <i class="fa fa-bolt"></i>
                        </div>
                      </div>
                      <div class="media-body media-middle">
                        <span class="grey">
                          Server overloaded
                        </span>
                        <span class="pull-right">1 hour</span>
                      </div>
                    </div>
                  </li>

                  <li>
                    <div class="media with_background">
                      <div class="media-left media-middle">
                        <div class="teaser_icon label-success">
                          <i class="fa fa-shopping-cart"></i>
                        </div>
                      </div>
                      <div class="media-body media-middle">
                        <span class="grey">
                          New order
                        </span>
                        <span class="pull-right">3 hours</span>
                      </div>
                    </div>
                  </li>

                  <li>
                    <div class="media with_background">
                      <div class="media-left media-middle">
                        <div class="teaser_icon label-warning">
                          <i class="fa fa-bell-o"></i>
                        </div>
                      </div>
                      <div class="media-body media-middle">
                        <span class="grey">
                          Long database query
                        </span>
                        <span class="pull-right">4 hours</span>
                      </div>
                    </div>
                  </li>

                  <li>
                    <div class="media with_background">
                      <div class="media-left media-middle">
                        <div class="teaser_icon label-success">
                          <i class="fa fa-user"></i>
                        </div>
                      </div>
                      <div class="media-body media-middle">
                        <span class="grey">
                          New user registered
                        </span>
                        <span class="pull-right">4 hours</span>
                      </div>
                    </div>
                  </li>

                </ul>
              </div>
            </li> -->

            <!-- Uncomment following to show user menu  -->
        
          <li class="dropdown user-dropdown-menu">
            <a class="header-button" id="user-dropdown-menu" data-target="#" href="./profile" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
              <i class="fa fa-user grey"></i> <b style="color: #fff"><?php echo ucwords($name)?> <i class="fa fa-caret-down"></i></b>
            </a>
            <div class="dropdown-menu ls">
              <ul class="nav darklinks">
                <?php if($role=="admin"){?>
                  <li>
                    <a href="<?php echo base_url() ?>admin/profile">
                      <i class="fa fa-user"></i>
                      Profile
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo base_url() ?>admin/settings">
                      <i class="fa fa-cog"></i>
                      Settings
                    </a>
                  </li>
                <?php }else{?>
                  <li>
                    <a href="<?php echo base_url() ?>client/profile">
                      <i class="fa fa-user"></i>
                      My Profile
                    </a>
                  </li>
                <?php }?>
                  <li>
                    <a href="<?php echo base_url()?>logout">
                      <i class="fa fa-sign-out"></i>
                      Log Out
                    </a>
                  </li>
              </ul>

            </div>

          </li>
        
       

            <li class="dropdown visible-xs-inline-block">
              <a href="#" class="search_modal_button header-button">
                <i class="fa fa-search grey"></i>
                <span class="header-button-text">Search</span>
              </a>
            </li>
          </ul>
        </div>
        <!-- eof .header_right_buttons -->
      </header>