<?php
$user_id= $this->session->userdata('id');
$role=$this->db->get_where('login' , array('login_id'=>$user_id))->row()->role;
?>
<div class="row">
  <div class="col-md-4">
    <h3 class="dashboard-page-title"><?php echo ucwords($page_title)?>
      <!-- <small>main page</small> -->
    </h3>
  </div>
  <?php if($page_name=="dashboard"){?>
  	<?php if($role=="admin"){?>
	  <div class="col-md-8 text-md-right">
			<h3 class="sparklines-title">
				<sup>Approved Total Earnings:</sup>
				Ksh <?php echo substr($this->qm->formatMoney($approved_earnings,true), 0, -3)?>

			</h3>

			<h3 class="sparklines-title">
				<sup>Pending Total Earnings: </sup>
				Ksh <?php echo substr($this->qm->formatMoney($pending_earnings,true), 0, -3)?>
			</h3>

		</div>
	<?php }else{}?>
  <?php }?>
</div>
          <!-- .row -->