<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * This is user class/model for main-menu of My Profile
 */
class Dashboard_user_m extends CI_Model {
    public $year = "";
    public function __construct()
	{
		parent::__construct();
        $time = now();
        $this->year = mdate('%Y', $time);
	}

    public function get_my_pending_leave_request($emp)
    {
        $cri = array('emp_num'=>$emp, 'request_status_id'=>1);
        $q = $this->db->get_where('tbl_leave_request_records', $cri);
        return $q->num_rows();
    }

    public function get_attendance_problem($emp)
    {
        $cri = array('tbl_attendance_record.emp_num'=>$emp);
        $this->db->select('*');
        $this->db->from('tbl_attendance_record');
        $this->db->join('tbl_employee', 'tbl_employee.emp_num = 
        tbl_attendance_record.emp_num');
        $this->db->join('tbl_attendance_type', 'tbl_attendance_type.attendance_type_id 
        = tbl_employee.attendance_type_id');
        $this->db->where($cri);
        $this->db->order_by('attendance_record_date','DESC');
        $this->db->limit('1');
        $q = $this->db->get();
        return $q->row_array();
    }

    public function get_all_my_attendance($emp_num_member, $today)
    {
        $this->db->select('
        att.*,
        att_type.*,
        lreq.*,
        att_req.*,
        cal.*,
        ');
        $this->db->from('tbl_employee e');
        $this->db->join('tbl_attendance_type att_type','e.attendance_type_id = att_type.attendance_type_id','left');
        $this->db->join('tbl_attendance_normal_record att', 'e.emp_num=att.emp_num', 'left');
        $this->db->join('tbl_leave_request_records lreq','(att.attendance_record_date between lreq.leave_start_date and lreq.leave_end_date) AND (att.emp_num = lreq.emp_num) AND (lreq.leave_type_id != 7)','left');
        $this->db->join('tbl_attendance_request att_req','(e.emp_num=att_req.att_req_requester) AND (att.attendance_record_date BETWEEN att_req.att_req_start_date AND att_req.att_req_end_date)','left');
        $this->db->join('tbl_calendar cal','att.attendance_record_date BETWEEN cal.calendar_start_date AND cal.calendar_end_date','left');
        $this->db->where_in('e.emp_num', $emp_num_member);
        $this->db->where("WEEKOFYEAR(`attendance_record_date`) = WEEKOFYEAR('{$today}')");
        $this->db->where("(DATE_FORMAT(attendance_record_date ,'%Y') =  DATE_FORMAT(NOW() ,'%Y'))");
        $q = $this->db->get();

        return $q->result();
    }

    public function get_all_my_leave($emp_num_member, $today)
    {
        $this->db->select('*');
        $this->db->from('tbl_leave_request_records');
        $this->db->where_in('emp_num',$emp_num_member);
        $this->db->where_not_in('request_status_id',array(3,4));
        $this->db->where('leave_start_date <=',$today);
        $this->db->where('leave_end_date >=',$today);
        $this->db->order_by('leave_start_date', 'desc');
        $q = $this->db->get();
    
        return $q->num_rows();
    }

    public function get_dashboard_leave_balance($emp_num)
    {
        $cri = array(
            'emp_num'=>$emp_num,
            'year'=>$this->year
        );
        $q = $this->db->get_where('tbl_dashboard_leave_balance_monthly', $cri);
        return $q->result();
    }

    public function get_current_annual_leave($emp_num)
    {
        $cri = array(
            'emp_num'=>$emp_num,
            'for_year'=>$this->year,
            'leave_type_id'=>1
        );
        $this->db->select('*');
        $this->db->from('tbl_leave_detail');
        $this->db->where($cri);
        $q = $this->db->get();
        return $q->row_array();
    }

    public function get_current_special_leave($emp_num)
    {
        $cri = array(
            'emp_num'=>$emp_num,
            'for_year'=>$this->year,
            'leave_type_id'=>3
        );
        $this->db->select('*');
        $this->db->from('tbl_leave_detail');
        $this->db->where($cri);
        $q = $this->db->get();
        return $q->row_array();
    }

    public function get_current_sick_leave($emp_num)
    {
        $cri = array(
            'emp_num'=>$emp_num,
            'for_year'=>$this->year,
            'leave_type_id'=>2
        );
        $this->db->select('*');
        $this->db->from('tbl_leave_detail');
        $this->db->where($cri);
        $q = $this->db->get();
        return $q->row_array();
    }

    public function get_up_coming_calendar($today)
    {
        $cri = array('for_year'=>$this->year,'calendar_start_date >' => $today);
        $this->db->select('calendar_title,calendar_start_date');
        $this->db->from('tbl_calendar');
        $this->db->where($cri);
        $this->db->order_by('calendar_start_date', 'ASC');
        $this->db->limit('3');
        $q = $this->db->get();
        return $q->result();
    }
    
    /* Update for eHRMS 2018 */
    
    public function get_leave_detail($cri)
    {
        $this->db->select('*');
        $this->db->from('tbl_leave_detail d');
        $this->db->join('tbl_leave_type t','d.leave_type_id=t.leave_type_id');
        $this->db->where($cri);
        $q = $this->db->get();
    
        return $q->result();
    }
    
    public function get_leave_history($cri)
    {
        $this->db->select('*');
        $this->db->from('tbl_leave_balance_history h');
        $this->db->join('tbl_leave_type t','h.affected_leave_type=t.leave_type_id');
        $this->db->where($cri);
        $this->db->order_by('record_time', 'DESC');
        $this->db->limit('10');
        $q = $this->db->get();
    
        return $q->result();
    }

    public function get_attendance_info(){
        $this->db->select('attendance_record_date');
        $this->db->from('ehrm_tbl_attendance_normal_record');
        $this->db->where('attendance_record_date == now()');
        $q = $this->db->get();
    
        return $q->result();
    }

    public function get_all_my_attendance_byTime($emp_num_member, $time, $type)
    {
        $this->db->select('
        att.*,
        att_type.*,
        lreq.*,
        att_req.*,
        cal.*,
        ');
        $this->db->from('tbl_employee e');
        $this->db->join('tbl_attendance_type att_type','e.attendance_type_id = att_type.attendance_type_id');
        $this->db->join('tbl_attendance_normal_record att', 'e.emp_num=att.emp_num', 'right');
        $this->db->join('tbl_leave_request_records lreq','(att.attendance_record_date between lreq.leave_start_date and lreq.leave_end_date) AND (att.emp_num = lreq.emp_num) AND (lreq.leave_type_id != 7)','left');
        $this->db->join('tbl_attendance_request att_req','(e.emp_num=att_req.att_req_requester) AND (att.attendance_record_date BETWEEN att_req.att_req_start_date AND att_req.att_req_end_date)','left');
        $this->db->join('tbl_calendar cal','att.attendance_record_date BETWEEN cal.calendar_start_date AND cal.calendar_end_date','left');
        $this->db->where_in('e.emp_num', $emp_num_member);
        if ($type === "This Week"){
            $this->db->where("WEEKOFYEAR(`attendance_record_date`) = WEEKOFYEAR('{$time}')");
        }elseif($type === "Today"){
            $this->db->where('attendance_record_date',$time);
        }elseif($type === "This Month"){
            $this->db->where("DATE_FORMAT(attendance_record_date ,'%Y-%m') =  DATE_FORMAT(NOW() ,'%Y-%m')");
        }elseif($type === "This Year"){
            $this->db->where("DATE_FORMAT(attendance_record_date ,'%Y') =  DATE_FORMAT(NOW() ,'%Y')");
        }elseif($type === "By Custom"){
            $this->db->where($time);
        }
        $this->db->order_by('att.attendance_record_date');
        $q = $this->db->get();

        return $q->result();
    }

    public function get_unread_cmd_on_att($cri)
    {

        $this->db->select('*');
        $this->db->from('tbl_attendance_normal_record');
        $this->db->where($cri);
        $q = $this->db->get();
        return $q->num_rows();
    }

    // public function get_missed_att(){
    //     $this->db->select('*');
    //     $this->db->from('')
    // }
}