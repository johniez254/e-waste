 <?php 

$id		 =	$this->session->userdata('id');
$role       =	$this->db->get_where('login' , array('login_id'=>$id))->row()->role;
?>

<?php if($page_name=="dashboard" || $page_name=="view-dispose" ){ ?>

    <script type="text/javascript">
        //redirect to logs page
        function showLogsUrl(url=null) {
          if(url){
            location.replace(url)

          }
        }
    </script>
<?php }?>
<?php if($page_name=="view-dispose"){ ?>
    <script type="text/javascript">
        function printDiv(print){
            var printContents=document.getElementById(print).innerHTML;
            var originalContents=document.body.innerHTML;
            document.body.innerHTML=printContents;
            window.print() ;
            document.body.innerHTML=originalContents;
        }
    
    </script>
<?php }?>

<?php if($role=="admin"){ ?>
    <script>	
    	function showAjaxModal(url)
    	{
    		// SHOWING AJAX PRELOADER IMAGE
    		//jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="assets/images/preloader.gif" /></div>');
    		
    		// LOADING THE AJAX MODAL
    		
    		jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
    		
    		// SHOW AJAX RESPONSE ON REQUEST SUCCESS
    		$.ajax({
    			url: url,
    			success: function(response)
    			{
    				jQuery('#modal_ajax .modal-body').html(response);	

    			}
    		});
    	}
    </script>
     <!-- modal start -->
    <div class="modal fade" id="modal_ajax" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content"<?php /*?> style="margin-top:100px;"<?php */?>>
                <div class="modal-header" style=" background-color:#54be73;">
                    <button type="button" class="close" style="color:white;" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center; font-weight:bold; color:#fff;"><i class="fa fa-edit"></i> Edit Details</h4>
                </div>
                <div class="modal-body" style="height:470px; overflow:auto;">

                    

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->
                                            
                                            
    <script>
    //responsible for all delete functions
    	
    	function confirm_modal(delete_url)
    	{
    		jQuery('#flexModal').modal('show', {backdrop: 'static'});
    		document.getElementById('delete_link').setAttribute('href' , delete_url);
    		
             $(this).parents(".odd").animate({ backgroundColor: "#fbc7c7" }, "fast")
    		.animate({ opacity: "hide" }, "slow");
    	}
        
        //show paid modal
        function showPaidModal(payment_url)
        {
            jQuery('#paymentModal').modal('show', {backdrop: 'static'});
            document.getElementById('payment_link').setAttribute('href' , payment_url);
            
             $(this).parents(".odd").animate({ backgroundColor: "#fbc7c7" }, "fast")
            .animate({ opacity: "hide" }, "slow");
        }
        
        //show collect modal
        function showCollectModal(collect_url)
        {
            jQuery('#collectModal').modal('show', {backdrop: 'static'});
            document.getElementById('collect_link').setAttribute('href' , collect_url);
            
             $(this).parents(".odd").animate({ backgroundColor: "#fbc7c7" }, "fast")
            .animate({ opacity: "hide" }, "slow");
        }
    	
    </script>
        
        <!-- (Normal Modal)-->
          <div class="modal fade primary" id="flexModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="ultraModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="margin-top:100px;">
                    
                    <div class="modal-header" style=" background-color:#54be73;">
                        <button type="button" style="color:#fff;" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" style="text-align:center; font-weight:bold; color:#fff;">Are you sure to delete this information ?</h4>
                    </div>
                    
                    
                    <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                        <a href="#" class="btn btn-danger" id="delete_link">DELETE</a>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">cancel</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- (Payment Modal)-->
          <div class="modal fade primary" id="paymentModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="ultraModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="margin-top:100px;">
                    
                    <div class="modal-header" style=" background-color:#54be73;">
                        <button type="button" style="color:#fff;" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" style="text-align:center; font-weight:bold; color:#fff;">Mark as Paid? There is no reverse for this action!</h4>
                    </div>
                    
                    
                    <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                        <a href="#" class="btn btn-danger" id="payment_link">MARK PAID</a>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">cancel</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- (Collect Modal)-->
          <div class="modal fade primary" id="collectModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="ultraModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="margin-top:100px;">
                    
                    <div class="modal-header" style=" background-color:#54be73;">
                        <button type="button" style="color:#fff;" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" style="text-align:center; font-weight:bold; color:#fff;">Are you sure you want to Mark as Collected?</h4>
                    </div>
                    
                    
                    <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                        <a href="#" class="btn btn-danger" id="collect_link">MARK COLLECTED</a>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">cancel</button>
                    </div>
                </div>
            </div>
        </div>
    <?php }?>
    

