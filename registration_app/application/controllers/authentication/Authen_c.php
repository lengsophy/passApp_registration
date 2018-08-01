<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Authen_c extends CI_Controller {

	public function __construct()
	{

		parent::__construct();
		$this->load->model('authentication/authen_m');
		$this->load->library('mylibrary');
        $this->load->model('common_m');

	}

	public function login(){
		if($this->session->userdata('group_name')== 'System admin'){
			redirect('admin/user_list_admin_c/');
		}elseif($this->session->userdata('group_name')== 'HR'){
			redirect('hr/dashboard_hr_c');
		}elseif ($this->session->userdata('group_name')== 'Manager') {
			redirect('manager/dashboard_manager_c');
		}elseif ($this->session->userdata('group_name')== 'Employee') {
			redirect('user/dashboard_user_c');
		}else{
			$this->load->view('login_v');
		}


	}

	function verify_user()
	{

		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$hash = hash('ripemd160', $password);

		$password_encry = sha1($hash);

		$user = $this->authen_m->validate_user($username,$password_encry);

		$newdata = array(
		'user_id' => $user['user_id'],
		'user_name' => $user['user_name'],
		'group_name' => $user['group_name'],
		'change_password_next_login' => $user['change_password_next_login'],
		'emp_num' => $user['emp_num'],
		'staff_name' => $this->common_m->get_staff_name($user['emp_num']),
		'my_department_id' => $this->common_m->get_department_by_staffid($user['emp_num']),
		'menu_department' => '');

		if($user['group_name'] == 'System admin'){
			if($user['change_password_next_login'] == 1){
				@$this->session->set_userdata($newdata);
					if(!$this->session->userdata()){
						redirect('authentication/authen_c/login');
							$action = 'Login as System Admin';
							$type = 'Login';
							$this->mylibrary->do_system_logs($action,$type);
					}else{
						$this->reset_password_on_next_login();
					}

			}else{
				@$this->session->set_userdata($newdata);

							$action = 'Login as System Admin';
							$type = 'Login';
							$this->mylibrary->do_system_logs($action,$type);
				redirect('admin/user_list_admin_c/');
			}

		}elseif($user['group_name'] == 'HR'){
			if($user['change_password_next_login'] == 1){
				@$this->session->set_userdata($newdata);
					if(!$this->session->userdata()){
						redirect('authentication/authen_c/login');
							$action = 'Login as HR';
							$type = 'Login';
							$this->mylibrary->do_system_logs($action,$type);
					}else{
						$this->reset_password_on_next_login();
					}

			}else{
				@$this->session->set_userdata($newdata);
							$action = 'Login as HR';
							$type = 'Login';
							$this->mylibrary->do_system_logs($action,$type);
				redirect('hr/dashboard_hr_c');
			}

		}elseif($user['group_name'] == 'Manager'){
			if($user['change_password_next_login'] == 1){
				@$this->session->set_userdata($newdata);
					if(!$this->session->userdata()){
						redirect('authentication/authen_c/login');
							$action = 'Login as Manager';
							$type = 'Login';
							$this->mylibrary->do_system_logs($action,$type);
					}else{
						$this->reset_password_on_next_login();
					}

			}else{
				@$this->session->set_userdata($newdata);
				$userid = $this->session->userdata('user_id');
							$action = 'Login as Manager';
							$type = 'Login';
							$this->mylibrary->do_system_logs($action,$type);
				redirect('manager/dashboard_manager_c');
			}

		}elseif($user['group_name'] == 'Employee'){
			if($user['change_password_next_login'] == 1){
				@$this->session->set_userdata($newdata);
					if(!$this->session->userdata()){

						redirect('authentication/authen_c/login');
							$action = 'Login as Employee';
							$type = 'Login';
							$this->mylibrary->do_system_logs($action,$type);
					}else{
						$this->reset_password_on_next_login();
					}

			}else{
				@$this->session->set_userdata($newdata);
							$action = 'Login as Employee';
							$type = 'Login';
							$this->mylibrary->do_system_logs($action,$type);
				redirect('user/dashboard_user_c');
			}


		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Wrong Username or Password!</strong> Try again... </div>');
			redirect('authentication/authen_c/login');

		}


	}
	public function logout() {
							$action = 'Logout';
							$type = 'logout';
							$this->mylibrary->do_system_logs($action,$type);

        $newdata = array('user_id', 'user_name', 'group_name', 'change_password_next_login', 'emp_num');
		$this->session->unset_userdata($newdata);
        $this->session->sess_destroy();
        redirect('authentication/authen_c/login','refresh');

    }
}