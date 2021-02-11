<script src="<?php echo base_url(); ?>components/customs/gadgets.js"></script>
<?php foreach($gadget_id->result() as $row):
$gadget_id=$row->gadget_id;
$gadget_name=$row->gadget_name;
$gadget_price=$row->gadget_price;
?>
<?php endforeach;?>
<?php $attributes = array("name" => "form", 'id' => 'updateGadgetForm');
echo form_open("admin/gadgets_crud/update/".$gadget_id, $attributes);?>

    <div id="gadgetUpdate"></div>
    <div class="form-group">
        <label><b>Gadget Name:</b></label>
		<?php 
			$data=array(
			'name'=> 'gname',
			'type'=>'text',
			'placeholder'=>'Gadget Name',
			'class'=>'form-control',
			'id'=>'gname',
			'value'=>$gadget_name,
			);
			echo form_input($data);
		?>

    </div>
    <div class="form-group">
    	<label><b>Gadget Price:</b></label>
		<?php 
			$data=array(
			'name'=> 'gprice',
			'type'=>'text',
			'placeholder'=>'Gadget price',
			'class'=>'form-control',
			'id'=>'gprice',
			'value'=>$gadget_price,
			
			);
			echo form_input($data);
		?>
	</div>
	    <?php 
			$data=array(
			'type'=>'submit',
			'class'=>'theme_button inverse',
			'value'=>'Update Gadget',
			
			);
			echo form_submit($data);
		?>
	    <?php 
			$data=array(
			'type'=>'reset',
			'class'=>'theme_button color1',
			'value'=>'Reset',
			
			);
			echo form_submit($data);
		?>
		<?php echo form_close() ?>