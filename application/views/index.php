<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$system_abbr       =	$this->db->get_where('settings' , array('setting_id'=>'1'))->row()->system_abbr;
$id		 =	$this->session->userdata('id');
$role       =	$this->db->get_where('login' , array('login_id'=>$id))->row()->role;
$name       =	$this->db->get_where('login' , array('login_id'=>$id))->row()->name;
?>

<!DOCTYPE html>
<html class="no-js" lang="eng">
<head>
    <title><?php echo ucwords($page_title).' :: '.$system_abbr;?></title>
    
    <?php include "includes_top.php"?>

</head>

<body class="admin">

  <div class="preloader">
    <div class="preloader_image"></div>
  </div>

  <!-- wrappers for visual page editor and boxed version of template -->
  <div id="canvas">
    <div id="box_wrapper">

      <!-- template sections -->

      <header class="page_header_side page_header_side_sticked active-slide-side-header ds">
        <div class="side_header_logo ds ms">
          <a href="<?php echo base_url()?>">
            <span class="logo_text playfair margin_0">
              E-Waste
            </span>
          </a>
        </div>
        <span class="toggle_menu_side toggler_light header-slide">
          <span></span>
        </span>
        <div class="scrollbar-macosx">
          <div class="side_header_inner">

            <!-- user -->

            <div class="user-menu">


              <ul class="menu-click">
                <li  class="<?php if($page_name=="profile" || $page_name=="settings") {?> active-submenu <?php }?>">
                  <a href="#">
                    <div class="media">
                      <div class="media-left media-middle">
                        <img src="<?php echo $this->qm->get_image_url('user',$id);?>" alt="profile_image">
                      </div>

                      <?php if($role=="admin"){ ?>

                      <div class="media-body media-middle">
                        <h4><?Php echo ucwords($name); ?></h4>
                        <?Php echo ucwords($role); ?>

                      </div>

                    </div>
                  </a>
                  <ul class="dark_bg_color">
                    <li>
                      <a class="<?php if($page_name=="profile"){ ?>active-link<?php }?>" href="<?php echo base_url() ?>admin/profile">
                        <i class="fa fa-user"></i>
                        Profile
                      </a>
                    </li>
                    <li>
                      <a class="<?php if($page_name=="settings"){ ?>active-link<?php }?>" href="<?php echo base_url() ?>admin/settings">
                        <i class="fa fa-cog"></i>
                        Settings
                      </a>
                    </li>
                    <li>
                      <a href="<?php echo base_url()?>logout">
                        <i class="fa fa-sign-out"></i>
                        Log Out
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
            <!-- main side nav start -->
            <nav class="mainmenu_side_wrapper">
              <!-- <h3 class="dark_bg_color">Dashboard</h3> -->
              <ul class="menu-click">
                <li class="<?php if ($page_name=="dashboard"){?>active-submenu<?php }?>">
                  <a class="<?php if($page_name=="dashboard"){ ?>active-link<?php }?>" href="<?php echo base_url()?>admin/dashboard">
                    <i class="fa fa-th-large"></i>
                    Dashboard
                  </a>

                </li>
              </ul>

              <!-- <h3 class="dark_bg_color">Pages</h3> -->
              <ul class="menu-click">
                <!-- <li class="">
                  <a href="#">
                    <i class="fa fa-file-text"></i>
                    Disposes
                  </a>
                  <ul>
                    <li>
                      <a href="admin_posts.html">
                        Disposable Gadgets
                      </a>
                    </li>
                    <li>
                      <a href="admin_post.html">
                        Single Post
                      </a>
                    </li>
                  </ul>
                </li> -->
                <li class="<?php if ($page_name=="gadgets"){?>active-submenu<?php }?>">
                  <a class="<?php if($page_name=="gadgets"){ ?>active-link<?php }?>" href="<?php echo base_url()?>admin/gadgets">
                    <i class="rt-icon2-tv"></i>
                    Gadgets
                  </a>
                </li>
                <li class="<?php if ($page_name=="disposes"){?>active-submenu<?php }?>">
                  <a class="<?php if($page_name=="disposes"){ ?>active-link<?php }?>" href="<?php echo base_url()?>admin/disposes">
                    <i class="rt-icon2-cup"></i>
                    Disposes
                  </a>
                </li>
              </ul>
              <ul class="menu-click">
                <li class="<?php if ($page_name=="clients"){?>active-submenu<?php }?>">
                  <a class="<?php if($page_name=="clients"){ ?>active-link<?php }?>" href="<?php echo base_url()?>admin/clients">
                    <i class="fa fa-users"></i>
                    Clients
                  </a>

                </li>
              </ul>
                
                <?php }else{ ?>

                    <div class="media-body media-middle">
                        <h4><?Php echo ucwords($name); ?></h4>
                        <?Php echo ucwords($role); ?>

                      </div>

                    </div>
                  </a>
                  <ul class="dark_bg_color">
                    <li class="<?php if($page_name=="profile"){ ?>active-submenu<?php }?>">
                      <a class="<?php if($page_name=="profile"){ ?>active-link<?php }?>" href="<?php echo base_url() ?>client/profile">
                        <i class="fa fa-user"></i>
                        Profile
                      </a>
                    </li>
                    <li>
                      <a href="<?php echo base_url()?>logout">
                        <i class="fa fa-sign-out"></i>
                        Log Out
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
            <!-- main side nav start -->
            <nav class="mainmenu_side_wrapper">
              <!-- <h3 class="dark_bg_color">Dashboard</h3> -->
              <ul class="menu-click">
                <li class="<?php if($page_name=="dashboard"){ ?>active-submenu<?php }?>">
                  <a class="<?php if($page_name=="dashboard"){ ?>active-link<?php }?>" href="<?php echo base_url()?>client/dashboard">
                    <i class="fa fa-th-large"></i>
                    Dashboard
                  </a>

                </li>
                <li class="<?php if($page_name=="gadgets"){ ?>active-submenu<?php }?>">
                  <a class="<?php if($page_name=="gadgets"){ ?>active-link<?php }?>" href="<?php echo base_url()?>client/gadgets">
                    <i class="rt-icon2-tv"></i>
                    Gadgets
                  </a>

                </li>
              </ul>

              <!-- <h3 class="dark_bg_color">Pages</h3> -->
              <ul class="menu-click">
                <li class="<?php if($page_name=="new" || $page_name=="disposed" || $page_name=="view-dispose"){ ?>active-submenu<?php }?>">
                  <a href="<?php echo base_url()?>client/disposes/new">
                    <i class="fa fa-file-text"></i>
                    Disposes
                  </a>
                  <ul>
                    <li>
                      <a class="<?php if($page_name=="new"){ ?>active-link<?php }?>" href="<?php echo base_url()?>client/disposes/new">
                        <i class="fa fa- fa-angle-double-right"></i> New
                      </a>
                    </li>
                    <li>
                      <a class="<?php if($page_name=="disposed"){ ?>active-link<?php }?>" href="<?php echo base_url()?>client/disposes/all">
                        <i class="fa fa- fa-angle-double-right"></i> All
                      </a>
                    </li>

                  </ul>
                </li>
              </ul>
                    
                <?php } ?>   
            </nav>
            <!-- eof main side nav -->

            <!-- <div class="with_padding grey text-center">
              10GB of
              <strong>250GB</strong> Free
            </div> -->

          </div>
        </div>
      </header>

      <?php include "top_bar.php"?>
      <?php include "breadcrumb.php"?>
      

      <section class="ls section_padding_top_50 section_padding_bottom_50 columns_padding_10">
        <div class="container-fluid">

          <?php include "header.php" ?>

          <?php include 'backend/'.$role.'/'.$page_name.'.php';?>

        </div>
        <!-- .container -->
      </section>

      <?php include "footer.php" ?>

    </div>
    <!-- eof #box_wrapper -->
  </div>
  <!-- eof #canvas -->
  <?php include "modal.php";?>
  <?php include "includes_bottom.php"?>
</body>

</html>
