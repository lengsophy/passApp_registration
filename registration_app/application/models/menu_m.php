<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_m extends CI_Model {
	public function __construct()
	{
		parent::__construct();
        $this->load->model('register_m');
        
	}

    public function get_menu()
    {
        $data['register_count_dept']=$this->register_m->count_by_dept();
        $query = $this->db->get();
        return $query->result();
	}
}