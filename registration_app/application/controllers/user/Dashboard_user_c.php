<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Dashboard_user_c extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->library('mylibrary');
            $this->load->model('user/dashboard_user_m');
            $this->load->model('register_m');
            $this->load->model('common_m');
            if ($this->session->userdata('group_name') !== 'Employee') {
                redirect('authentication/authen_c/login');
            }
            
        }

        public function index()
        {
            $data['page'] = "user/dashboard_front_user_v";
            $data['menu'] = "Dashboard";
            $data['page_title'] = 'My Dashboard';
            $cri = array(
                'status_id'  => 3,
                'department_id' => $this->common_m->get_department_by_staffid($this->session->userdata['emp_num']),
                'create_by_staff_id'  => $this->session->userdata['emp_num'],
            );
            $data['department_count_done_system']=$this->register_m->count_register_by_cri($cri);
            $data['department_id']=$this->common_m->get_department_by_staffid($this->session->userdata['emp_num']);
            $cri = array(
                'create_by_staff_id' => $this->session->userdata['emp_num'],
                'status_id' => 5
            );
            $data['system_reject']=$this->register_m->count_register_by_cri($cri);
            $data['all_dept']=json_encode($this->common_m->get_all_department_name());
            $data['count_by_dept']=json_encode($this->register_m->count_register_by_dept_n_status(array('status_id'=>1)));
            $data['userdata'] = $this->session->userdata;
            $cri = array(
                'department_id' => $this->common_m->get_department_by_staffid($this->session->userdata['emp_num']),
                'status_id' => 1
            );
            $data['my_open']=$this->register_m->count_register_by_cri($cri);
            $data['menu_department']=$this->session->userdata('menu_department');
            $cri = array(
                'close_by_staff_id'  => $this->session->userdata['emp_num'],
                'status_id' => 5
            );
            $data['my_rejected']=$this->register_m->count_register_by_cri($cri);
            $this->load->view('user/dashboard_front_user_v', $data);
        }
        public function index2()
        {
            $id = @$this->session->userdata('user_id');
            $data['info'] = $this->mylibrary->get_info_user_login($id);
            $time = now();
            $today = mdate('%Y-%m-%d', $time);
            $emp = $data['info']['emp_num'];
            $data['my_pending_leave_request'] = $this->dashboard_user_m->get_my_pending_leave_request($emp);
            $data['up_coming_calendars'] = $this->dashboard_user_m->get_up_coming_calendar($today);
            // query all my attendance
            $attendance = $this->dashboard_user_m->get_all_my_attendance($emp, $today);
            $early =0;
            $late = 0;
            $on_time = 0;
            $before_time = 0;
            foreach ($attendance as $row) {
                if (($row->my_check_in_time != NULL) && ($row->my_check_in_time <= $row->check_in_time_early_2)) {
                    $early = $early + 1;
                }
                if (($row->my_check_in_time != NULL) && ($row->my_check_in_time > $row->check_in_time_late_1)) {
                    $late = $late + 1;
                }
                if (
                    ($row->my_check_in_time != NULL) && (
                        ($row->my_check_in_time >= $row->check_in_time_ok_1) && ($row->my_check_in_time <= $row->check_in_time_ok_2)
                    )
                ) {
                    $on_time = $on_time + 1;
                }
                if (($row->my_check_out_time != NULL)&&($row->my_check_out_time < $row->check_out_time)) {
                    $before_time = $before_time + 1;
                }
            }
            // query my leave for week
            $leave = $this->dashboard_user_m->get_all_my_leave($emp, $today);
            $data['daily_att'] = array(
                'early'         => $early,
                'late'          => $late,
                'on_time'       => $on_time,
                'before_time'   => $before_time,
                'leave_count'   => $leave
            );
            /* END Daily My Attendance Overview */
            //query leave balance detail
            $cri = array(
                'emp_num'  => $data['info']['emp_num'],
                'for_year' => mdate('%Y', $time)
            );
            $data['leave_detail'] = $this->dashboard_user_m->get_leave_detail($cri);
            //load view
            $data['page'] = "user/dashboard_user_v";
            $data['menu'] = "Dashboard";
            $this->load->view('user/index_user_v', $data);
        }
    }