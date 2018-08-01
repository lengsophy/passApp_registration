<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* This is the main class of this project
*/
class Main_c extends CI_Controller {


	public function index()
	{
        redirect('authentication/authen_c/login', 'refresh');
	}
}
