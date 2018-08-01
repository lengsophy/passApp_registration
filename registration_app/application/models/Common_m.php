<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * This is user class/model for main-menu of My Profile
 */
class Common_m extends CI_Model {

    public function __construct()
	{
		parent::__construct();

	}

    public function get_service()
    {
        $cri = array('status'=>1);
        $this->db->order_by('name asc');
        $q = $this->db->get_where('tbl_service', $cri);
        return $q->result();
    }
    public function get_register_province()
    {
        $cri = array('count_code'=>36);
        $this->db->order_by('pro_name_en asc');
        $q = $this->db->get_where('tbl_province', $cri);
       
        return $q->result();
    }
    public function get_register_solution($department_id)
    {
        $cri = array('status'=>1,'department_id'=>$department_id);
        $this->db->order_by('name asc');
        $q = $this->db->get_where('tbl_ticket_solution', $cri);
       
        return $q->result();
    }
    public function get_department()
    {
        $cri = array('status'=>1);
        $this->db->order_by('name asc');
        $q = $this->db->get_where('tbl_register_department', $cri);
       
        return $q->result();
    }
    public function get_all_department_name()
    {
        $this->db->select("name dept_name");
        $cri = array('status'=>1);
        $this->db->order_by('name asc');
        $q = $this->db->get_where('tbl_register_department', $cri);
        return $q->result();
    }
    public function get_department_by_staffid($staff_id)
    {
        $cri = array('emp_num'=>$staff_id);
        $q = $this->db->get_where('tbl_employee_department', $cri);
        if ($q->num_rows() > 0) {
             return $q->row()->department_id;
         }
         return false;
    }
    public function get_department_name($department_id)
    {
        $cri = array('id'=>$department_id);
        $this->db->select("name");
        $this->db->from('tbl_register_department');
        $this->db->where($cri);
        $q = $this->db->get();
        //$row = mysql_fetch_array($q);
        if ($q->num_rows() > 0) {
             return $q->row()->name;
         }
         return false;
    }
    public function get_staff_name($emp_num)
    {
        $cri = array('p.emp_num'=>$emp_num);
        $this->db->select("CONCAT(p.emp_firstname,' ',p.emp_lastname) name");
        $this->db->from('tbl_personal_detail p');
        $this->db->where($cri);
        $q = $this->db->get();
        //$row = mysql_fetch_array($q);
        if ($q->num_rows() > 0) {
             return $q->row()->name;
         }
         return false;
    }
    public function get_user_info_by_staff_id($emp_num)
    {
        $cri = array('u.emp_num'=>$emp_num);
        $this->db->select("*");
        $this->db->from('tbl_user u');
        $this->db->where($cri);
        $q = $this->db->get();
        //$row = mysql_fetch_array($q);
        if ($q->num_rows() > 0) {
             return $q->row();
         }
         return false;
    }

    public function get_chat_id($emp_num)
    {
        $cri = array('emp_num'=>$emp_num);
        $this->db->select("telegram_chat_id");
        $this->db->from('tbl_user');
        $this->db->where($cri);
        $q = $this->db->get();
        //$row = mysql_fetch_array($q);
        if ($q->num_rows() > 0) {
             return $q->row()->telegram_chat_id;
         }
         return false;
    }

    public function get_stafflist($department_id)
    {
        $this->db->select("u.emp_num,CONCAT(p.emp_firstname,' ',p.emp_lastname) name");
        $this->db->from('tbl_user u');
        $this->db->join('tbl_employee e','u.emp_num = e.emp_num','inner');
        $this->db->join('tbl_personal_detail p','e.emp_num = p.emp_num','inner');
        $this->db->join('tbl_employee_department ed','e.emp_num = ed.emp_num','inner');
        $this->db->join('tbl_register_department d','ed.department_id = d.id','inner');
        $cri = array('status'=>1,'user_status'=>1,'d.id'=>$department_id);
        $this->db->where($cri);
        $this->db->order_by('emp_firstname asc');
        $q = $this->db->get();  
        return $q->result();
    }

    public function get_district($province_id)
    {
        $this->db->select("dis.dis_id,dis.dis_name_en,dis.dis_name_kh,dis.pro_id");
        $this->db->from('tbl_district dis');
        $cri = array('dis.pro_id'=>$province_id);
        $this->db->where($cri);
        $this->db->order_by('dis_name_en asc');
        $q = $this->db->get();  
        return $q->result();
    }

    public function get_commune($district_id)
    {
        $this->db->select("com.com_id,com.com_name_en,com.com_name_kh,com.dis_id");
        $this->db->from('tbl_commune com');
        $cri = array('com.dis_id'=>$district_id);
        $this->db->where($cri);
        $this->db->order_by('com_name_en asc');
        $q = $this->db->get();  
        return $q->result();
    }

    public function get_vehicle_color()
    {
        $this->db->select("col.id,col.name");
        $this->db->from('tbl_color col');
        $this->db->order_by('name asc');
        $q = $this->db->get();  
        return $q->result();
    }
    public function get_vehicle_model($service_id)
    {
        $this->db->select("vm.id,vm.name");
        $this->db->from('tbl_vehicle_model vm');
        $cri = array('vm.service_id'=>$service_id);
        $this->db->where($cri);
        $this->db->order_by('name asc');
        $q = $this->db->get();  
        return $q->result();
    }
    public function get_register_nationality()
    {
        $this->db->select("na.id,na.name");
        $this->db->from('tbl_nationality na');
        $this->db->order_by('name asc');
        $q = $this->db->get();  
        return $q->result();
    }
    public function check_exist_data_driver_id($driver_id)
    {
        $this->db->select("re.phone,re.driver_id,re.vehicle_plate");
        $this->db->from('tbl_register re');
        $cri = array('re.driver_id'=>$driver_id);
        $this->db->where($cri);
        $this->db->order_by('name asc');
        $q = $this->db->get();  
        if ($q->num_rows() > 0) {
            return true;
        }
        return false;
    }
    public function check_exist_data_plate_id($plate)
    {
        $this->db->select("re.phone,re.driver_id,re.vehicle_plate");
        $this->db->from('tbl_register re');
        $cri = array('re.vehicle_plate'=>$plate);
        $this->db->where($cri);
        $this->db->order_by('name asc');
        $q = $this->db->get();  
        if ($q->num_rows() > 0) {
            return true;
        }
        return false;
    }
    public function check_exist_data_phone($phone)
    {
        $this->db->select("re.phone,re.driver_id,re.vehicle_plate");
        $this->db->from('tbl_register re');
        $cri = array('re.phone'=>$phone);
        $this->db->where($cri);
        $this->db->order_by('name asc');
        $q = $this->db->get();  
        if ($q->num_rows() > 0) {
            return true;
        }
        return false;
    }
    // public function check_data_form($driver_id,$phone,$plate)
	// {
    //     $this->db->select("re.phone,re.driver_id,re.vehicle_plate");
    //     $this->db->from('tbl_register re');
    //     $cri = array('re.phone'=>$phone);
    //     $this->db->where($cri);
    //     $this->db->order_by('name asc');
    //     $q = $this->db->get();  
    //     if ($q->num_rows() > 0) {
    //         return true;
    //     }
    //     return false;
	// }
}