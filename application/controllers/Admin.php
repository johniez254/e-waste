<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$this->load->model('Admin_model','adm');
		$this->load->model('Query_model','qm');
		$this->load->model('Login_model','lm');
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
	        'page_title' => 'Admin dashboard',//page title;
	        'total_clients' => $this->qm->clients('countClients'),
	        'total_gadgets' => $this->qm->gadgets('countGadgets'),
	        'approved_earnings' => $this->qm->payments('AdminApprovedPayments'),
	        'pending_earnings' => $this->qm->payments('AdminPendingPayments'),
	        'approved_disposes' => $this->qm->disposes('CountApprovedDisposes'),
	        'pending_disposes' => $this->qm->disposes('CountPendingDisposes'),
	        'logs_query' => $this->qm->queryLogs('admin'),
	    	);
        $this->load->view('index', $page_data,'refresh');//load index
	}
	
	//load profile page
	public function profile(){
		$page_data=array(

	        'page_name'  => 'profile',
			'crumb'  => '1',//number of breadcrumbs in header section
	        'page_title' => 'Admin profile',//page title;
	    	);
        $this->load->view('index', $page_data,'refresh');//load index
	}
	
	//load dashboard page
	public function clients(){
		$page_data=array(

	        'page_name'  => 'clients',
			'crumb'  => '1',//number of breadcrumbs in header section
	        'page_title' => 'clients',//page title;
	        'totalClients' => $this->qm->clients('countClients'),//count clients;
	        'clientsQuery' => $this->qm->clients('queryClients'),
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
	
	//load disposes page
	public function disposes(){
		$page_data=array(

	        'page_name'  => 'disposes',
			'crumb'  => '1',//number of breadcrumbs in header section
	        'page_title' => 'disposes',//page title;
	        'getAdminDispose' => $this->qm->disposes('adminQueryDisposes'),
	        'getAdminDisposeApproved' => $this->qm->disposes('adminApprovedQueryDisposes'),
	        'getAdminDisposePending' => $this->qm->disposes('adminPendingQueryDisposes'),
	    	);
        $this->load->view('index', $page_data,'refresh');//load index
	}
	
	//load disposes page
	public function view_disposes($p1=""){
		$page_data=array(

	        'page_name'  => 'view-dispose',
			'crumb'  => '2',//number of breadcrumbs in header section
			'sub'  => 'disposes',
			'url'  => 'admin/disposes',
	        'page_title' => 'view disposes',//page title;
	        'trans_code' => $this->db->get_where('transaction', array('transaction_code'=>$p1)),
	    	);
        $this->load->view('index', $page_data,'refresh');//load index
	}
	
	//load disposes crud operations
	public function disposes_crud($p1="",$p2=""){
		if($p1=="markPaid"){
			$mark_paid=$this->adm->disposes_crud("markPaid",$p2);
			if($mark_paid){		 
				$this->session->set_flashdata('pay_message' , 'Dispose id <b>#'.$p2.'</b> was marked as paid successfully!');
				redirect ('admin/disposes','refresh');
			}
		}//end
		if($p1=="markCollected"){
			$mark_collected=$this->adm->disposes_crud("markCollected",$p2);
			if($mark_collected){		 
				$this->session->set_flashdata('collected_message' , 'Dispose id <b>#'.$p2.'</b> was collected successfully!');
				redirect ('admin/disposes','refresh');
			}
		}//end
		if($p1=="delete"){
			$delete_dispose=$this->adm->disposes_crud("delete",$p2);
			if($delete_dispose){		 
				$this->session->set_flashdata('delete_message' , 'Dispose was deleted successfully!');
				redirect ('admin/disposes','refresh');
			}
		}//end

	}//end crud
	
	//load client crud operations
	public function clients_crud($p1="",$p2=""){
		if($p1=="edit"){
			$data['login_id']=$this->db->get_where('login', array('login_id' => $p2));
			$this->load->view('backend/admin/modal_edit_client.php',$data,'refresh');
		}
		//add client
		if($p1=="add"){

			$validate_data = array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'required',
				
				'errors' => array(
					'required' => 'The %s field is required!',
					)
			),
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|valid_email|is_unique[login.email]',
				
				'errors' => array(
					'required' => 'The Email field is required!',
					'is_unique' => 'This email is already taken!'
					)
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|min_length[5]|callback_password_check',
				'errors' => array(
					'required' => 'The %s field is required!',
					)
			),
			array(
				'field' => 'password2',
				'label' => 'Retype password',
				'rules' => 'required|matches[password]',
				'errors' => array(
					'required' => 'The %s field is required!',
					'matches' => 'The %s field should match password field!',
					)
				)
			);
			
			$this->form_validation->set_rules($validate_data);
			$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');
	
			if($this->form_validation->run() === true) {
	
				$reg = $this->lm->register();
	
				if($reg === true) {
					$validator['success'] = true;
					$validator['messages'] = "Client Added Successfully!";
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
		//admin update client
		if($p1=="update"){

			$validator = array('success' => false, 'messages' => array());

			$validate_data = array(
				array(
					'field' => 'u_name',
					'label' => 'Name',
					'rules' => 'required',
				),
				array(
					'field' => 'u_email',
					'label' => 'Email',
					'rules' => 'required|valid_email',
				),
			);
			
			$this->form_validation->set_rules($validate_data);
			$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');
	
			if($this->form_validation->run() === true) {
	
				$posting = $this->adm->clients_crud('update',$p2);
	
				if($posting == true) {
					$validator['success'] = true;
					$validator['messages'] = "Client Updated Successfully!";
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
		if($p1=="delete"){
			$delete=$this->adm->clients_crud('delete',$p2);
			if($delete){		 
			$this->session->set_flashdata('client_message' , 'Client Deleted Successfully!');
			redirect ('admin/clients');
			}
		}
	}
	
	//load settings page
	public function settings(){
		$page_data=array(

	        'page_name'  => 'settings',
			'crumb'  => '1',//number of breadcrumbs in header section
	        'page_title' => 'settings',//page title;
	    	);
        $this->load->view('index', $page_data,'refresh');//load index
	}

	//load client crud operations
	public function gadgets_crud($p1="",$p2=""){
		//edit gadget
		if($p1=="edit"){
			$data['gadget_id']=$this->db->get_where('gadgets', array('gadget_id' => $p2));
			$this->load->view('backend/admin/modal_edit_gadget.php',$data,'refresh');
		}

		//add  gadget
		if($p1=="add"){
			$valid['success'] = array('success' => false, 'messages' => array());
			$posting=$this->adm->gadgets_crud('add');
			if($posting ===	 true){
				$validator['success'] = true;
				$validator['messages'] = "Disposable Gadgets Added Successfully!";
				echo json_encode($validator);
			}	
			else {
				$validator['success'] = false;
				$validator['messages'] = "There was an error while posting your data.";
			}
		}//end
		if($p1=="update"){

			$validator = array('success' => false, 'messages' => array());

			$validate_data = array(
				array(
					'field' => 'gname',
					'label' => 'Gadget Name',
					'rules' => 'required',
				),
				array(
					'field' => 'gprice',
					'label' => 'Gadget Price',
					'rules' => 'required|numeric',
				),
			);
			
			$this->form_validation->set_rules($validate_data);
			$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');
	
			if($this->form_validation->run() === true) {
	
				$posting = $this->adm->gadgets_crud('update',$p2);
	
				if($posting == true) {
					$validator['success'] = true;
					$validator['messages'] = "Gadget Updated Successfully!";
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

		}//end update
		//delete
		if($p1=="delete"){
			$delete = $this->adm->gadgets_crud('delete_gadget',$p2);	
			if($delete){		 
				$this->session->set_flashdata('gadget_message' , 'Gadget Deleted Successfully!');
				redirect ('admin/gadgets','refresh');
			}
		}
		if($p1=="check_availability"){
			$available=$this->adm->gadgets_crud('checkGadget',$p2);
			echo json_encode($available);
		}//end check availability
	}//exp

	//validate profile form
	public function validate_profile(){
		$userId = $this->session->userdata('id');
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'required'
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->adm->profile_post($userId);

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

			$posting = $this->adm->password_post($userId);

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
		$validate = $this->adm->password_validate($this->input->post('oldpass'));

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
	
	//admin update/upload profile piicture
	public function update_image(){
		$userId = $this->session->userdata('id');
		 move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/user_image/' . $userId . '.jpg');			 
			$this->session->set_flashdata('flash_message' , 'Picture Updated Successfully!');
			redirect ('admin/profile','refresh');
	}
	
	//admin update/upload logo picture
	public function update_logo_image(){
		$logo_id = "logo";
		 move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo_image/' . $logo_id . '.jpg');			 
			$this->session->set_flashdata('flash_message' , 'Logo Updated Successfully!');
			redirect ('admin/settings','refresh');
	}
	

	// validate form inputs in the settings page
	public function validate_setting(){
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'sname',
				'label' => 'System Name',
				'rules' => 'required'
			),
			array(
				'field' => 'abr',
				'label' => 'System Abbreviation',
				'rules' => 'required'
			),
			array(
				'field' => 'address',
				'label' => 'System Address',
				'rules' => 'required'
			),
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|valid_email',
				'errors' => array(
					'valid_email' => 'Please input a valid %s address',
				)
			),
			array(
				'field' => 'phone',
				'label' => 'Phone Number',
				'rules' => 'required|min_length[10]'
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {//form inputs have passed all the validation test

			$posting = $this->adm->settings_post();//post data to model with function setting_post

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Settings Updated Successfully!";
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
	}//end setting function



	// validate social form inputs in the settings page
	public function validate_social(){
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'facebook',
				'label' => 'Facebook Link',
				'rules' => 'required|callback_check_valid_url',
			),
			array(
				'field' => 'twitter',
				'label' => 'Twitter Link',
				'rules' => 'required|callback_check_valid_url',
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {//form inputs have passed all the validation test

			$posting = $this->adm->social_post();//post data to model with function setting_post

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Social Links Updated Successfully!";
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
	}//end social function
	
	//check if social urls are valid
	public function check_valid_url($param)
		{
		    if (!filter_var($param, FILTER_VALIDATE_URL))
		    {
				$this->form_validation->set_message('check_valid_url', 'Input a valid url!');
		        return false;
		    }

		    return true;
		}//end
	
	//load disposes page
	public function logs(){
		$page_data=array(

	        'page_name'  => 'logs',
			'crumb'  => '1',//number of breadcrumbs in header section
	        'page_title' => 'Logs',//page title;
	        'countLogs' => $this->qm->logs('adminCountLogs'),
	        'getLogs' => $this->qm->logs('adminQuery'),
	    	);
        $this->load->view('index', $page_data,'refresh');//load index
	}
	



	// bracket for class controller
}