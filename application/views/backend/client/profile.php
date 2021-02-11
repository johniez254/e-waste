<?php
$id		 =	$this->session->userdata('id');
?>
<div class="row">


	<!-- <div class="col-md-8"> -->
		<div class="col-md-7">

			<!-- <h4>Tabs</h4> -->

			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li class="active"><a href="#tab1" role="tab" data-toggle="tab"><i class="fa fa-bars"></i> Manage Profile</a></li>
				<li><a href="#tab2" role="tab" data-toggle="tab"><i class="fa fa-unlock-alt"></i> Change Password</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content tab-custom top-color-border">
				<div class="tab-pane fade in active" id="tab1">
					<?php $setting_id=$this->db->get_where('login', array('login_id' => $id)); ?>
									 
					<?php foreach($setting_id->result() as $row):
                        $id=$row->login_id;
                        $pass=$row->password;
                        $names=$row->name;
                        $role=$row->role;
                        $em=$row->email;
	                    endforeach;
	                    $phone=$this->db->get_where('profiles' , array('login_id'=>$id))->row()->phone;
	                    $address=$this->db->get_where('profiles' , array('login_id'=>$id))->row()->address;
                    
                    ?>
					<?php $attributes = array("name" => "form", 'id'=>'nameForm');
            echo form_open("client/validate_profile/".$id, $attributes);?> 
            
					<div id="nameMessage"></div>
                        <div class="form-group">
                            <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
                            <label><b>Name:</b></label>
                            <input type="text" name="name" class="form-control" value="<?php echo $names?>" id="name" placeholder="Enter your full names">
                        </div>
                        <div class="form-group">
                            <label><b>Phone Number:</b></label>
                            <!-- <input type="text" name="phone" class="form-control" value="<?php //echo $phone?>" id="phone" placeholder="Your phone number"> -->
                            <div class="input-group">
	                            <span class="input-group-addon" style="border:none;"><b>+254</b></span>
	                            <input type="number" class="form-control" placeholder="7XXXXXXXX" name="phone" value="<?php echo $phone ?>" id="phone">
	                        </div>
                        </div>
                        <div class="form-group">
                            <label><b>Address:</b></label>
                            <input type="text" name="address" class="form-control" value="<?php echo $address?>" id="address" placeholder="Your address">
                        </div>

                        <div class="form-group">
                            <label><b>Email:</b></label>
                            <input type="text" name="email" value="<?php echo $em?>" class="form-control" readonly="readonly" disabled id="email">
                        </div>

                        <div class="form-group">
                            <label><b>Role:</b></label>
                            <input type="text" name="role" class="form-control" id="role" readonly="readonly" disabled value="<?php echo $role?>">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="theme_button inverse">Update Profile</button>
                            <!-- <button type="button" onclick="resetForm()" class="btn btn-warning">Reset</button> -->
                            </div>

                    </form>
                    <!--manage profile form end-->
				</div>
				<div class="tab-pane fade" id="tab2">
					<?php $attributes = array("name" => "form", 'id' => 'passwordForm');
            echo form_open("client/validate_password", $attributes);?>
            
                    <div id="passwordMessage"></div>
                    <div class="form-group">
                        <label><b>Current Password:</b></label>
						<?php 
							$data=array(
							'name'=> 'oldpass',
							'type'=>'password',
							'placeholder'=>'current password',
							'class'=>'form-control',
							'id'=>'oldpass',
							'value'=>set_value('oldpass'),
							);
							echo form_input($data);
						?>

                    </div>
                    <div class="form-group">
                    	<label><b>New Password:</b></label>
						<?php 
							$data=array(
							'name'=> 'newpass',
							'type'=>'password',
							'placeholder'=>'new password',
							'class'=>'form-control',
							'id'=>'newpass',
							'value'=>set_value('newpass'),
							
							);
							echo form_input($data);
						?>
					</div>
					<div class="form-group">
						<label><b>Confirm Password:</b></label>
						 <?php 
                            $data=array(
                            'name'=> 'confpass',
                            'type'=>'password',
                            'placeholder'=>'confirm password',
                            'class'=>'form-control',
                            'id'=>'confpass',
                            'value'=>set_value('confpass'),
                            
                            );
                            echo form_input($data);
                        ?>
                    </div>
	                    <?php
						   $data=array(
						   'type'=>'hidden',
						   'name'=>'email',
						   'value'=>$em,
						   );
						   echo form_input($data);
					    ?>
					    <?php 
							$data=array(
							'type'=>'submit',
							'class'=>'theme_button inverse',
							'value'=>'Change Password',
							
							);
							echo form_submit($data);
						?>
						<?php echo form_close() ?>
				</div>
			</div>

		</div>
		<!-- .with_border -->

	<!-- </div> -->

	<!-- <div class="col-md-8"> -->
		<div class="col-md-5">

			<!-- <h4>Tabs</h4> -->

			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li class="active"><a href="#upload" role="tab" data-toggle="tab"><i class="fa fa-film"></i> Upload Photo</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content tab-custom top-color-border">
				<div class="tab-pane fade in active" id="upload">
					<?php if($this->session->flashdata('flash_message')){ ?>
						 <div class="alert alert-success alert-dismissible" role="alert">
						 	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						 		<span aria-hidden="true">&times;</span></button>
						 		<?php echo $this->session->flashdata('flash_message'); ?>
						 	</div>
				    <?php } ?>
				    <div class="media big-left-media">
						<div class="media-left">
							<img src="<?php echo $this->qm->get_image_url('user',$id);?>" alt="...">
						</div>
						<div class="media-body">
							<h4>Chose new image
							</h4>
							<p>
								 <?php $at = array("name" => "form","encytype"=>"multipart/form-data","class"=>"form-inline");
                         echo form_open_multipart(base_url() .'client/update_image', $at);?>
                            <div class="form-group">

                                <?php
                                $dat=array(
								'type'=>'file',
								'name'=> 'userfile',
								'accept'=>'image/*',
								'id'=>'userfile',
								'required'=>'required'
								
								);
									echo form_input($dat);
								?>
								<p class="help-block"><i class="fa fa-warning"></i> Formats (jpg, png, gif, JPG, PNG, GIF)</p>
							  <?php
								$dat=array(
									'type'=>'submit',
									'value'=>'upload',
									'class'=>'theme_button inverse',
									'id'=>'submit'
								);
									echo form_input($dat);
								?>
                            </div>
                        <?php echo form_close()?>
							</p>
						</div>
					</div>
			</div>

		</div>
		<!-- .with_border -->

	</div>
	<!-- .col-* -->

</div>
<!-- .row -->