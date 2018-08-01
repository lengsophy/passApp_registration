<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Driver_c extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		
		// if($this->session->userdata('group_name') !== 'Employee'){
 		// 		redirect('authentication/authen_c/login');
 		// }
 		$this->load->model('common_m');
 		$this->load->model('register_m');
 		$this->load->model('driver_m');
 		$this->load->library('upload');
	}

	public function driver_update()
	{
		$data = $this->input->post();
		$result = $this->driver_m->driver_update($data);
		if($result != false)
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-success">You have udpated form successfully! with Driver ID '.$result.'</div>');
			redirect('driver/driver_c/driver_view/'.$result);
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-success">No data updated! with Driver ID '.$data['driver_id'].'</div>');
			redirect('driver/driver_c/driver_view/'.$data['id']);
		}
	}

	public function driver_search()
	{
		$data['page_title'] = 'Driver Search';
		$data['department'] = $this->common_m->get_department();
		$data['my_department'] = $this->common_m->get_department_by_staffid($this->session->userdata['emp_num']);	
		$data['myid']=$this->session->userdata['emp_num'];
		$data['staff'] = $this->common_m->get_stafflist($data['my_department']);
        $this->load->view("driver/driver_search_v",$data);
	}

	public function driver_search_submit()
	{
		$data1 = $this->input->post();
		$cri="driver_id<>''";
		foreach ($data1 as $key => $value) {
		    // $arr[3] will be updated with each value from $arr...
		    if($key=='driver_id'&&$value!='') $cri.=" and driver_id='".$value."'";
		    if($key=='vehicle_plate'&&$value!='') $cri.=" and vehicle_plate='".$value."'";
		}
	//	$mydept=$this->common_m->get_department_by_staffid($this->session->userdata['emp_num']);
		
		if($cri=="driver_id<>''")
		{
			redirect("driver/driver_search_v");
		}else{
			$result=$this->driver_m->list_driver_by_cri($cri);
			echo json_encode($result);
		}
	}

	public function driver_view($id)
	{
		$data['page_title'] = 'Driver View';
		$data['dri'] = $this->driver_m->driver_info($id);
		$data['service'] = $this->common_m->get_service();
		$data['color'] = $this->common_m->get_vehicle_color();
		$data['province'] = $this->common_m->get_register_province();
		$data['nationality'] = $this->common_m->get_register_nationality();
		$data['department'] = $this->common_m->get_department();
		$data['staff'] = $this->common_m->get_stafflist($data['dri']['department_id']);
		$data['note_list'] = $this->driver_m->driver_note_list($id);
		$data['files']=$this->driver_m->get_driver_img($id);
		$data['myid']=$this->session->userdata['emp_num'];
        $this->load->view("driver/driver_view_v", $data);
	}
}
