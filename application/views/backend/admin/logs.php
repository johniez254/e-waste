<div class="row">
	<!-- <div class="col-md-8"> -->
		<div class="col-md-12">

			<!-- <h4>Tabs</h4> -->

			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li class="active"><a href="#tab1" role="tab" data-toggle="tab"><i class="fa fa-users"></i> All System Logs</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content tab-custom top-color-border">
				<div class="tab-pane fade in active" id="tab1">
					<div class="row">
						<div class="col-xs-12 col-md-12">
					      <!-- <div class="with_border with_padding"> -->
					      	<h4>All Logs (<?php echo $countLogs ?>)</h4>
						    <hr>
					       <div class="table-responsive">
						       	<table class="table table-hover" id="example23">
									<thead>
										<tr>
											<th>#</th>
											<th>Message</th>
											<th>Date and Time</th>
											<th>Trigger user</th>
										</tr>
									</thead>
									<tbody>

						               <?php
							               $i=1;
							               foreach($getLogs as $row):
							                $message=$row['message'];
							                $trigger_date=$row['trigger_date'];
							                $priority=$row['priority'];
							                $user_id=$row['user_id'];
						                ?>
										<tr>
											<td><?php echo $i++; ?>.</td>
											<td><?php echo ucwords($message); ?></td>
											<td><?php echo 'On <small><b>'.date('D, d/M/Y',$trigger_date).'</b> at <b>'.date('h:i:a',$trigger_date) ?></td>
											<td>
												<?php if($user_id==1 || $priority!=2){?>
													<span class="label label-info"><i class="fa fa-user"></i> Admin</span>
												<?php }else{?>
													<span class="label label-warning"><i class="fa fa-user"></i> Client</span>
												<?php }?>
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
					       </div>
					      <!-- .table responsive -->
					    </div>
					    <!-- .col-* -->
					</div>
					<!-- .row-* -->
				</div>
			</div>

		</div>
		<!-- .with_border -->

	<!-- </div> -->

</div>
<!-- .row -->