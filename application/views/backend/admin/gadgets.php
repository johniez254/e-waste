<div class="row">
	<!-- <div class="col-md-8"> -->
		<div class="col-md-12">

			<!-- <h4>Tabs</h4> -->

			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li class="active"><a href="#tab1" role="tab" data-toggle="tab"><i class="fa fa-users"></i> Disposable gadgets</a></li>
				<li><a href="#tab2" role="tab" data-toggle="tab"><i class="fa fa-plus"></i> Add New Disposable gadgets</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content tab-custom top-color-border">
				<div class="tab-pane fade in active" id="tab1">
					<div class="row">
						<div class="col-xs-12 col-md-12">
					      <!-- <div class="with_border with_padding"> -->
					      	<h4>Registered disposable gadgets (<?php echo $totalGadgets ?>)</h4>
					        
							<?php if($this->session->flashdata('gadget_message')){ ?>
								 <div class="alert alert-success alert-dismissible" role="alert">
								 	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								 		<span aria-hidden="true">&times;</span></button>
								 		<?php echo $this->session->flashdata('gadget_message'); ?>
								 	</div>
						    <?php } ?>
						    <div class="table-responsive">
						        <table class="table table-hover" id="approved">
									<thead>
										<tr>
											<th>#</th>
											<th>Gadget</th>
											<th>Price(Ksh)</th>
											<th>Action</th>
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
											<td>
												<button href="#" onclick="showAjaxModal('<?php echo base_url();?>admin/gadgets_crud/edit/<?php echo $g_id;?>')"  class="btn btn-primary btn-xs">
						                            <i class="fa fa-edit"></i>
						                        </button>
												<button href="#" onclick="confirm_modal('<?php echo base_url();?>admin/gadgets_crud/delete/<?php echo $g_id;?>')" class="btn btn-danger">
						                            <i class="fa fa-trash"></i>
						                        </button>
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
				<div class="tab-pane fade" id="tab2">
			      	<h4 class="divider_40">Add New Disposable Gadget</h4>
			      	<div class="messages"></div>
					<form method="post" action="<?php echo base_url().'admin/gadgets_crud/add' ?>" id="gadgetForm">
						<div id="check"></div>
						<input type="hidden" name="base_url" value="<?php echo base_url() ?>" id="base_url">                          
					  <table class="table table-green table-responsive" id="gadgetsTable">
					  	<thead>
					  		<tr>
		                    	<th>No.</th>			  			
					  			<th>Gadget Name</th>
					  			<!-- <th>Unit</th> -->
					  			<th>Price</th>			  			
					  			<th>Delete</th>
					  		</tr>
					  	</thead>
					  	<tbody>
					  		<?php
					  		$arrayNumber = 0;
					  		for($x = 1; $x < 2; $x++) { ?>
					  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">
		                        	<td>
		                        		<?php echo $x ?>.
		                            </td>			  				
					  				<td>
					  					<div class="form-group">
											<input type="text" name="gadgetName[]" autocomplete="off" class="form-control" placeholder="Gadget Name" id="gadgetName<?php echo $x; ?>">
					  					</div>
					  				</td>
					  				<td>
					  					<div class="form-group">
											<input type="number" name="gadgetPrice[]" autocomplete="off" class="form-control" min="1" placeholder="price in ksh"id="gadgetPrice<?php echo $x; ?>">
					  					</div>		  					
					  				</td>
					  				<!-- <td>
					  					<div class="form-group">
					  					<input type="text" name="quantity[]" required autocomplete="off" class="form-control" placeholder="e.g (1,2,3 XL,L) " />
					  					</div>
					  				</td> -->
					  				<td>
					  					<button class="btn btn-danger  removeGadgetRowBtn" type="button" id="removeGadgetRowBtn" onclick="removeGadgetRow(<?php echo $x; ?>)"data-toggle="tooltip" data-placement="top" title="Delete Row"><i class="fa fa-trash-o"></i></button>
					  				</td>
					  			</tr>
				  			<?php
						  			$arrayNumber++;
						  		} // /for
					  		?>
					  	</tbody>			  	
					  </table>
					  <!--end gadget table-->
					  <br>
					  <div class="row" id="taskButtons">
					  	<div class="col-sm-10">
					  		<button type="submit" onclick="validateGadgetForm()" id="createGadgetBtn" data-loading-text="Adding..." class="btn btn-success"><i class="fa fa-plus-circle"></i> Add Gadgets</button>
					  		<button type="reset" onclick="resetGadgetForm()" class="btn btn-warning"><i class="fa fa-eraser"></i> Reset</button>
					  	</div>
					  	<div class="col-sm-2">
					  		<button type="button" class="btn btn-primary text-right" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fa fa-plus-circle"></i> Add Row </button>
					  	</div>
					  </div>
                  </form>
				</div>
			</div>

		</div>
		<!-- .with_border -->

	<!-- </div> -->

</div>
<!-- .row -->