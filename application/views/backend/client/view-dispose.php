<?php foreach($trans_code->result() as $row):
$transaction_id =$row->transaction_id ;
$transaction_code=$row->transaction_code;
$name=$row->name;
$email=$row->email;
$phone=$row->phone;
$location=$row->location;
$who=$row->who;
$collection_date=$row->collection_date;
$description=$row->description;
$date_created=$row->date_created;
$transaction_total=$row->transaction_total;
$transaction_status=$row->transaction_status;
$payment_status=$row->payment_status;
?>
<?php endforeach;
$oc="transaction_id=".$transaction_id."";
$this->db->select('*');
$this->db->from('disposes');
$this->db->where($oc);
$countGadgets=$this->db->count_all_results();
?>
<div class="row">

	<div class="col-xs-12 col-md-3">

		<div class="row">
			<div class="col-sm-12">
				<div class="panel-group bottommargin_0" id="contact-info-accordion">

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="icon-tab" data-toggle="collapse" data-parent="#contact-info-accordion" href="#user-info-collapse1">
									<i class="highlight fontsize_16 fa fa-phone"></i>
									<b>Overview</b>
								</a>
							</h4>
						</div>
						<div id="user-info-collapse1" class="panel-collapse collapse <?php if($payment_status==1){ ?>in<?php }?>">
							<div class="panel-body">
								<table>
									<tr>
										<td>
											<b>Status:</b>
										</td>
										<td>
											<?php if($payment_status==0 && $transaction_status==0){ ?>
												<span class="label label-warning"><i class="fa fa-check-circle-o"></i> Pending</span>
											<?php }elseif($transaction_status==1){?>
												<span class="label label-primary"><i class="fa fa-clock-o"></i> Scheduled</span>
											<?php }else{?>
												<span class="label label-default"><i class="fa fa-check"></i> Collected</span>
											<?php }?>
										</td>
									</tr>
									<tr>
										<td>
											<b>Payments:</b>
										</td>
										<td>
											<?php if($payment_status==0){ ?>
											<span class="label label-danger"><i class="fa fa-check-circle-o"></i> Unconfirmed</span>
											<?php }else{?>
												<span class="label label-success"><i class="fa fa-check"></i> Approved</span>
											<?php }?>
										</td>
									</tr>
									<tr>
										<td>
											<b>Due:</b>
										</td>
										<td>
											In <b>
													<?php 
														$due=$this->qm->dueDate($collection_date);
														if($due<=0){
															echo "0";
														} else{
															echo substr($due, 1);
														}
													 ?>
												</b> days
										</td>
									</tr>
									<!-- <tr>
										<td>
											<b>Comments:</b>
										</td>
										<td>
											0
										</td>
									</tr> -->
								</table>
							</div>
						</div>
					</div>
					<!-- .panel -->

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="icon-tab collapsed" data-toggle="collapse" data-parent="#contact-info-accordion" href="#user-info-collapse2">
									<i class="highlight fontsize_16 fa fa-money"></i>
									How to Pay
								</a>
							</h4>
						</div>
						<div id="user-info-collapse2" class="panel-collapse collapse <?php if($payment_status==0 && $transaction_status==0){ ?>in<?php }?>">
							<div class="panel-body">
								<!-- <p>
									<strong>Via MPESA</strong>
								</p> -->
								<ol type="1">
									<li>Go to your M-PESA menu and Select ‘<b>Lipa na M-PESA</b>’ then ‘<b>Pay Bill</b>’ option</li>
									<li>Enter Business no. <b>your paybill</b></li>
									<li>Enter <b><?php echo $transaction_code; ?></b> as Account No.</li>
									<li>Enter the Amount KSH <b><?php echo $this->qm->formatMoney($transaction_total,true); ?></b>.</li>
									<li>Enter your M-PESA PIN and Send.</li>
									<li>Input the M-PESA transaction code in the input below and submit to confirm your payments.</li>
									<li><a class="theme_button inverse" href="<?php echo base_url() ?>admin/requestPayment/<?php echo $transaction_code ?>/<?php echo $phone ?>/<?php echo $transaction_total ?>">Click to pay</a></li>
								</ol>
							</div>
						</div>
					</div>
					<!-- .panel -->
				</div>
				<!-- .panel-group -->
			</div>
			<!-- .col-* -->
			<div class="col-sm-12">
				<div class="with_border with_padding">

					<form method="post" action="#">
						<div class="wrap-forms">
							<div class="row">
								<div class="col-xs-12">
									<h4>Confirm Payment</h4>
									<p><b>M-PESA Transaction code:</b></p>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<div class="form-group has-placeholder">
										<label for="form-id-1">Transaction Code
											<sup>*</sup>
										</label>
										<input class="form-control" type="text" name="m-transaction" placeholder="Transaction Code" value="" id="m-transaction" required="required">
									</div>
								</div>
							</div>
							<div class="row"></div>
						</div>
						<div class="wrap-forms">
							<div class="row">
								<div class="col-sm-12">
									<button class="theme_button" type="submit">Confirm</button>
									<!-- <input class="theme_button wide_button color1" type="reset" value="Clear"> -->
								</div>
							</div>
						</div>
					</form>

				</div>
				<!-- .with_padding -->
			</div>
			<!-- .col -->
		</div>
		<!-- .row -->
	</div>
	<!-- .col-* right column -->
	<div class="col-md-9">


		<div class="row">
			<div id="print">
				<!-- User Bio -->
				<div class="col-xs-12 col-sm-12">

					<div class="with_border with_padding">
						<div class="row">
							<div class="col-xs-12 col-sm-12">
								<div class="media big-left-media">
									<div class="media-left">
										<img src="<?php echo $this->qm->get_image_url('logo','logo') ?>" alt="...">
									</div>
									<div class="media-body">
										<div class="row">
											<div class="col-sm-8">
												<h4>Dispose id: #<?php echo $transaction_code ?>
												</h4>
												<p>
													<?php echo $description ?>
												</p>
											</div>
											<div class="col-sm-4">
												<a onclick="showLogsUrl('<?php echo base_url() ?>client/disposes/all')" title="back to all disposes" href="#" class="theme_button inverse"><i class="fa fa-arrow-left"></i></a>
												<a href="#" title="Print" onclick="printDiv('print')" class="theme_button inverse"><i class="fa fa-print"></i></a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-xs-6 col-sm-6">
								<h4>
									Client Info
								</h4>

								<ul class="list1 no-bullets">
									<li>
										<div class="media small-teaser">
											<div class="media-left media-middle">
												<div class="teaser_icon label-default round fontsize_16">
													<i class="fa fa-user"></i>
												</div>
											</div>
											<div class="media-body media-middle">
												<strong class="grey">
													Client:
												</strong>
												<?php echo ucwords($name) ?>
											</div>
										</div>
									</li>
									<li>
										<div class="media small-teaser">
											<div class="media-left media-middle">
												<div class="teaser_icon label-default round fontsize_16">
													<i class="rt-icon2-mail"></i>
												</div>
											</div>
											<div class="media-body media-middle">
												<strong class="grey">
													Email:
												</strong>
												<?php echo $email ?>
											</div>
										</div>
									</li>
									<li>
										<div class="media small-teaser">
											<div class="media-left media-middle">
												<div class="teaser_icon label-default round fontsize_16">
													<i class="rt-icon2-phone6"></i>
												</div>
											</div>
											<div class="media-body media-middle">
												<strong class="grey">
													Phone:
												</strong>
												<?php echo $phone ?>
											</div>
										</div>
									</li>
									<li>
										<div class="media small-teaser">
											<div class="media-left media-middle">
												<div class="teaser_icon label-default round fontsize_16">
													<i class="rt-icon2-users"></i>
												</div>
											</div>
											<div class="media-body media-middle">
												<strong class="grey">
													Category:
												</strong>
												<?php if($who=="1"){ ?>Individual<?php } else{?> Business <?php }?>
											</div>
										</div>
									</li>
									<li>
										<div class="media small-teaser">
											<div class="media-left media-middle">
												<div class="teaser_icon label-default round fontsize_16">
													<i class="rt-icon2-map-pin"></i>
												</div>
											</div>
											<div class="media-body media-middle">
												<strong class="grey">
													Location:
												</strong>
												<?php echo $location ?>
											</div>
										</div>
									</li>
								</ul>
							</div>
							<div class="col-xs-6 col-sm-6">
								<h4>
									Dispose info
								</h4>

								<ul class="list1 no-bullets">
									<li>
										<div class="media small-teaser">
											<div class="media-left media-middle">
												<div class="teaser_icon label-success fontsize_16">
													<i class="rt-icon2-layers"></i>
												</div>
											</div>
											<div class="media-body media-middle">
												<strong class="grey">
													Dispose id:
												</strong>
												<?php echo $transaction_code; ?>
											</div>
										</div>
									</li>
									<li>
										<div class="media small-teaser">
											<div class="media-left media-middle">
												<div class="teaser_icon label-success fontsize_16">
													<i class="rt-icon2-tv2"></i>
												</div>
											</div>
											<div class="media-body media-middle">
												<strong class="grey">
													Total Disposed:
												</strong>
												<?php echo $countGadgets; ?>
											</div>
										</div>
									</li>
									<li>
										<div class="media small-teaser">
											<div class="media-left media-middle">
												<div class="teaser_icon label-info fontsize_16">
													<i class="fa fa-calendar"></i>
												</div>
											</div>
											<div class="media-body media-middle">
												<strong class="grey">
													Creation Date:
												</strong>
												<?php echo date("m/d/Y",$date_created) ?>
											</div>
										</div>
									</li>
									<li>
										<div class="media small-teaser">
											<div class="media-left media-middle">
												<div class="teaser_icon label-success fontsize_16">
													<i class="rt-icon2-truck"></i>
												</div>
											</div>
											<div class="media-body media-middle">
												<strong class="grey">
													Collection Date:
												</strong>
												<?php echo date("m/d/Y",$collection_date) ?>
											</div>
										</div>
									</li>

								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12">
								<table class="table table-striped">
									<thead>
										<tr>
											<th class="text-right">#</th>
											<th class="text-center">Gadget</th>
											<th class="text-right">Price (KSH)</th>
											<th class="text-right">Quantity</th>
											<th class="text-right">Sub Total</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$where="transaction_id=".$transaction_id."";
											$this->db->select('*');
											$this->db->from('disposes');
											$this->db->join('gadgets', 'gadgets.gadget_id = disposes.gadget_id');
											$this->db->where($where);
											$desc	=	$this->db->get()->result_array();
											$i=1;
	                            			foreach($desc as $row):
	                    				?>
										<tr>
											<td class="text-right"><?php echo $i++ ?>.</td>
											<td class="text-center"><?php echo $row['gadget_name'] ?></td>
											<td class="text-right"><?php echo $this->qm->formatMoney($row['gadget_price'],true);  ?></td>
											<td class="text-right"><?php echo $row['quantity']  ?></td>
											<td class="text-right"><?php echo $this->qm->formatMoney($row['gadget_price']*$row['quantity'],true) ?></td>
										</tr>
										<?php endforeach;?>
										<tr>
											<td colspan="4" class="text-right">
												<b>Total Price (KSH)</b>
											</td>
											<td class="text-right"><b><?php echo $this->qm->formatMoney($transaction_total, true); ?></b></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- .with_border -->
				</div>
				<!-- .col-* -->
			</div>
			<!-- print -->
		</div>
		<!-- .row -->
	</div>
	<!-- .col-* right column -->
</div>