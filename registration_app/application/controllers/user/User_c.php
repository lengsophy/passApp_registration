<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_c extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		
		if($this->session->userdata('group_name') !== 'Employee'){
 				redirect('authentication/authen_c/login');
 		}
	}

	public function test()
	{
		$this->load->view('user/user_v');
	}
}
