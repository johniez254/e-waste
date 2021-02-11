<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Client_model','cm');
		$this->load->model('Query_model','qm');
		$this->check_session();//check session
	}
	
	//for session check
	function check_session(){
        if ($this->session->userdata('logged_in') == FALSE){
            redirect(base_url()."login", 'refresh');
		}
	}
	
	//load index
	public function index()
	{
		$this->dashboard();//call dashboard function
	}
	
	//load dashboard page
	public function dashboard(){
		$page_data=array(

	        'page_name'  => 'dashboard',
			'crumb'  => '1',//number of breadcrumbs in header section
	        'page_title' => 'dashboard',//page title;
	        'approved_disposes' => $this->qm->disposes('ClientApprovedDisposes'),
	        'pending_disposes' => $this->qm->disposes('ClientPendingDisposes'),
	        'pending_earnings' => $this->qm->payments('ClientPendingPayments'),
	        'logs_query' => $this->qm->queryLogs('client'),
	    	);
        $this->load->view('index', $page_data,'refresh');//load index
	}
	
	//load gadgets page
	public function gadgets(){
		$page_data=array(

	        'page_name'  => 'gadgets',
			'crumb'  => '1',//number of breadcrumbs in header section
	        'page_title' => 'gadgets',//page title;
	        'totalGadgets' => $this->qm->gadgets('countGadgets'),//count clients;
	        'gadgetsQuery' => $this->qm->gadgets('queryGadgets'),
	    	);
        $this->load->view('index', $page_data,'refresh');//load index
	}
	
	//load profile page
	public function profile(){
		$page_data=array(

	        'page_name'  => 'profile',
			'crumb'  => '1',//number of breadcrumbs in header section
	        'page_title' => 'client profile',//page title;
	    	);
        $this->load->view('index', $page_data,'refresh');//load index
	}
	
	//add new dispose page
	public function disposes($p1="",$p2=""){
		//add new dispose page
		if($p1=="new"){
			$page_data=array(

		        'page_name'  => 'new',
				'crumb'  => '2',//number of breadcrumbs in header section
				'sub'  => 'disposes',
				'url'  => 'client/disposes/new',
		        'page_title' => 'new dispose',//page title;
		        'gadgetsQuery' => $this->qm->gadgets('queryGadgets'),
		        'getClient' => $this->qm->get_user_session_data(),
		    	);
	        $this->load->view('index', $page_data,'refresh');//load index
	    }
	    if($p1=="all"){
	    	//disposed items page
			$page_data=array(

		        'page_name'  => 'disposed',
				'crumb'  => '2',//number of breadcrumbs in header section
				'sub'  => 'disposes',
				'url'  => 'client/disposes/all',
		        'page_title' => 'all disposes',//page title;
		        'getDispose' => $this->qm->disposes('clientQueryDisposes')
		    	);
	        $this->load->view('index', $page_data,'refresh');//load index

	    }
	    if($p1=="view"){
	    	//disposed items page
			$page_data=array(

		        'page_name'  => 'view-dispose',
				'crumb'  => '2',//number of breadcrumbs in header section
				'sub'  => 'disposes',
				'url'  => 'client/disposes/all',
		        'page_title' => 'view dispose',//page title;
		        'trans_code'=>$this->db->get_where('transaction', array('transaction_code'=>$p2)),
		    	);
	        $this->load->view('index', $page_data,'refresh');//load index

	    }
	}

	//disposes_crud
	public function disposes_crud($p1="",$p2=""){
		//get price
		if($p1=="getPrice"){
			$gadgetTypeId = $this->input->post('gadgetTypeId');
			$this->db->where('gadget_id', $gadgetTypeId);
			$query=$this->db->get('gadgets');
				if($query->num_rows()>0){
					$row = $query->row();
				}
			echo json_encode($row);
		}//end
		// fetch gadgets
		if($p1=='get_gadgets'){
			$data=$this->qm->gadgets('queryGadgets');
			echo json_encode($data);
		}
		//add disposes
		if($p1=="add"){
			$valid['success'] = array('success' => false, 'messages' => array(),'transaction_code'=>'');
			$add_dispose_query=$this->cm->dispose_queries('add');
			if($add_dispose_query){
				//notify user through sms
				$this->qm->sendNotification($add_dispose_query);
	
				$phone = $this->db->get_where('transaction' , array('transaction_code'=>$add_dispose_query))->row()->phone;
				$transaction_total = $this->db->get_where('transaction' , array('transaction_code'=>$add_dispose_query))->row()->transaction_total;
				$this->qm->requestPayment($add_dispose_query,$phone,$transaction_total);

				//return statuses url
				$valid['success'] = true;
				$valid['messages'] = "Dispose was added Successfully.";
				$valid['transaction_code'] = $add_dispose_query;
			}

				echo json_encode($valid);
		}//end

	}//end crud

	public function saf($transaction_code){
		$phone = $this->db->get_where('transaction' , array('transaction_code'=>$transaction_code))->row()->phone;
		$transaction_total = $this->db->get_where('transaction' , array('transaction_code'=>$transaction_code))->row()->transaction_total;
		$mpesa_det=array(
			'transaction_code'=>$transaction_code,
			'phone'=>$phone,
			'transaction_total'=>$transaction_total,
		);
		$this->load->view('mpesa',$mpesa_det);
	}

	//validate profile form
	public function validate_profile($id=""){
		// $userId = $this->session->userdata('id');
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'required'
			),
			array(
				'field' => 'phone',
				'label' => 'Phone Number',
				'rules' => 'required|exact_length[9]|is_unique[profiles.phone]|callback_validate_phone',
				
				'errors' => array(
					'is_unique' => 'This %s is already registered!'
					)
			),
			array(
				'field' => 'address',
				'label' => 'Address',
				'rules' => 'required'
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->cm->update_profile($id);

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Profile Updated Successfully!";
			}	
			else {
				$validator['success'] = false;
				$validator['messages'] = "There was an error while posting your data.";
			} 
		}
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);			
			} // /else
		}
		echo json_encode($validator);
	}
	
	//validate passwords
	public function validate_password(){
		$userId = $this->session->userdata('id');
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'oldpass',
				'label' => 'Old Password',
				'rules' => 'required|callback_validate_pass'
			),
			array(
				'field' => 'newpass',
				'label' => 'New Password',
				'rules' => 'required|callback_password_check'
			),
			array(
				'field' => 'confpass',
				'label' => 'Confirm Password',
				'rules' => 'required|matches[newpass]',
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->cm->password_post($userId);

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Password Updated Successfully!";
			}	
			else {
				$validator['success'] = false;
				$validator['messages'] = "There was an error while posting the data!";
			} 
		}
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);			
			} // /else
		}
		echo json_encode($validator);
	}
	
	//compare db password with user inputted password and return either true/false
	public function validate_pass()
	{
		$validate = $this->cm->password_validate($this->input->post('oldpass'));

		if($validate === true) {
			return true;
		} 
		else {
			$this->form_validation->set_message('validate_pass', 'This Old Password is incorrect!');
			return false;			
		} // /else
	} // /validate password function



	//verify password
	public function password_check($pwd){
		if (preg_match('#[0-9]#', $pwd) && preg_match('#[a-zA-Z]#', $pwd)) {
		     return TRUE;
		 }
		 $this->form_validation->set_message('password_check', '%s should contain both letters and numbers!');
		 return false;

	}
	//verify phone number
	public function validate_phone($phone){
		if (preg_match('/^(?:254|\+254|0)?((7|1)(?:(?:[129][0-9])|(?:0[0-8])|(4[0-1]))[0-9]{6})$/', $phone)) {
		     return TRUE;
		 }
		 $this->form_validation->set_message('validate_phone', 'The %s is invalid! It should be in the format 7XXXXXXXX or 1XXXXXXXX');
		 return false;

	}
	
	//admin update/upload profile piicture
	public function update_image(){
		$userId = $this->session->userdata('id');
		 move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/user_image/' . $userId . '.jpg');			 
			$this->session->set_flashdata('flash_message' , 'Picture Updated Successfully!');
			redirect ('admin/profile','refresh');
	}
	
	//load disposes page
	public function logs(){
		$page_data=array(

	        'page_name'  => 'logs',
			'crumb'  => '1',//number of breadcrumbs in header section
	        'page_title' => 'Logs',//page title;
	        'countLogs' => $this->qm->logs('clientCountLogs'),
	        'getLogs' => $this->qm->logs('clientQuery'),
	    	);
        $this->load->view('index', $page_data,'refresh');//load index
	}
	
	
	
	// bracket for class controller
}
