<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
    <title>404 error</title>
    <meta charset="utf-8">
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <?php echo link_tag('components/assets/css/bootstrap.min.css');?>
    <?php echo link_tag('components/assets/css/animations.css');?>
    <?php echo link_tag('components/assets/css/fonts.css');?>
    <?php echo link_tag('components/assets/css/main.css" class="color-switcher-link');?>
    <script src="<?php echo base_url(); ?>components/assets/js/vendor/modernizr-2.6.2.min.js"></script>

    <!--[if lt IE 9]>
        <script src="<?php echo base_url(); ?>components/assets/js/vendor/html5shiv.min.js"></script>
        <script src="<?php echo base_url(); ?>components/assets/js/vendor/respond.min.js"></script>
        <script src="<?php echo base_url(); ?>components/assets/js/vendor/jquery-1.12.4.min.js"></script>
    <![endif]-->

</head>

<body>
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

            <section class="ls section_padding_75">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <p class="not_found">
                                <span class="abril">404</span>
                            </p>
                            <h2 class="text-uppercase">Oops, page not found!</h2>
                            <p><b>url:</b> <?php echo base_url(uri_string()); ?></p>
                            <div class="widget widget_search">
                                <p class="lead">The page you've requested could not be found on the server. Please <a href="Mailto:johnsonmatoke@gmail.com"><B class="text text-blue">contact your webmaster</B></a>, or use the back button <strong>(<i class="fa fa-arrow-left"></i>)</strong> in your browser to navigate back to your most recent active page.</p>
                            </div>
                            <p class="divider_20">
                    Or<br>
                </p>
                            <p>
                    <a href="<?php echo base_url() ?>" class="theme_button color1 wide_button">Go To Home</a>
                </p>
                        </div>
                    </div>
                </div>
            </section>

            

        </div>
        <!-- eof #box_wrapper -->
    </div>
    <!-- eof #canvas -->

    <script src="<?php echo base_url(); ?>components/assets/js/compressed.js"></script>
    <script src="<?php echo base_url(); ?>components/assets/js/main.js"></script>
    <!-- <script src="<?php echo base_url(); ?>components/assets/js/switcher.js"></script> -->

</body>
</html>