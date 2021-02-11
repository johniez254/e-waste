<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	//Index Page for this login controller.
	 
	public function __construct(){
		//set errors to false
		error_reporting(0);
		//load default constructors
		parent:: __construct();
		$this->load->model('Login_model','lm');
}


	public function system_settings($param){
		//get sytem settings
		$settings_id=$this->db->get_where('settings', array('setting_id' => 1));
		foreach($settings_id->result() as $row):
			$id=$row->setting_id;
			$sname=$row->system_name;
			$abbr=$row->system_abbr;
			$address=$row->system_address;
			$em=$row->system_email;
			$phone=$row->system_phone;
			$facebook=$row->link_facebook;
			$twitter=$row->link_twitter;
		endforeach;

		if($param=="system_name"){
			return $sname;
		}
		if($param=="system_abbr"){
			return $abbr;
		}
		if($param=="system_address"){
			return $address;
		}
		if($param=="system_email"){
			return $em;
		}
		if($param=="system_phone"){
			return $phone;
		}
		if($param=="link_facebook"){
			return $facebook;
		}
		if($param=="link_twitter"){
			return $twitter;
		}
	}
	
	public function index()
	{
		//set errors to false
		error_reporting(0);
		
		$this->load->dbutil();
		 	
		 	//set errors to false
			error_reporting(0);
		
			// if ($this->dbutil->database_exists('ewaste'))//modify this line to manually add your database name
			// 	{

					$page_data=array(

				        'page_name'  => 'homepage',
				        'system_name'  => $this->system_settings("system_name"),
				        'system_abbr'  => $this->system_settings("system_abbr"),
				        'system_phone'  => $this->system_settings("system_phone"),
				        'system_phone'  => $this->system_settings("system_phone"),
				        'system_email'  => $this->system_settings("system_email"),
				        'system_address'  => $this->system_settings("system_address"),
				        'link_facebook'  => $this->system_settings("link_facebook"),
				        'link_twitter'  => $this->system_settings("link_twitter"),
				        'link_image'  => $this->system_settings("link_twitter"),
					);
					$this->load->view('homepage', $page_data);
				// }
			// else{
			// 		redirect(base_url() . 'install/index.php?o=require', 'refresh');
			// }
	}
	
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url()."login","refresh");
	}

	// bracket for class controller
}
