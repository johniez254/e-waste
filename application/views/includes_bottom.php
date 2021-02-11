<?php if (
    $page_name=='homepage'
){?>
  <script src="<?php echo base_url(); ?>components/assets/js/compressed.js"></script>
  <script src="<?php echo base_url(); ?>components/assets/js/main.js"></script>
    <!-- <script src="<?php echo base_url(); ?>components/assets//switcher.js"></script> -->
<?php }else{?>

  <script src="<?php echo base_url(); ?>components/assets/js/compressed.js"></script>
  <script src="<?php echo base_url(); ?>components/assets/js/main.js"></script>
    <!-- <script src="<?php echo base_url(); ?>components/assets//switcher.js"></script> -->

<!-- dashboard libs -->

    <!-- events calendar -->
    <script src="<?php echo base_url(); ?>components/assets/js/admin/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>components/assets/js/admin/fullcalendar.min.js"></script>
    <!-- range picker -->
    <script src="<?php echo base_url(); ?>components/assets/js/admin/daterangepicker.js"></script>

    <!-- charts -->
    <script src="<?php echo base_url(); ?>components/assets/js/admin/Chart.bundle.min.js"></script>
    <!-- vector map -->
    <script src="<?php //echo base_url(); ?>components/assets/js/admin/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="<?php //echo base_url(); ?>components/assets/js/admin/jquery-jvectormap-world-mill.js"></script>
    <!-- small charts -->
    <script src="<?php echo base_url(); ?>components/assets/js/admin/jquery.sparkline.min.js"></script>

    <!-- dashboard init -->
    <?php if (
        $page_name=='disposed' || 
        $page_name=='gadgets' || 
        $page_name=='logs' ||  
        $page_name=='clients' ||
        $page_name=='disposes'
    ){?>
    <!-- This is data table -->
    <script src="<?php echo base_url(); ?>components/assets/js/admin/datatables/datatables.min.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="<?php echo base_url(); ?>components/assets/js/admin/datatables/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>components/assets/js/admin/datatables/buttons.flash.min.js"></script>
    <script src="<?php echo base_url(); ?>components/assets/js/admin/datatables/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>components/assets/js/admin/datatables/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>components/assets/js/admin/datatables/vfs_fonts.js"></script>
    <script src="<?php echo base_url(); ?>components/assets/js/admin/datatables/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>components/assets/js/admin/datatables/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
        <?php include "tables.php"?>
    <?php }?>
    <!-- <script src="<?php //echo base_url(); ?>components/assets/js/admin.js"></script> -->

        <?php if ($page_name=='dashboard'){?>
            <?php include "calendar.php"; ?>
        <?php }?>

        <?php if ($page_name=='login'){?>
            <script src="<?php echo base_url(); ?>components/customs/login.js"></script>
        <?php }?>
        <?php if ($page_name=='register'or$page_name=='clients'){?>
            <script src="<?php echo base_url(); ?>components/customs/register.js"></script>
        <?php }?>
        <?php if ($page_name=='profile'){?>
            <script src="<?php echo base_url(); ?>components/customs/profile.js"></script>
        <?php }?>
        <?php if ($page_name=='settings'){?>
            <script src="<?php echo base_url(); ?>components/customs/settings.js"></script>
        <?php }?>
        <?php if ($page_name=='gadgets'){?>
            <script src="<?php echo base_url(); ?>components/customs/gadgets.js"></script>
        <?php }?>
        <?php if ($page_name=='new'){?>
            <script src="<?php echo base_url(); ?>components/customs/new-dispose.js"></script>
        <?php }?>

<?php }?>

<?php 
        //get total segments
        $total_segments = $this->uri->total_segments();
        //$last_segment = $this->uri->segment($total_segments);
        if($total_segments==0){
        ?>
        
        
        <?php }else{?>
        
        
    	<?php }?> 
