<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	//Index Page for this login controller.
	 
	public function __construct(){
		//set errors to false
		error_reporting(0);
		//load default constructors
		parent:: __construct();
		$this->load->model('Login_model','lm');
	}
	
	public function index()
	{

		$page_data=array(

	        'page_name'  => 'login',
		);
		$this->load->view('login', $page_data);
	}
	
	public function login()
	{
		$this->index();
	}
	
	//register
	public function register()
	{

		$page_data=array(

	        'page_name'  => 'register',
		);
		$this->load->view('register', $page_data);
	}
	
	//validate login
	public function validate(){
		
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|valid_email|callback_validate_email',
				
				'errors' => array(
					'required' => 'The Email field is required!',
					)
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required',
				'errors' => array(
					'required' => 'The %s field is required!',
					)
			)
		);

		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<p class="help-block">','</p>');

		if($this->form_validation->run() === true) {			
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$login = $this->lm->login($email, $password);

			if($login) {
				$user_data = array(
					'id' => $login,
					'logged_in' => true
				);

				$this->session->set_userdata($user_data);
				
				//determine role
				$role=$this->db->get_where('login' , array('login_id'=>$login))->row()->role; 
				
				//if admin				
				if($role=='admin'){
					$validator['success'] = true;
					$validator['messages'] = "admin/dashboard";
				}
				// if user is client
				else{
					$validator['success'] = true;
					$validator['messages'] = "client/dashboard";
				}
			}	
			else {
				$validator['success'] = false;
				$validator['messages'] = "<i class='ti-info-alt'></i> Your Password is Incorrect!";
			} // /else

		} 	
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);
			}			
		} // /else

		echo json_encode($validator);
	} // /validate function

	public function validate_email()
	{
		$validate = $this->lm->validate_email($this->input->post('email'));

		if($validate === true) {
			return true;
		} 
		else {
			$this->form_validation->set_message('validate_email', 'This user does not exist!');
			return false;			
		} // /else
	} // /validate username function
	

	
	//Register client
	public function register_client(){
		
		$validator = array('success' => false, 'messages' => array());

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
		$this->form_validation->set_error_delimiters('<p id="reg" class="help-block">','</p>');

		if($this->form_validation->run() === true) {

			$reg = $this->lm->register();

			if($reg === true) {
				$validator['success'] = true;
				$validator['messages'] = "You have been successfully registered. Login to continue.";
			}	
			else {
				$validator['success'] = false;
				$validator['messages'] = "<i class='ti-info-alt'></i> There was an error while posting your data!";
			} // /else

		} 	
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);
			}			
		} // /else

		echo json_encode($validator);
	} // /validate function

	//verify password
	public function password_check($pwd){
		if (preg_match('#[0-9]#', $pwd) && preg_match('#[a-zA-Z]#', $pwd)) {
		     return TRUE;
		 }
		 $this->form_validation->set_message('password_check', '%s should contain both letters and numbers!');
		 return false;

	}
	
	
	
	// bracket for class controller
}
