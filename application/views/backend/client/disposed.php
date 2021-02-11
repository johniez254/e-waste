<div class="row">
	<!-- <div class="col-md-8"> -->
	<div class="col-md-12">

		<!-- <h4>Tabs</h4> -->

		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li class="active"><a href="#tab1" role="tab" data-toggle="tab"><i class="rt-icon2-microwave"></i> All My Disposes</a></li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content tab-custom top-color-border">
			<div class="tab-pane fade in active" id="tab1">
				<div class="row">
					<div class="col-xs-12 col-md-12">
						<div class="table-responsive">
							<table class="table table-hover" id="example23">
								<thead>
									<tr>
										<th>#</th>
										<th>Dispose_id</th>
										<th>Gadgets</th>
										<th>Collection Date</th>
										<th>Payment</th>
										<th>Stage</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$i=1;
										foreach($getDispose as $row):
										    $transaction_id=$row['transaction_id'];
										    $transaction_code=$row['transaction_code'];
										    $payment_status=$row['payment_status'];
										    $transaction_status=$row['transaction_status'];
										    $transaction_total=$row['transaction_total'];
										    $collection_date=$row['collection_date'];
									?>
									<tr>
										<td>
											<?php echo$i++;?>.</td>
										<td>
											<a href="<?php echo base_url()?>client/disposes/view/<?php echo $transaction_code ?>"><b><?php echo $transaction_code; ?></b></a>
										</td>
										<td class="text-right"><?php echo $this->qm->disposes('countDisposes',$transaction_id)?></td>
										<td><?php echo date("m/d/Y",$collection_date) ?></td>
										<td>
											<b>Amount (Ksh):</b> <?php echo $this->qm->formatMoney($transaction_total,true); ?><br>
											<b>Status:</b>
												<?php if($payment_status==0){ ?>
													<span class="label label-danger"><i class="rt-icon2-close"></i> Unconfirmed</span>
												<?php }else{?>
													<span class="label label-success"><i class="rt-icon2-check"></i> Approved</span>
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
											<a class="btn btn-info" style="color: #fff;" href="<?php echo base_url()?>client/disposes/view/<?php echo $transaction_code ?>">View</a>
										</td>
									</tr>
									<?php endforeach;?>
								</tbody>
							</table>
						</div>
						<!-- table-responsive -->
				    </div>
				    <!-- .col-* -->
				</div>
				<!-- .row-* -->
			</div>
		</div>
		<!-- .tab-content-* -->
	</div>
	<!-- .col-* -->
</div>
<!-- .row-* -->