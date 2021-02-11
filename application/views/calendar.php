<?php
$user_id= $this->session->userdata('id');
$id=$this->db->get_where('login' , array('login_id'=>$user_id))->row()->login_id;
$role=$this->db->get_where('login' , array('login_id'=>$user_id))->row()->role;
?>
<script type="text/javascript">
	///////////////////
	//events calendar//
	///////////////////
	//https://fullcalendar.io/
	jQuery('.events_calendar').fullCalendar(

		{
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,listWeek'
			},
			// defaultDate: '2017-03-12',
			editable: true,
			firstDay: 1,
			height: 530,
			droppable: false,
			eventLimit: true, // allow "more" link when too many events
			navLinks: true,
			aspectRatio: 1,
			// eventRender: function(event, element) {
		 //      $(element).tooltip({title: event.description});             
		 //  },
			events: [
					<?php
						if ($role=="client") {$where="login_id=".$id."";}
						$this->db->select('*');
						$this->db->from('transaction');
						if ($role=="client") {$this->db->where($where);}
						$desc	=	$this->db->get()->result_array();
						
						foreach($desc as $row):
					    $transaction_code=$row['transaction_code'];
					    $payment_status=$row['payment_status'];
					    $collection_date=$row['collection_date'];

					    if($payment_status==0){
					?>
						{
							className: '<?php echo'fc-orange'; ?>',
							description: 'first description sahchajajskcjkasjkk',
							title: 'Dispose ID: <?php echo $transaction_code; ?>',
							<?php if ($role=="client"){?>
								url: '<?php echo base_url().'client/disposes/view/'.$transaction_code ?>',
							<?php }else{?>
								url: '<?php echo base_url().'admin/disposes/view/'.$transaction_code ?>',
							<?php }?>
							start: '<?php echo date("Y-m-d",$collection_date)?>'
						},
					<?php } else{?>
						{
							className: '<?php echo'fc-green'; ?>',
							title: 'Dispose ID:  <?php echo $transaction_code; ?>',
							<?php if ($role=="client"){?>
								url: '<?php echo base_url().'client/disposes/view/'.$transaction_code ?>',
							<?php }else{?>
								url: '<?php echo base_url().'admin/disposes/view/'.$transaction_code ?>',
							<?php }?>
							start: '<?php echo date("Y-m-d",$collection_date)?>'
						},
					<?php } endforeach?>
			],
		}

	);
</script>