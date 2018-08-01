<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_c extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		
		// if($this->session->userdata('group_name') !== 'Employee'){
 		// 		redirect('authentication/authen_c/login');
 		// }
 		$this->load->model('common_m');
 		$this->load->model('register_m');
 		$this->load->library('upload');
	}
	public function register_new()
	{

		$data['page_title'] = 'New Register';
		$data['service'] = $this->common_m->get_service();
		$data['nationality'] = $this->common_m->get_register_nationality();
		$data['color'] = $this->common_m->get_vehicle_color();
		$data['province'] = $this->common_m->get_register_province();
		$data['department'] = $this->common_m->get_department();
		$data['mydept']=$this->common_m->get_department_by_staffid($this->session->userdata['emp_num']);
		$data['myid']=$this->session->userdata['emp_num'];
		$data['staff'] = $this->common_m->get_stafflist($data['mydept']);
		//$this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Wrong Username or Password!</strong> Try again... </div>');
		$data['page'] = "'register/register_new_v'";
        $this->load->view("register/register_new_v", $data);
	}
	public function register_list_by_manager($register_status)
	{
		$data['register_list'] = $this->register_m->register_list_by_manager($register_status);
		$data['register_status'] = $this->register_m->get_register_status($register_status);
		//$data['department'] = $this->common_m->get_department_name($department_id);
		$data['page_title'] = $data['register_status'].' Register for All Department!';
		$data['page'] = "'register/register_list_v'";
        $this->load->view("register/register_list_v", $data);
	}
	public function register_list_by_status($department_id,$register_status,$staff_id)
	{
		$data['register_list'] = $this->register_m->register_list_by_status($department_id,$register_status,$staff_id);
		$data['register_status'] = $this->register_m->get_register_status($register_status);
		$data['department'] = $this->common_m->get_department_name($department_id);
		$data['page_title'] = $data['register_status'].' Register for '. $data['department'];
		$data['page'] = "'register/register_list_v'";
        $this->load->view("register/register_list_v", $data);
	}
	public function register_list($department_id,$register_status)
	{
		
		$data['register_list'] = $this->register_m->list_register($department_id,$register_status);
		$data['register_status'] = $this->register_m->get_register_status($register_status);
		$data['department'] = $this->common_m->get_department_name($department_id);
		$data['page_title'] = $data['register_status'].' Register for '. $data['department'];
		$data['page'] = "'register/register_list_v'";
        $this->load->view("register/register_list_v", $data);
	}
	
	public function register_list_by_staff($staff_id)
	{
		$data['page_title'] = 'Register List Filter by User';
	 	$cri = array(
            'status_id'  => 5,
            'staff_id' => $staff_id
        );
		$data['register_list'] = $this->register_m->list_register_by_cri($cri);
		$data['register_status'] = $this->register_m->get_register_status(2);
		$data['department'] = '';
		$data['page'] = "'register/register_list_v'";
        $this->load->view("register/register_list_v", $data);
	}
	public function register_view($register_id)
	{
		$data['page_title'] = 'Register View';
		$data['reg'] = $this->register_m->register_info($register_id);
		$data['department'] = $this->common_m->get_department();
		$data['solution'] = $this->common_m->get_register_solution($data['reg']['department_id']);
		$data['staff'] = $this->common_m->get_stafflist($data['reg']['department_id']);
		$data['note_list'] = $this->register_m->register_note_list($register_id);
		$data['files']=$this->register_m->getRows($register_id);
		$data['myid']=$this->session->userdata['emp_num'];
        $this->load->view("register/register_view_v", $data);
	}
	public function register_search_submit()
	{
		$data1 = $this->input->post();
		$cri="register_id<>''";
		foreach ($data1 as $key => $value) {
		    // $arr[3] will be updated with each value from $arr...
		    //if($key=='department'&&$value!='') $cri.=' and department_id='.$value;
		    if($key=='phone'&&$value!='') $cri.=" and phone='".$value."'";
		    if($key=='last_name'&&$value!='') $cri.=" and last_name='".$value."'";
		    if($key=='first_name'&&$value!='') $cri.=" and first_name='".$value."'";
		    if($key=='driver_id'&&$value!='') $cri.=" and driver_id='".$value."'";
		    if($key=='vehicle_plate'&&$value!='') $cri.=" and vehicle_plate='".$value."'";
		    //if($key=='staff'&&$value!='') $cri.=" and staff_id=".$value;
		    //if($key=='date_of_birth'&&$value!='') $cri.=" and DATE_FORMAT(date_of_birth,'%Y-%m-%d') >='".date('Y-m-d',strtotime($value))."'";
		    //if($key=='date_from'&&$value!='') $cri.=" and DATE_FORMAT(create_date,'%Y-%m-%d') >='".date('Y-m-d',strtotime($value))."'";
		    //if($key=='date_to'&&$value!='') $cri.=" and DATE_FORMAT(create_date,'%Y-%m-%d') <='".date('Y-m-d',strtotime($value))."'";
		}
		$mydept=$this->common_m->get_department_by_staffid($this->session->userdata['emp_num']);
		
		if($cri=="register_id<>''")
		{
			redirect("register/register_search_v");
		}else{
			if($mydept==1) $cri.=' and create_by_staff_id in(SELECT emp_num FROM tbl_employee_department WHERE department_id=1)';
			$result=$this->register_m->list_register_by_cri($cri);
			echo json_encode($result);
		}
	}
	public function register_search()
	{
		$data['page_title'] = 'Register Search';
		$data['department'] = $this->common_m->get_department();
		$data['my_department'] = $this->common_m->get_department_by_staffid($this->session->userdata['emp_num']);	
		$data['myid']=$this->session->userdata['emp_num'];
		$data['staff'] = $this->common_m->get_stafflist($data['my_department']);
        $this->load->view("register/register_search_v",$data);
	}

	public function register_create()
	{
		$data = $this->input->post();
		$result = $this->register_m->register_create($data);
		if($result != false)
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-success">You have added form successfully! with registerid '.$result.'</div>');
			redirect('register/register_c/register_view/'.$result);
		}
	}

	public function register_reassign($id)
	{
		$data = $this->input->post();
		$cri = array('register_id' => $id);
		$result = $this->register_m->register_reassign_m($data,$cri);
		if($result != false)
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-success">You have reassigned registration successfully! </div>');
			redirect('register/register_c/register_view/'.$id);
		}
	}

	public function register_dispatch($id)
	{
		$data = $this->input->post();
		$cri = array('register_id' => $id);
		$result = $this->register_m->register_dispatch($data,$cri);
		if($result != false)
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-success">You have dispatched registration successfully! </div>');
			redirect('register/register_c/register_view/'.$id);
		}
	}

	public function register_reject($id)
	{
		$data = $this->input->post();
		$cri = array('register_id' => $id);
		$result = $this->register_m->register_reject($data,$cri);
		if($result != false)
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-success">You have closed registration successfully! </div>');
			redirect('register/register_c/register_view/'.$id);
		}
	}
	public function register_done($id)
	{
		$data = $this->input->post();
		$cri = array('register_id' => $id);
		$result = $this->register_m->register_done($data,$cri);
		if($result != false)
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-success">You have done registration successfully!</div>');
			redirect('register/register_c/register_view/'.$id);
		}
	}

	public function register_note($id)
	{
		$data = $this->input->post();
		$result = $this->register_m->register_note($data,$id);
		if($result != false)
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-success">You have added note to  registration successfully! </div>');
			redirect('register/register_c/register_view/'.$id);
		}
	}
	public function check_data_form($driver_id,$phone,$plate)
	{
		$check_driver_id = $this->common_m->check_exist_data_driver_id($driver_id);
		$check_phone = $this->common_m->check_exist_data_phone($phone);
		$check_plate = $this->common_m->check_exist_data_plate_id($plate);
		$message = '';
		if($check_driver_id == true && $check_phone == true && $check_plate == true){
			$message ='Your driver ID, Phone and Plate number Already exists...!';
		} else if ($check_driver_id == true && $check_phone == true && $check_plate == false){
			$message ='Driver ID and Phone Number Already exists...!';
		} else if ($check_phone == false && $check_driver_id == true && $check_plate == true){
			$message ='Driver Id and Plate Number Already exists...!';
		} else if ($check_phone == true && $check_driver_id == false && $check_plate == true){
			$message ='Phone number and Plate Number Already exists...!';
		} else if ($check_phone == true && $check_driver_id == false && $check_plate == false){
			$message ='phone number Already exists...!';
		} else if ($check_phone == false && $check_driver_id == false && $check_plate == true){
			$message ='Plate number Already exists...!';
		} else if ($check_phone == false && $check_driver_id == true && $check_plate == false){
			$message ='Driver ID Already exists...!';
		} else {
			$message = '';
		}

		if($message != ''){
			$arraData = array(
				'message' => $message,
				'status'  => false
			);
			echo json_encode($arraData);
		} else {
			$data = $this->input->post();
			$result = $this->register_m->register_create($data);
			$arraData = array(
				'id' => $result,
				'status' => true
			);
			if($result != false)
			{
				// $this->session->set_flashdata('msg', '<div class="alert alert-success">You have done registration successfully!</div>');
				// redirect('register/register_c/register_view/'.$id);
				echo json_encode($arraData);
			}
		}
	}

	public function get_stafflist($department_id)
    {
        echo json_encode($this->common_m->get_stafflist($department_id));
	}

	public function get_district($province_id)
    {
        echo json_encode($this->common_m->get_district($province_id));
	}

	public function get_commune($district_id)
    {
        echo json_encode($this->common_m->get_commune($district_id));
	}
	public function get_vehicle_model($service_id)
    {
        echo json_encode($this->common_m->get_vehicle_model($service_id));
	}
	public function check_exist_data_driver_id($driver_id)
	{
			echo json_encode($this->common_m->check_exist_data_driver_id($driver_id));
	}
	public function check_exist_data_plate_id($plate)
	{
			echo json_encode($this->common_m->check_exist_data_plate_id($plate));
	}
	public function check_exist_data_phone($phone)
	{
			echo json_encode($this->common_m->check_exist_data_phone($phone));
	}
}
