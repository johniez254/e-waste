<?php foreach($getClient->result() as $row):
    $client_id=$row->login_id;
    $names=$row->name;
    $email=$row->email;
    endforeach;
    $phone=$this->db->get_where('profiles' , array('login_id'=>$id))->row()->phone;
    $address=$this->db->get_where('profiles' , array('login_id'=>$id))->row()->address;

?>
<div class="row">
	<!-- <div class="col-md-8"> -->
	<div class="col-md-12">

		<!-- <h4>Tabs</h4> -->

		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li class="active"><a href="#tab1" role="tab" data-toggle="tab"><i class="fa fa-plus"></i> Add New Dispose</a></li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content tab-custom top-color-border">
			<div class="tab-pane fade in active" id="tab1">
				<div class="row">
					<div class="col-xs-12 col-md-12">
				      <!-- <div class="with_border with_padding"> -->
				      	<!-- <h4 class="divider_40">Registered disposable gadgets</h4> -->
				      	<div class="success-messages"></div>
				      	<form enctype="multipart/form-data" method="post" id="disposeForm" action="<?php echo base_url()?>client/disposes_crud/add">
				      		<input type="hidden" name="base_url" value="<?php echo base_url() ?>" id="base_url">
				      		<div class="row">
				      			<div class="col-xs-6 col-md-4">
				      				<div class="form-group">
					      				<label><b>Name</b></label>
					      				<input type="text" name="name" value="<?php echo ucwords($name) ?>" id="name" class="form-control" autocomplete="off" placeholder="Name">
					      			</div>
				      			</div>
				      			<div class="col-xs-6 col-md-4">
				      				<div class="form-group">
					      				<label><b>Email</b></label>
					      				<input type="text" name="email" value="<?php echo $email ?>" id="email" class="form-control" readonly placeholder="Email">
					      			</div>
				      			</div>

					      		<div class="col-xs-6 col-md-4">
					      			<!-- <div class="input-group">
                                        <span class="input-group-addon" style="border:none;"><b>+254</b></span>
                                        <input type="text" class="form-control" placeholder="Username">
                                    </div> -->
				      				<div class="form-group">
					      				<label><b>Phone Number</b></label>
					      				<!-- <input type="text" name="phone" value="<?php echo $phone ?>" id="phone" class="form-control" placeholder="Phone Number" autocomplete="off"> -->
					      				<div class="input-group">
                                        <span class="input-group-addon" style="border:none;"><b>+254</b></span>
                                        <input type="number" class="form-control" placeholder="7XXXXXXXX" name="phone" value="<?php echo $phone ?>" id="phone">
                                    </div>
					      			</div>
				      			</div>
				      		</div>
				      		<div class="row">
				      			<div class="col-xs-6 col-md-4">
				      				<div class="form-group">
					      				<label><b>Location Address</b></label>
					      				<input type="text" name="address" value="<?php echo $address ?>" id="address" autocomplete="off" class="form-control" placeholder="Address">
					      			</div>
				      			</div>
				      			<div class="col-xs-6 col-md-4">
				      				<div class="form-group">
					      				<label><b>Who are You</b></label>
					      				<select name="who" class="form-control" id="who">
					      					<option value="" selected>Select Option</option>
					      					<option value="1">Individual</option>
					      					<option value="2">Business</option>
					      				</select>
					      			</div>
				      			</div>
				      			<div class="col-xs-6 col-md-4">
				      				<div class="form-group">
				      				<div class="form-group">
					      				<label><b>Date to be Collected</b></label>
					      				<input type="date" class="form-control" name="collectDate" id="collectDate">
					      			</div>
				      			</div>
				      		</div>
				      		<div class="row">
				      			<div class="col-xs-6 col-md-4">
				      				<label><b>Add Image</b></label>
				      				<input type="file" name="userfile" value="" id="userfile" class="form-control" placeholder="image">
				      			</div>
				      			<div class="col-xs-6 col-md-8">
				      				<div class="form-group">
					      				<label><b>Gadget Descriptions</b></label>
					      				<textarea name="description" placeholder="Add e-waste descripion here" rows="1" class="form-control" id="description"></textarea>
					      			</div>
				      			</div>

				      			<div class="col-xs-12 col-md-12">
				      				<div class="table-responsive">
						      			<table class="table table-condensed" id="disposeTable">
										  	<thead>
										  		<tr>
							                    	<th>No.</th>			  			
										  			<th>Gadget Type</th>
										  			<th>Price (Ksh)</th>
										  			<th>Quantity</th>
										  			<th>Total (Ksh)</th>			  			
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
											  					<select name="gadgetType[]" title="Select Gadget" id="gadgetType<?php echo $x; ?>" onChange="getGadgetPrice(<?php echo $x; ?>)" class="form-control">
											  						<option value="" selected="">Select Gadget</option>
											  						<?php
													  					foreach($gadgetsQuery as $row):
													  						$gadget_id=$row['gadget_id'];
													  						$gadget_name=$row['gadget_name'];
											  						?>
												  						 <option value="<?php echo $gadget_id; ?>">
												  						 	<?php echo $gadget_name; ?>
												  						 </option>
												  					<?php 
													  					endforeach;
												  					?>
										  						</select>
										  					</div>
										  				</td>			  				
										  				<td>
										  					<div class="form-group">
																<input type="text" name="gadgetPrice[]" autocomplete="off" class="form-control" disabled readonly placeholder="Gadget Price" id="gadgetPrice<?php echo $x; ?>">
																<input type="hidden" name="gadgetPriceValue[]" id="gadgetPriceValue<?php echo $x; ?>" autocomplete="off"/>
										  					</div>
										  				</td>		  				
										  				<td>
										  					<div class="form-group">
																<input type="number" name="gadgetQuantity[]" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" placeholder="Add Quantity" id="gadgetQuantity<?php echo $x; ?>">
																<input type="hidden" name="gadgetQuantityValue" value="" id="gadgetQuantityValue<?php echo $x;?>" />
										  					</div>
										  				</td>
										  				<td>
										  					<div class="form-group">
																<input type="number" name="totalPrice[]" autocomplete="off" class="form-control" disabled readonly placeholder="total price"id="totalPrice<?php echo $x; ?>">
																<input type="hidden" name="totalPriceValue[]" id="totalPriceValue<?php echo $x; ?>" />
										  					</div>		  					
										  				</td>
										  				<td>
										  					<button class="btn btn-danger  removeDisposeRowBtn" type="button" id="removeDisposeRowBtn" onclick="removeDisposeRow(<?php echo $x; ?>)"data-toggle="tooltip" data-placement="top" title="Delete Row"><i class="fa fa-trash-o"></i></button>
										  				</td>
										  			</tr>
									  			<?php
											  			$arrayNumber++;
											  		} // /for
										  		?>
										  	</tbody>			  	
										  </table>
									  <!--end dispose table-->
									  </div>
									  <!-- table-responsive -->
									</div>
								</div>

								  <div class="row">
								  	<div class="col-sm-7">
								  		<button type="button" class="btn btn-primary text-right" onclick="addDisposeRow()" id="addDisposeRowBtn" data-loading-text="Adding..."> <i class="fa fa-plus-circle"></i> Add Row </button>
								  	</div>
								  	<div class="col-sm-4 form-horizontal">
								  		<div class="form-group">
										<label for="finalTotal" class="col-sm-2 control-label"><b>Total:</b></label>
											<div class="col-sm-10">
												<input  
													style="font-size: 17px; font-weight: bold;" 
													type="number" 
													name="finalTotal" 
													class="form-control"
													disabled="disabled" 
													id="finalTotal" 
													placeholder="Total Payable"
												/>
												<input type="hidden" name="finalTotalValue" id="finalTotalValue">
											</div>
									  	</div>									  	
								  	</div>
								  	<div class="col-sm-1"></div>
								  </div>
								  
								  <div class="row" id="taskButtons">
								  	<div class="col-sm-12">
								  		<button type="submit" onclick="validateDisposeForm()" id="createDisposeBtn" data-loading-text="Adding..." class="btn btn-success"><i class="fa fa-plus-circle"></i> Dispose Gadgets</button>
								  		<button type="reset" onclick="resetDisposeForm()" class="btn btn-warning"><i class="fa fa-eraser"></i> Reset</button>
								  	</div>
								  </div>
				      	</form>
				        
				      <!-- </div> -->
				      <!-- .with_border -->
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