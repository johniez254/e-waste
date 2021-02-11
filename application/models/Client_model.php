<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_model extends CI_Model {

    //for session check
    function check_session(){
        if ($this->session->userdata('logged_in') == FALSE){
            redirect(base_url()."login", 'refresh');
        }
    }

    //dispose queries
    public function dispose_queries($p1="",$p2=""){
    	$this->check_session();
    	if($p1=="add"){
    		$name=$this->input->post('name');
    		$email=$this->input->post('email');
    		$phone=$this->input->post('phone');
    		$address=$this->input->post('address');
    		$who=$this->input->post('who');
    		$collectDate=strtotime($this->input->post('collectDate'));
    		$userfile=$this->input->post('userfile');
    		$description=$this->input->post('description');
    		$date_created=strtotime(date('dMY'));
    		//arrays
    		$gadget_id=$this->input->post('gadgetType');
    		$transaction_total=$this->input->post('finalTotalValue');
    		$quantity=$this->input->post('gadgetQuantity');

    		//generate transaction date
    		$transaction_code=strtoupper(substr(md5(microtime()),rand(0,26),6));

    		$transaction_data=array(
    			'transaction_code'=>$transaction_code,
    			'transaction_total'=>$transaction_total,
				'login_id'=>$this->session->userdata('id'), 
   				'name' => $name, 
   				'email' => $email,
   				'phone'=>$phone,
				'location'=>$address,
				'who'=>$who,
				'date_created'=>$date_created,
				'collection_date'=>$collectDate,
				'description'=>$description,
				'transaction_total'=>$transaction_total,
			);

    		// insert transaction
    		$this->db->insert('transaction', $transaction_data);

    		//get last id insert
    		$transaction_id = $this->db->insert_id();

    		//insert to disposes table data
    		for($i=0; $i<count($gadget_id); $i++) {
				$da =array();
					$da[$i] = array(
						'transaction_id'=>$transaction_id,
						'gadget_id'=>$gadget_id[$i],
						'quantity'=>$quantity[$i],
           			);		   
				$this->db->insert_batch('disposes', $da);
			}

				//$this->qm->requestPayment($transaction_code,$phone,$transaction_total);
			//logs
			$log= array(
			 	'message' => 'New dispose <b>'.$transaction_code.'</b> initiated',
			 	'user_id' => $this->session->userdata('id'),
			 	'trigger_date'=>strtotime('now'),
			 	'priority'=>2,
			 );
			 //insert logs table
			 $insert_log=$this->db->insert('logs',$log);
			return $transaction_code;
    	}//end add

    }//end crud dispose queries

    //update profile
    public function update_profile($p1=""){
    	$name=$this->input->post('name');
    	$phone=$this->input->post('phone');
    	$address=$this->input->post('address');

		$update_login = array(
			'name' => $name,
		);

		$this->db->where('login_id', $p1);
		$status1 = $this->db->update('login', $update_login);

		$update_profiles = array(
			'phone' => $phone,
			'address' => $address,
		);
		$this->db->where('login_id', $p1);
		$status2 = $this->db->update('profiles', $update_profiles);	

		if($status1 && $status2){
			// return ($status == true ? true : false);
			return true;
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


//end of Admin model class bracket
}