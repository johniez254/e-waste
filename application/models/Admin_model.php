<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	//for session check
	function check_session(){
        if ($this->session->userdata('logged_in') == FALSE){
            redirect(base_url()."login", 'refresh');
		}
	}
	
	//update personal profile	
	public function profile_post($userId=null){
		if($userId){
			$update_data = array(
				'name' => $this->input->post('name'),
			);
				$this->db->where('login_id', $userId);
				$status = $this->db->update('login', $update_data);		
				return ($status == true ? true : false);
		}
	}


	//validate pinputed password
	public function password_validate($password = null)
	{
		if($password) {
			$oldpass=$this->input->post('oldpass');
			$newpass=password_hash($this->input->post('newpass'),PASSWORD_DEFAULT);
			$email=$this->input->post('email');
			
			$query=$this->db->get_where('login', array('email' => $email))->result_array();
			foreach($query as $row):
				$fetched_pass=$row['password'];
			endforeach;
			
			if(password_verify($oldpass,$fetched_pass)){
				
				$this->db->where('email', $email);
				$this->db->where('password', $fetched_pass);
				$query=$this->db->get('login');
				
				return ($query->num_rows() === 1 ? true : false);
			}
		}	
		else {
			return false;
		}
	} // /validate password function
	
	//update password function
	public function password_post($userId=null){
		if($userId){
			$newpass=password_hash($this->input->post('newpass'),PASSWORD_DEFAULT);			
				$data=array(
				'password'=>$newpass,
				);
				$this->db->where('login_id',$userId);
				$status=$this->db->update('login',$data);
				return ($status == true ? true : false);
			}
	}


	//update settings
	public function settings_post($settingsId='1'){
		if($settingsId){
			$update_data = array(
				'system_name' => $this->input->post('sname'),
				'system_abbr' => $this->input->post('abr'),
				'system_email' => $this->input->post('email'),
				'system_phone'=>$this->input->post('phone'),
				'system_address'=>$this->input->post('address'),
			);
				$this->db->where('setting_id', $settingsId);
				$status = $this->db->update('settings', $update_data);		
				return ($status == true ? true : false);
		}
	}


	//update social links
	public function social_post($settingsId='1'){
		if($settingsId){
			$update_data = array(
				'link_facebook' => $this->input->post('facebook'),
				'link_twitter' => $this->input->post('twitter'),
			);
				$this->db->where('setting_id', $settingsId);
				$status = $this->db->update('settings', $update_data);		
				return ($status == true ? true : false);
		}
	}


	//all disposes crud operations
	public function disposes_crud($p1="",$p2=""){
		if($p1=="markPaid"){
			$update_data = array(
				'payment_status' => 1,
				'transaction_status' => 1,
			);
				$this->db->where('transaction_code', $p2);
				$status = $this->db->update('transaction', $update_data);

				//get client id
				$user_id =	$this->db->get_where('transaction' , array('transaction_code'=>$p2))->row()->login_id;

				//logs
				 $log= array(
				 	'message' => 'You marked dispose <b>'. $p2. '</b> as paid',
				 	'user_id' => $user_id,
				 	'trigger_date'=>strtotime('now'),
				 	'priority'=>3,
				 );
				 //inset logs table
				 $insert_log=$this->db->insert('logs',$log);

				return ($status == true ? true : false);
		}//end
		if($p1=="markCollected"){
			$update_data = array(
				'transaction_status' => 2,
			);
				$this->db->where('transaction_code', $p2);
				$status = $this->db->update('transaction', $update_data);

				//get client id
				$user_id =	$this->db->get_where('transaction' , array('transaction_code'=>$p2))->row()->login_id;

				//logs
				 $log= array(
				 	'message' => 'You marked dispose <b>'. $p2. '</b> as collected',
				 	'user_id' => $user_id,
				 	'trigger_date'=>strtotime('now'),
				 	'priority'=>4,
				 );
				 //inset logs table
				 $insert_log=$this->db->insert('logs',$log);

				return ($status == true ? true : false);
		}//end
		if($p1=="delete"){
			$trans_id=$this->db->get_where('transaction' , array('transaction_code'=>$p2))->row()->transaction_id;

			//delete dispose
			$this->db->where('transaction_id', $trans_id);
			$this->db->delete('disposes');

			//delete transaction
			$this->db->where('transaction_code', $p2);
			$this->db->delete('transaction');

			return true;
		}//end

	}//end disposes crud


	//model clients
	public function clients_crud($p1="",$p2=""){
		if($p1=="update"){
			$update_data = array(
				'name' => $this->input->post('u_name'),
				'email' => $this->input->post('u_email'),
			);
				$this->db->where('login_id', $p2);
				$status = $this->db->update('login', $update_data);		
				return ($status == true ? true : false);
		}
		if($p1=="delete"){
			$this->db->where('login_id',$p2);
			$status = $this->db->delete('login');	
			return ($status == true ? true : false);
		}
	}//end


	//crud gadgets
	public function gadgets_crud($p1="",$p2=""){
		if($p1=="add"){
			$gadget=$this->input->post('gadgetName');
			$price=$this->input->post('gadgetPrice');
			
			for($i=0; $i<count($gadget); $i++) {	
			$data =array();
				$data[$i] = array(
       				'gadget_name' => $gadget[$i], 
       				'gadget_price' => $price[$i],
       			);		   
			$status=$this->db->insert_batch('gadgets', $data);

			//logs
			 $log= array(
			 	'message' => 'New disposable gadgets added',
			 	'user_id' => $this->session->userdata('id'),
			 	'trigger_date'=>strtotime('now'),
			 	'priority'=>1,
			 );
			 //inset logs table
			 $insert_log=$this->db->insert('logs',$log);
			}

			return ($status == true ? true : false);
		}//add

		//update gadgets
		if($p1=="update"){
			$update_data = array(
				'gadget_name' => $this->input->post('gname'),
				'gadget_price' => $this->input->post('gprice'),
			);
				$this->db->where('gadget_id', $p2);
				$status = $this->db->update('gadgets', $update_data);		
				return ($status == true ? true : false);
		}//update

		//delete gadgets
		if($p1=="delete_gadget"){
			$delete_data = array(
				'deleted_gadget' => 1,
			);
				$this->db->where('gadget_id', $p2);
				$status = $this->db->update('gadgets', $delete_data);		
				return ($status == true ? true : false);
		}

		if($p1=="checkGadget"){
			if($p2) {
			$sql = "SELECT * FROM gadgets WHERE gadget_name = ?";
			$query = $this->db->query($sql, array($p2));
			$result = $query->row_array();
			
			return ($query->num_rows() === 1 ? false : true);			
			}	
			else {
				return true;
			}
		}

	}//crud



//end of Admin model class bracket
}