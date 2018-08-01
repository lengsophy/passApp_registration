<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* This is the main class of this project
*/
class Menu_c extends CI_Controller {


	public function __construct()
	{

		parent::__construct();

	}
	public function set_menu_session($value)
	{
		$newdata = array(
		'menu_department' => $value);
		$this->session->set_userdata($newdata);
	}
}
