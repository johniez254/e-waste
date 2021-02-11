<div class="row">


	<!-- <div class="col-md-8"> -->
		<div class="col-md-7">

			<!-- <h4>Tabs</h4> -->

			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li class="active"><a href="#tab1" role="tab" data-toggle="tab"><i class="fa fa-cog"></i> General Settings</a></li>
				<li><a href="#tab2" role="tab" data-toggle="tab"><i class="fa fa-globe"></i> Social Links</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content tab-custom top-color-border">
				<div class="tab-pane fade in active" id="tab1">
					<!--settings form start-->
                    <?php $settings_id=$this->db->get_where('settings', array('setting_id' => 1)); ?>
				 
				    <?php foreach($settings_id->result() as $row):
						$id=$row->setting_id;
						$sname=$row->system_name;
						$abbr=$row->system_abbr;
						$address=$row->system_address;
						$em=$row->system_email;
						$phone=$row->system_phone;
						$facebook=$row->link_facebook;
						$twitter=$row->link_twitter;
						endforeach;
					?>
             
                    <?php $attributes = array("name" => "form", 'id' => 'settingsForm');
			            echo form_open("admin/validate_setting", $attributes);?>
		            <div id="settingMessage"></div>
                    
                   <div class="form-group">
                  
                    <label class="label-bold">System Name:</label>
						 <?php 
                            $data=array(
                            'name'=> 'sname',
                            'type'=>'text',
                            'placeholder'=>'system name',
                            'class'=>'form-control',
                            'id'=>'sname',
                            'value'=>$sname,
                            'autocomplete'=>'off'
                        );
                        echo form_input($data);
                        ?>
                    </div>
                    
                    <div class="form-group">
                  
                        <label class="label-bold">System Abbreviation :</label>
			 			<?php 
                            $data=array(
                            'name'=> 'abr',
                            'type'=>'text',
                            'placeholder'=>'abbreviation',
                            'class'=>'form-control',
                            'id'=>'abr',
                            'value'=>$abbr,
                            'autocomplete'=>'off'
                            
                            );
                            echo form_input($data);
                        ?>

                    </div>
                   
                    <div class="form-group">
                  
                        <label class="label-bold">Address :</label>
                        <?php 
                            $data=array(
                            'name'=> 'address',
                            'type'=>'text',
                            'placeholder'=>'address',
                            'class'=>'form-control',
                            'id'=>'address',
                            'value'=>$address,
                            'autocomplete'=>'off'
                            
                            );
                            echo form_input($data);
                        ?>

                    </div>
                    
                    <div class="form-group">
                    	<label class="label-bold">Email :</label>
         				<?php 
                            $data=array(
                            'name'=> 'email',
                            'type'=>'text',
                            'placeholder'=>'email',
                            'class'=>'form-control',
                            'id'=>'email',
                            'value'=>$em,
                            'autocomplete'=>'off'
                            
                            );
                        echo form_input($data);
                        ?>

                    </div>

                    <div class="form-group">
                        <label class="label-bold">Phone number :</label>
         				<?php 
							$data=array(
							'name'=> 'phone',
							'type'=>'text',
							'placeholder'=>'phone number',
							'class'=>'form-control',
							'id'=>'phone',
							'value'=>$phone,
							'autocomplete'=>'off'
							
							);
							echo form_input($data);
                                                    
                         ?>
                     </div>
                     <?php 
					$data=array(
					'type'=>'submit',
					'class'=>'theme_button inverse',
					'value'=>'Update settings',
					
					);
					echo form_submit($data);
					?>
					<?php 
                        $data=array(
                        'type'=>'button',
                        'class'=>'theme_button color1',
                        'value'=>'Reset',
						'onclick'=>'resetForm()',
                        
                        );
                        echo form_reset($data);
                    ?>
                    <?php echo form_close()?>
                    <!--settings form end-->
				</div>
				<div class="tab-pane fade" id="tab2">
					<?php $attributes = array("name" => "form", 'id' => 'socialForm');
		            echo form_open("admin/validate_social", $attributes);?>
            
                    <div id="socialMessage"></div>
                    <div class="form-group">
                        <label><b>Facebook Link:</b></label>
						<?php 
							$data=array(
							'name'=> 'facebook',
							'type'=>'text',
							'placeholder'=>'Facebook Link',
							'class'=>'form-control',
							'id'=>'facebook',
							'value'=>$facebook,
							);
							echo form_input($data);
						?>

                    </div>
                    <div class="form-group">
                    	<label><b>Twitter Link:</b></label>
						<?php 
							$data=array(
							'name'=> 'twitter',
							'type'=>'text',
							'placeholder'=>'Twitter Link',
							'class'=>'form-control',
							'id'=>'twitter',
							'value'=>$twitter,
							
							);
							echo form_input($data);
						?>
					</div>
					<?php 
						$data=array(
						'type'=>'submit',
						'class'=>'theme_button inverse',
						'value'=>'Update Links',
						
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
				<li class="active"><a href="#upload" role="tab" data-toggle="tab"><i class="fa fa-film"></i> Upload System Logo</a></li>
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
							<img src="<?php echo $this->qm->get_image_url('logo','logo');?>" alt="logo image">
						</div>
						<div class="media-body">
							<h4>Chose new image
							</h4>
							<p>
								 <?php $at = array("name" => "form","encytype"=>"multipart/form-data","class"=>"form-inline");
                         echo form_open_multipart(base_url() .'admin/update_logo_image', $at);?>
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
								<p class="help-block"><i class="fa fa-warning"></i> Formats (jpg, png, gif, JPG, PNG, GIF) and should be less than <b>1mb</b></p>
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