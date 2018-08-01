<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* This is the main class of this project
*/
class Menu_c extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('menu_m');
	}

	public function index()
	{
        
	}
}
