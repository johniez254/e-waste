<div class="row">
	<!-- <div class="col-md-8"> -->
		<div class="col-md-12">

			<!-- <h4>Tabs</h4> -->

			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li class="active"><a href="#tab1" role="tab" data-toggle="tab"><i class="fa fa-users"></i> All Registered Clients</a></li>
				<li><a href="#tab2" role="tab" data-toggle="tab"><i class="fa fa-plus"></i> Add New Client</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content tab-custom top-color-border">
				<div class="tab-pane fade in active" id="tab1">
					<div class="row">
						<div class="col-xs-12 col-md-12">
					      <!-- <div class="with_border with_padding"> -->
					      	<h4>Registered Clients (<?php echo $totalClients?>)</h4>
					      	<hr>
					      	<?php if($this->session->flashdata('client_message')){ ?>
								 <div class="alert alert-success alert-dismissible" role="alert">
								 	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								 		<span aria-hidden="true">&times;</span></button>
								 		<?php echo $this->session->flashdata('client_message'); ?>
								 	</div>
						    <?php } ?>
						    <div class="table-responsive">
						        <table class="table  table-hover" id="example23">
									<thead>
										<tr>
											<th>#</th>
											<th>Full Names</th>
											<th>Email</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

						               <?php
							               $i=1;
							               foreach($clientsQuery as $row):
							                $email=$row['email'];
							                $name=$row['name'];
							                $login_id=$row['login_id'];
						                ?>
										<tr>
											<td><?php echo $i++; ?>.</td>
											<td><?php echo ucwords($name); ?></td>
											<td><?php echo $email; ?></td>
											<td>
												<button href="#" onclick="showAjaxModal('<?php echo base_url();?>admin/clients_crud/edit/<?php echo $login_id;?>')"  class="btn btn-primary btn-xs">
						                            <i class="fa fa-edit"></i>
						                        </button>
												<button href="#" onclick="confirm_modal('<?php echo base_url();?>admin/clients_crud/delete/<?php echo $login_id;?>')" class="btn btn-danger">
						                            <i class="fa fa-trash"></i>
						                        </button>
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
						    </div>
					      <!-- .table-responsive -->
					    </div>
					    <!-- .col-* -->
					</div>
					<!-- .row-* -->
				</div>
				<div class="tab-pane fade" id="tab2">
			      	<h4 class="divider_40">Add New Client</h4>
					<?php $attributes = array("name" => "form", 'id' => 'regform');
					echo form_open("admin/clients_crud/add", $attributes);?>
					<div id="message"></div>
					    <div class="form-group">
					        <label><b>Full Names:</b></label>
							<?php 
								$data=array(
								'name'=> 'name',
								'type'=>'text',
								'placeholder'=>'full names',
								'class'=>'form-control',
								'id'=>'name',
								'value'=>set_value('name'),
								);
								echo form_input($data);
							?>

					    </div>
					    <div class="form-group">
					    	<label><b>Email:</b></label>
							<?php 
								$data=array(
								'name'=> 'email',
								'type'=>'text',
								'placeholder'=>'email',
								'class'=>'form-control',
								'id'=>'email',
								'value'=>set_value('email'),
								
								);
								echo form_input($data);
							?>
						</div>
					    <div class="form-group">
					    	<label><b>Password:</b></label>
							<?php 
								$data=array(
								'name'=> 'password',
								'type'=>'password',
								'placeholder'=>'password',
								'class'=>'form-control',
								'id'=>'password',
								'value'=>set_value('password'),
								
								);
								echo form_input($data);
							?>
					    <div class="form-group">
					    	<label><b>Password:</b></label>
							<?php 
								$data=array(
								'name'=> 'password2',
								'type'=>'password',
								'placeholder'=>'confirm password',
								'class'=>'form-control',
								'id'=>'password2',
								'value'=>set_value('password2'),
								
								);
								echo form_input($data);
							?>
						</div>
						<input type="hidden" id="reload" value="reload">
						    <?php 
								$data=array(
								'type'=>'submit',
								'class'=>'theme_button inverse',
								'value'=>'Add Client',
								
								);
								echo form_submit($data);
							?>
							<?php echo form_close() ?>
				</div>
			</div>

		</div>
		<!-- .with_border -->

	<!-- </div> -->

</div>
<!-- .row -->