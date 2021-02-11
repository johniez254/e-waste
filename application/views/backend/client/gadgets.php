<div class="row">
	<!-- <div class="col-md-8"> -->
		<div class="col-md-12">

			<!-- <h4>Tabs</h4> -->

			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li class="active"><a href="#tab1" role="tab" data-toggle="tab"><i class="fa fa-users"></i> Disposable gadgets</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content tab-custom top-color-border">
				<div class="tab-pane fade in active" id="tab1">
					<div class="row">
						<div class="col-xs-12 col-md-12">
					      <!-- <div class="with_border with_padding"> -->
					      	<h4>Registered disposable gadgets (<?php echo $totalGadgets ?>)</h4>
						    <hr>
					       <div class="table-responsive">
						       	<table class="table table-hover" id="example23">
									<thead>
										<tr>
											<th>#</th>
											<th>Gadget</th>
											<th>Price(Ksh)</th>
										</tr>
									</thead>
									<tbody>

						               <?php
							               $i=1;
							               foreach($gadgetsQuery as $row):
							                $g_name=$row['gadget_name'];
							                $g_price=$row['gadget_price'];
							                $g_id=$row['gadget_id'];
						                ?>
										<tr>
											<td><?php echo $i++; ?>.</td>
											<td><?php echo ucwords($g_name); ?></td>
											<td><?php echo $g_price; ?></td>
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