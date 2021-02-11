<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
	
	public function login($email = null, $password = null) 
	{
		if($email && $password) {
			
			$q=$this->db->get_where('login', array('email' => $email))->result_array();
				foreach($q as $row):
					$fetched_pass=$row['password'];
				endforeach;
			
			if(password_verify($password,$fetched_pass)){
				$sql = "SELECT * FROM login WHERE email = ?";
				$query = $this->db->query($sql, array($email));
				$result = $query->row_array();

			return ($query->num_rows() === 1 ? $result['login_id'] : false);
			}
			else {
				return false;
			}
		}
	}
	
	public function validate_email($email = null)
	{
		if($email) {			
			// die($email);
			$sql = "SELECT * FROM login WHERE email = ?";
			$query = $this->db->query($sql, array($email));
			$result = $query->row_array();
			
			return ($query->num_rows() === 1 ? true : false);			
		}	
		else {
			return false;
		}
	} // /validate email function


	//register client
	public function register(){

		$email = $this->input->post('email');
		$name = $this->input->post('name');
		$password=password_hash($this->input->post('password'),PASSWORD_DEFAULT);
		$date_reg=date('dMY');

		//client login array
		$add_client_login_data = array(
			'name' => $name,
			'email' => $email,
			'password' => $password,
			'role'=>'client',
		);

		//post login
		 $added_client_login_data=$this->db->insert('login',$add_client_login_data);

		//get last id
		 $last_insert = $this->db->insert_id();


		//client profile array
		$add_client_profile_data = array(
			'date_registered'=>strtotime($date_reg),
			'login_id'=>$last_insert,
		);

		//post login
		 $added_client_profile_data=$this->db->insert('profiles',$add_client_profile_data);

		 //logs
		 $log= array(
		 	'message' => 'New user registered',
		 	'user_id' => $last_insert,
		 	'trigger_date'=>strtotime('now')
		 );
		 //inset logs table
		 $insert_log=$this->db->insert('logs',$log);

		 //if success
		 if($added_client_login_data && $added_client_profile_data && $insert_log){
			return true;
		}else{
			return false;
		}
}//end register function

 ////////IMAGE URL//////////
    function get_image_url($type = '', $id = '') {
        //checking logo image
        if($type=='logo'){
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/logo.png';

        return $image_url;
        }
    }
	
		
//end bracket for login model	
}