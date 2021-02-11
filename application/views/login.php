<?php
// $system_name      =	$this->db->get_where('settings' , array('system_id'=>'1'))->row()->system_name;
// $system_abbr     =	$this->db->get_where('settings' , array('system_id'=>'1'))->row()->system_abbr;
?>
 <!DOCTYPE html>
<html class="no-js" lang="eng">

<head>
    <?php include "includes_top.php"?>
    <title>Login</title>
</head>

<body class="admin">
    <!--[if lt IE 9]>
        <div class="bg-danger text-center">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" class="highlight">upgrade your browser</a> to improve your experience.</div>
    <![endif]-->

    <div class="preloader">
        <div class="preloader_image"></div>
    </div>

    <!-- wrappers for visual page editor and boxed version of template -->
    <div id="canvas">
        <div id="box_wrapper">

            <!-- template sections -->
            <section class="ls section_padding_top_100 section_padding_bottom_100 section_full_height">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 to_animate">
                            <div class="with_border with_padding">

                                <h4 class="text-center">
                                    E-Waste Login
                                </h4>
                                <hr class="bottommargin_30">
                                <div class="wrap-forms">
                                    <div id="message"></div>
                                    <?php if($this->session->keep_flashdata('message')){ ?>
                                         <div class="alert alert-info alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                                <?php echo $this->session->keep_flashdata('message'); ?>
                                            </div>
                                    <?php } ?>
                                     <?php $attributes = array("name" => "loginform", 'id'=>'loginform');
                                     echo form_open("login/validate", $attributes);?>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group has-placeholder">
                                                    <label for="login-email">Email address</label>
                                                    <i class="grey fa fa-envelope-o"></i>
                                                    <input type="text" class="form-control" id="email" autofocus placeholder="Email Address" name="email">
                                                    <!-- <span style="color: red; font-size: small;">Require email</span> -->
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group has-placeholder">
                                                    <label for="login-password">Password</label>
                                                    <i class="grey fa fa-pencil-square-o"></i>
                                                    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="checkbox">
                                                    <input type="checkbox" id="remember_me_checkbox">
                                                    <label for="remember_me_checkbox">Remember Me
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="theme_button block_button color1">Log In</button>
                                    </form>
                                </div>
                            </div>
                            <!-- .with_border -->

                            <p class="divider_20 text-center">
                    Not registered? <a href="<?php echo base_url()?>register">Create an account</a>.<br>
                    or go <a href="<?php echo base_url()?>">Home</a>
                </p>

                        </div>
                        <!-- .col-* -->
                    </div>
                    <!-- .row -->
                </div>
                <!-- .container -->
            </section>
        </div>
        <!-- eof #box_wrapper -->
    </div>
    <!-- eof #canvas -->


    <?php include "includes_bottom.php"?>

</body>
</html>



