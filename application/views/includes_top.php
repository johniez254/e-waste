    <meta charset="utf-8">
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="<?php echo base_url()?>components/assets/images/favicon.png">
    <?php echo link_tag('components/assets/css/bootstrap.min.css')?>
    <?php echo link_tag('components/assets/css/animations.css')?>
    <?php echo link_tag('components/assets/css/fonts.css')?>
    <?php echo link_tag('components/assets/css/main.css" class="color-switcher-link')?>
    <?php echo link_tag('components/assets/css/datatables/datatable.css')?>

    <script src="<?php echo base_url()?>components/assets/js/vendor/modernizr-2.6.2.min.js"></script>

    <?php 
        //get total segments
        $total_segments = $this->uri->total_segments();
        //$last_segment = $this->uri->segment($total_segments);
        if($total_segments>=2){
            echo link_tag('components/assets/css/dashboard.css" class="color-switcher-link');
        }else{}?>

    <!--[if lt IE 9]>
        <script src="<?php echo base_url()?>components/assets/js/vendor/html5shiv.min.js"></script>
        <script src="<?php echo base_url()?>components/assets/js/vendor/respond.min.js"></script>
        <script src="<?php echo base_url()?>components/assets/js/vendor/jquery-1.12.4.min.js"></script>
    <![endif]-->


        
        
		