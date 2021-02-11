<script src="<?php echo base_url(); ?>components/customs/register.js"></script>
<?php foreach($login_id->result() as $row):
$login_id=$row->login_id;
$name=$row->name;
$email=$row->email;
?>
<?php endforeach;?>
<?php $attributes = array("name" => "form", 'id' => 'updateClientForm');
echo form_open("admin/clients_crud/update/".$login_id, $attributes);?>

    <div id="clientUpdate"></div>
    <div class="form-group">
        <label><b>Full Names:</b></label>
		<?php 
			$data=array(
			'name'=> 'u_name',
			'type'=>'text',
			'placeholder'=>'full names',
			'class'=>'form-control',
			'id'=>'u_name',
			'value'=>$name,
			);
			echo form_input($data);
		?>

    </div>
    <div class="form-group">
    	<label><b>Email:</b></label>
		<?php 
			$data=array(
			'name'=> 'u_email',
			'type'=>'text',
			'placeholder'=>'Email',
			'class'=>'form-control',
			'id'=>'u_email',
			'value'=>$email,
			
			);
			echo form_input($data);
		?>
	</div>
	    <?php 
			$data=array(
			'type'=>'submit',
			'class'=>'theme_button inverse',
			'value'=>'Update Client',
			
			);
			echo form_submit($data);
		?>
		<?php echo form_close() ?>