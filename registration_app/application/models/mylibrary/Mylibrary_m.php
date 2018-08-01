<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * This is user class/model for main-menu of My Profile
 */
class Mylibrary_m extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}

	public function insert_system_logs($logs)
	{
		$this->db->insert('tbl_system_logs', $logs);
	}

	public function check_password_user($oldpass,$newpass,$userid){

		 $query = $this->db->get_where('tbl_user',array('user_id' => $userid ));
		 $row = $query->row_array();

		 	

			$hashold = hash('ripemd160', $oldpass);
			$password_encry_old = sha1($hashold);


		 if($row['user_password'] == $password_encry_old){

		 	$result = $this->update_password_user($newpass,$userid);
		 	return $result;
		 }else{
		 	return $result = 2;
		 }

	}

	private function update_password_user($newpass,$userid){
		$hash = hash('ripemd160', $newpass);
		$password_encry = sha1($hash);

		$data = array(
               'user_password' => $password_encry,
            );

		$this->db->where(array('user_id' => $userid, 'user_status' => '1'));
		$this->db->update('tbl_user', $data);
		return $this->db->affected_rows(); 
	}


	public function check_exist_email($email){
		$query = $this->db->get_where('tbl_user',array('user_name' => $email,'user_status' => 1));
		return $query->row_array();

	}

	public function update_status_user($email,$random_code){
		$data = array(
               'reset_pass' => 'one',
               'random_code' => $random_code
            );

		$this->db->where(array('user_name' => $email, 'user_status' => '1'));
		$this->db->update('tbl_user', $data);

	}



	public function check_exist_email_by_random_code($random_code){
		$query = $this->db->get_where('tbl_user',array('random_code' => $random_code,'user_status' => 1));
		return $query->row_array();

	}

	public function check_exist_send_email($email){
		$query = $this->db->get_where('tbl_user',array('reset_pass' => 'one','user_status' => 1,'user_name' => $email));
		return $query->row_array();

	}

	public function update_password_by_link($random_code,$newpass){
		$hash = hash('ripemd160', $newpass);
		$password_encry = sha1($hash);

		$data = array(
               'reset_pass' => 'zero',
               'user_password' => $password_encry
            );

		$this->db->where(array('user_status' => '1', 'random_code' => $random_code));
		$this->db->update('tbl_user', $data);
		$result = $this->db->affected_rows();
		return $result;

	}


	public function update_password_next_login_by_id($newpass){

		$id = $this->session->userdata('user_id');
		$data = array(
               'change_password_next_login' => '0',
               'user_password' => $newpass
            );

		$this->db->where(array('user_status' => '1','user_id' => $id));
		$this->db->update('tbl_user', $data);
		$result = $this->db->affected_rows();
		return $result;
	}

	public function get_emp_info_user_login($id)
    {
    	$cri = array('tbl_user.user_id'=>$id);
    	$this->db->select('*');
    	$this->db->from('tbl_user');
    	$this->db->join('tbl_personal_detail','tbl_user.emp_num = tbl_personal_detail.emp_num','left');
    	$this->db->join('tbl_employee','tbl_user.emp_num = tbl_employee.emp_num');
        $this->db->join('tbl_working_location', 'tbl_employee.working_location_id=tbl_working_location.working_location_id', 'left');
        $this->db->join('tbl_job_title', 'tbl_employee.job_title_id=tbl_job_title.job_title_id', 'left');
    	$this->db->where($cri);
        $q = $this->db->get();
        return $q->row_array();
	}
    public function get_manager($cri)
    {
        $this->db->select('emp_num');
        $this->db->from('tbl_employee');
        $this->db->where($cri);
        $q = $this->db->get();
        return $q->result();
    }
    public function get_div_up($cri)
    {
        $this->db->select('div_up_id');
        $this->db->from('tbl_employee');
        $this->db->where($cri);
        $q = $this->db->get();
        return $q->row_array();
    }





}