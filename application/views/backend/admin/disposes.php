<div class="row">
	<!-- <div class="col-md-8"> -->
	<div class="col-md-12">

		<!-- <h4>Tabs</h4> -->

		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li class="active"><a href="#tab1" role="tab" data-toggle="tab"><i class="rt-icon2-microwave"></i> All Disposes</a></li>
			<li><a href="#tab2" role="tab" data-toggle="tab"><i class="rt-icon2-tick"></i> Approved Disposes</a></li>
			<li><a href="#tab3" role="tab" data-toggle="tab"><i class="rt-icon2-watch"></i> Pending Disposes</a></li>
			<!-- <li><a href="#tab4" role="tab" data-toggle="tab"><i class="rt-icon2-close"></i> Rejected</a></li> -->
		</ul>

		<!-- Tab panes -->
		<div class="tab-content tab-custom top-color-border">
			<div class="tab-pane fade in active" id="tab1">
				<div class="row">
					<div class="col-xs-12 col-md-12">
						<h4>All E-waste Disposes</h4>
						<?php if($this->session->flashdata('pay_message')){ ?>
							 <div class="alert alert-success alert-dismissible" role="alert">
							 	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							 		<span aria-hidden="true">&times;</span></button>
							 		<?php echo $this->session->flashdata('pay_message'); ?>
							 	</div>
					    <?php } ?>
						<?php if($this->session->flashdata('collected_message')){ ?>
							 <div class="alert alert-success alert-dismissible" role="alert">
							 	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							 		<span aria-hidden="true">&times;</span></button>
							 		<?php echo $this->session->flashdata('collected_message'); ?>
							 	</div>
					    <?php } ?>
						<?php if($this->session->flashdata('delete_message')){ ?>
							 <div class="alert alert-success alert-dismissible" role="alert">
							 	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							 		<span aria-hidden="true">&times;</span></button>
							 		<?php echo $this->session->flashdata('delete_message'); ?>
							 	</div>
					    <?php }?>
						<hr>
						<div class="table-responsive">
							<table class="table table-hover" id="example23">
								<thead>
									<tr>
										<th>#</th>
										<th>Dispose_id</th>
										<th>Summary</th>
										<th>Collection Date</th>
										<th>Payment</th>
										<th>Stage</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$i=1;
										foreach($getAdminDispose as $row):
										    $transaction_id=$row['transaction_id'];
										    $transaction_code=$row['transaction_code'];
										    $payment_status=$row['payment_status'];
										    $transaction_status=$row['transaction_status'];
										    $transaction_total=$row['transaction_total'];
										    $collection_date=$row['collection_date'];
										    $name=$row['name'];
										    $phone=$row['phone'];
									?>
									<tr>
										<td>
											<?php echo$i++;?>.</td>
										<td>
											<a href="<?php echo base_url()?>client/disposes/view/<?php echo $transaction_code ?>"><b><?php echo $transaction_code; ?></b></a>
										</td>
										<td class="">
											<b>Client:</b> <?php echo ucwords($name)?><br>
											<b>Phone:</b> <?php echo $phone ?><br>
											<b>Gadgets:</b> <?php echo $this->qm->disposes('countDisposes',$transaction_id)?>
										</td>
										<td><?php echo date("m/d/Y",$collection_date) ?></td>
										<td>
											<b>Amount (Ksh):</b> <?php echo $this->qm->formatMoney($transaction_total,true); ?><br>
											<b>Status:</b>
												<?php if($payment_status==0){ ?>
													<span class="label label-danger"><i class="rt-icon2-close"></i> Unconfirmed</span>
												<?php }else{?>
													<span class="label label-success"><i class="rt-icon2-check"></i> Paid</span>
												<?php }?>
										</td>
										<td>
												<?php if($transaction_status==0){ ?>
													<span class="label label-warning"><i class="fa fa-check-circle-o"></i> Pending</span>
												<?php }elseif($transaction_status==1){?>
													<span class="label label-info"><i class="fa fa-check-circle-o"></i> Scheduled</span>
												<?php }else{?>
													<span class="label label-default"><i class="fa fa-check"></i> Collected</span>
												<?php }?>
										</td>
										<td>
	                                        <div class="btn-group">
	                                            <div class="dropdown">
	                                            	<button class="btn btn-primary btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
	                                                    Action
	                                                    <span class="caret"></span>
	                                                </button>
	                                                <?php if($payment_status==0 && $transaction_status==0){ ?>
	                                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
	                                                    <li role="presentation">
	                                                        <a role="menuitem" tabindex="-1" href="<?php echo base_url();?>admin/disposes/view/<?php echo $transaction_code ?>">
	                                                            <i class="fa fa-angle-double-right"></i> View More
	                                                        </a>
	                                                    </li>
	                                                    <li role="presentation">
	                                                        <a role="menuitem" tabindex="-1" href="#" onclick="showPaidModal('<?php echo base_url();?>admin/disposes_crud/markPaid/<?php echo $transaction_code;?>')">
	                                                            <i class="fa fa-angle-double-right"></i> Mark Paid?
	                                                        </a>
	                                                    </li>
	                                                    <li role="presentation">
	                                                        <a role="menuitem" tabindex="-1" href="#" onclick="confirm_modal('<?php echo base_url();?>admin/disposes_crud/delete/<?php echo $transaction_code;?>')">
	                                                            <i class="fa fa-angle-double-right"></i> Delete?
	                                                        </a>
	                                                    </li>
	                                                	<?php }else{?>
	                                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
	                                                    <li role="presentation">
	                                                        <a role="menuitem" tabindex="-1" href="<?php echo base_url();?>admin/disposes/view/<?php echo $transaction_code ?>">
	                                                            <i class="fa fa-angle-double-right"></i> View More
	                                                        </a>
	                                                    </li>
	                                                    <?php if($transaction_status==1){ ?>
	                                                    <li role="presentation">
	                                                        <a role="menuitem" tabindex="-1" href="#" onclick="showCollectModal('<?php echo base_url();?>admin/disposes_crud/markCollected/<?php echo $transaction_code;?>')">
	                                                            <i class="fa fa-angle-double-right"></i> Mark Collected?
	                                                        </a>
	                                                    </li>
	                                                <?php }?>
	                                                    <li role="presentation">
	                                                        <a role="menuitem" tabindex="-1" href="#" onclick="confirm_modal('<?php echo base_url();?>admin/disposes_crud/delete/<?php echo $transaction_code;?>')">
	                                                            <i class="fa fa-angle-double-right"></i> Delete?
	                                                        </a>
	                                                    </li>
	                                                	<?php }?>
	                                                </ul>
	                                            </div>
	                                        </div>
	                                        <!-- /btn-group -->
										</td>
									</tr>
									<?php endforeach;?>
								</tbody>
							</table>
						</div>
						<!-- .table-responsive -->
				    </div>
				    <!-- .col-* -->
				</div>
				<!-- .row-* -->
			</div>
			<!-- tab 1 -->
			<div class="tab-pane" id="tab2">
				<?php include "include_approved.php" ?>
			</div>
			<!-- #tab2 -->
			<div class="tab-pane" id="tab3">
				<?php include "include_pending.php" ?>
			</div>
			<!-- #tab3 -->
			<!-- <div class="tab-pane" id="tab4">
				#tab4
			</div> -->
			<!-- #tab4 -->
		</div>
		<!-- .tab-content-* -->
	</div>
	<!-- .col-* -->
</div>
<!-- .row-* -->