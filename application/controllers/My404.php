<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//login class
class My404 extends CI_Controller {

public function __construct(){
	
		//set errors to false
		error_reporting(0);
		//load default constructors
		parent:: __construct();
	}
	
	public function index()
	{
		$this->output->set_status_header('404');
		$this->load->view('err404');
	}
	
	
//end of class My404
}