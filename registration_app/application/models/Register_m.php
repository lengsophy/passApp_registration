<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * This is user class/model for main-menu of My Profile
 */
class Register_m extends CI_Model {

    public function __construct()
	{
        parent::__construct();
        $this->load->model('telegram_m');

	}
    public function list_register($department_id,$register_status)
    {
        $cri = array('d.id'=>$department_id,'re.status_id'=>$register_status);
        $this->db->select("re.register_id,re.first_name,re.last_name,re.gender,re.driver_id,CONCAT(p.emp_firstname,' ',p.emp_lastname) create_by, CONCAT(p2.emp_firstname,' ',p2.emp_lastname) staff,re.create_date,re.phone,re.description,d.name department_name");
        $this->db->from('tbl_register re');
        $this->db->join('tbl_register_department d', 're.department_id=d.id');
        $this->db->join('tbl_employee e', 're.create_by_staff_id=e.emp_num','left');
        $this->db->join('tbl_employee e2', 're.staff_id=e2.emp_num','left');
        $this->db->join('tbl_personal_detail p', 'e.emp_num=p.emp_num','left');
        $this->db->join('tbl_personal_detail p2', 'e2.emp_num=p2.emp_num','left');
        $this->db->where($cri);
        $this->db->order_by('re.create_date','DESC');
        $q = $this->db->get();
        return $q->result();
    }
    public function register_list_by_status($department_id,$register_status,$staff_id)
    {
        if($department_id == 5 && $register_status == 5){
            $cri = array('d.id'=>4,'re.status_id'=>$register_status, 're.close_by_staff_id'=>$staff_id);
        }else {
            $cri = array('d.id'=>$department_id,'re.status_id'=>$register_status, 're.create_by_staff_id'=>$staff_id);
        }
        $this->db->select("re.register_id,re.first_name,re.last_name,re.gender,re.driver_id,CONCAT(p.emp_firstname,' ',p.emp_lastname) create_by, CONCAT(p2.emp_firstname,' ',p2.emp_lastname) staff,re.create_date,re.phone,re.description,d.name department_name");
        $this->db->from('tbl_register re');
        $this->db->join('tbl_register_department d', 're.department_id=d.id');
        $this->db->join('tbl_employee e', 're.create_by_staff_id=e.emp_num','left');
        $this->db->join('tbl_employee e2', 're.staff_id=e2.emp_num','left');
        $this->db->join('tbl_personal_detail p', 'e.emp_num=p.emp_num','left');
        $this->db->join('tbl_personal_detail p2', 'e2.emp_num=p2.emp_num','left');
        $this->db->where($cri);
        $this->db->order_by('re.create_date','DESC');
        $q = $this->db->get();
        return $q->result();
    }
    public function register_list_by_manager($register_status)
    {
        $cri = array(
            're.status_id' => $register_status
        );
        $this->db->select("re.register_id,re.first_name,re.last_name,re.gender,re.driver_id,CONCAT(p.emp_firstname,' ',p.emp_lastname) create_by, CONCAT(p2.emp_firstname,' ',p2.emp_lastname) staff,re.create_date,re.phone,re.description,d.name department_name");
        $this->db->from('tbl_register re');
        $this->db->join('tbl_register_department d', 're.department_id=d.id');
        $this->db->join('tbl_employee e', 're.create_by_staff_id=e.emp_num','left');
        $this->db->join('tbl_employee e2', 're.staff_id=e2.emp_num','left');
        $this->db->join('tbl_personal_detail p', 'e.emp_num=p.emp_num','left');
        $this->db->join('tbl_personal_detail p2', 'e2.emp_num=p2.emp_num','left');
        $this->db->where($cri);
        $this->db->order_by('re.create_date','DESC');
        $q = $this->db->get();
        return $q->result();
    }
    public function list_register_by_cri($cri)
    {
        $this->db->select("re.register_id,re.first_name,re.gender,re.last_name,re.driver_id,CONCAT(p.emp_firstname,' ',p.emp_lastname) create_by,CONCAT(p2.emp_firstname,' ',p2.emp_lastname) staff,re.create_date,re.phone,st.name status_name,re.description,d.name department_name");
        $this->db->from('tbl_register re');
        $this->db->join('tbl_register_department d', 're.department_id=d.id');
        $this->db->join('tbl_register_status st', 're.status_id=st.id');
        $this->db->join('tbl_employee e', 're.create_by_staff_id=e.emp_num','left');
        $this->db->join('tbl_employee e2', 're.staff_id=e2.emp_num','left');
        $this->db->join('tbl_personal_detail p', 'e.emp_num=p.emp_num','left');
        $this->db->join('tbl_personal_detail p2', 'e2.emp_num=p2.emp_num','left');
        $this->db->where($cri);
        $q = $this->db->get();
        return $q->result();
    }
    public function count_by_dept()
    {
        $cri = array('1','2','3','4');
        $this->db->select("re.department_id,d.name,count(*) no_register");
        $this->db->from('tbl_register re');
        $this->db->join('tbl_register_department d','re.department_id=d.id');
        $this->db->where_in('re.status_id',$cri);
        $this->db->group_by('re.department_id,d.name');
        $this->db->order_by('d.name','ASC');
        $q = $this->db->get();
        return $q->result();
    }

    public function count_register_by_dept_n_status($cri)
    {
        $this->db->select("count(*) no_register");
        $this->db->from('tbl_register re');
        $this->db->join('tbl_register_department d','re.department_id=d.id','left');
        $this->db->where_in('re.status_id',$cri);
        $this->db->group_by('re.department_id,d.name');
        $this->db->order_by('d.name','ASC');
        $q = $this->db->get();
        return $q->result();
    }

    public function count_register_by_cri($cri)
    {
        $this->db->select("count(*) no_register");
        $this->db->from('tbl_register');
        $this->db->where($cri);
        $q = $this->db->get();
        
        if ($q->num_rows() > 0) {
             return $q->row()->no_register;
         }
         return false;
    }

    public function count_by_status($department_id,$register_status)
    {
        $cri = array('re.department_id'=>$department_id,'re.status_id'=>$register_status);
        $this->db->select("count(*) no_register");
        $this->db->from('tbl_register re');
        $this->db->where($cri);
        $q = $this->db->get();
        
        if ($q->num_rows() > 0) {
             return $q->row()->no_register;
         }
         return false;
    }

    public function register_info($register_id)
    {
        $cri = array('re.register_id'=>$register_id);
        $this->db->select("re.register_id,re.first_name,re.last_name,re.name,re.status_id,re.gender,na.id nationality_id,na.name nationality_name,re.date_of_birth,re.id_card_number,re.driver_id,re.house_number,re.street,re.province,re.district,re.commune,re.village,re.vehicle_plate, re.vehicle_model_year,col.name vehicle_color_name,col.id vehicle_color_id,vm.id vehicle_model_id ,vm.name vehicle_model_name,re.id_card_status,re.drive_licences_status,re.vehicle_iden_status,re.family_book_status,re.residen_book_status,re.accredit_book_status,re.create_by_staff_id,CONCAT(p2.emp_firstname,' ',p2.emp_lastname) staff,re.create_date,re.phone,re.description,d.name department_name,s.name service_name,s.id service_id,pro.pro_name_kh province,pro.pro_id, dis.dis_name_kh district,dis.dis_id,com.com_name_kh commune,com.com_id,CONCAT(p1.emp_firstname,' ',p1.emp_lastname) create_by,d.id department_id,re.staff_id");
        $this->db->from('tbl_register re');
        $this->db->join('tbl_register_department d', 're.department_id=d.id');
        $this->db->join('tbl_employee e', 're.staff_id=e.emp_num','left');
        $this->db->join('tbl_personal_detail p2', 'e.emp_num=p2.emp_num','left');
        $this->db->join('tbl_employee e1', 're.create_by_staff_id=e1.emp_num','inner');
        $this->db->join('tbl_personal_detail p1', 'e1.emp_num=p1.emp_num','inner');
        $this->db->join('tbl_service s', 're.service_id=s.id','left');
        $this->db->join('tbl_province pro', 'pro.pro_id=re.province','left');
        $this->db->join('tbl_district dis', 'dis.dis_id=re.district','left');
        $this->db->join('tbl_commune com', 'com.com_id=re.commune','left');
        $this->db->join('tbl_nationality na', 're.nationality_id=na.id','left');
        $this->db->join('tbl_color col', 're.vehicle_color_id=col.id','left');
        $this->db->join('tbl_vehicle_model vm', 're.vehicle_model_id=vm.id','left');
        $this->db->where($cri);
        $q = $this->db->get();
        return $q->row_array();
    }
    public function register_note_list($register_id)
    {
        $cri = array('re.register_id'=>$register_id);
        $this->db->select("re.description,re.note_date,CONCAT(p1.emp_firstname,' ',p1.emp_lastname) create_by");
        $this->db->from('tbl_register_note re');
        $this->db->join('tbl_employee e1', 're.note_by_staff_id=e1.emp_num','inner');
        $this->db->join('tbl_personal_detail p1', 'e1.emp_num=p1.emp_num','inner');
        $this->db->where($cri);
        $this->db->order_by('re.note_date','DESC');
        $q = $this->db->get();
        return $q->result();
    }

    public function get_register_status($register_status)
    {
        $cri2 = array('id'=>$register_status);
        $this->db->select("name");
        $this->db->from('tbl_register_status');
        $this->db->where($cri2);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
             return $q->row()->name;
         }
         return false;
    }

    public function register_create($data)
    {   
        $last_date  = date('Y-m-d H:i:s', strtotime('-18 years'));
        $date_of_birth = date('Y-m-d H:i:s', strtotime($data['date_of_birth']));
        $temp_data = array(
            'first_name'     => $data['first_name'],
            'last_name'      => $data['last_name'],
            'name'           => $data['last_name'].' '.$data['first_name'],
            'gender'         => $data['gender'],
            'nationality_id' => $data['nationality_id'],
            'date_of_birth'  => $date_of_birth <= $last_date ? $date_of_birth : $last_date,
            'id_card_number' => $data['id_card_number'],
            'house_number'   => $data['house_number'],
            'street'         => $data['street'],
            'province'       => $data['province'],
            'district'       => (!isset($data['district']) || is_null($data['district']))?0:$data['district'],
            'commune'        => (!isset($data['commune']) || is_null($data['commune']))?0:$data['commune'],
            'village'        => $data['village'],
            'phone'          => $data['phone_number'],
            'driver_id'      => $data['driver_id'],
            'id_card_status'          => (!isset($data['id_card_status']) || is_null($data['id_card_status']))?0:1,
            'drive_licences_status'   => (!isset($data['drive_licences_status']) || is_null($data['drive_licences_status']))?0:1,
            'vehicle_iden_status'     => (!isset($data['vehicle_iden_status']) || is_null($data['vehicle_iden_status']))?0:1,
            'family_book_status'      => (!isset($data['family_book_status']) || is_null($data['family_book_status']))?0:1,
            'residen_book_status'     => (!isset($data['residen_book_status']) || is_null($data['residen_book_status']))?0:1,
            'accredit_book_status'    => (!isset($data['accredit_book_status']) || is_null($data['accredit_book_status']))?0:1,
            //-- Vehicle information --
            'vehicle_plate'           => $data['plate'],
            'vehicle_model_year'      => $data['model_year'],
            'vehicle_color_id'        => $data['vehicle_color_id'],
            'vehicle_model_id'        => $data['vehicle_model_id'],
            //-- Complaint Information --
            'department_id'  => 5,
            'service_id'     => $data['service'],
            'create_date'    => date("Y-m-d H:i:s"),
            'status_id'      => 1,
            'create_by_staff_id' => $this->session->userdata["emp_num"]
        );
        $this->db->insert('tbl_register', $temp_data);

        if ($this->db->affected_rows() > 0)//check if query run successful
        {
            //$this->session->set_flashdata('msg', $_FILES['files']['name'][0]);
            $register=$this->db->insert_id();
            $staff_id = $this->session->userdata['emp_num'];
            $reg=$this->register_info($register);
            $staff_name=$this->common_m->get_staff_name($staff_id);
            $res=$this->common_m->get_stafflist(5);
            if($res) 
            {
                foreach($res as $row)
                {   
                   $this->telegram_m->sendMessage($this->common_m->get_chat_id($row->emp_num),"<pre>New Register!</pre>From ".$staff_name."\nDriver ID: ".$reg['driver_id']."\nPhone: ".$reg['phone']."\nColor: ".$reg['vehicle_color_name']."\nPlate: ".$reg['vehicle_plate']."\nService: ".$reg['service_name']."\nModel: ".$reg['vehicle_model_name']."\nYear: ".$reg['vehicle_model_year']."\n".'<a href="'.base_url("index.php/register/register_c/register_view/".$reg["register_id"].'">Click here to view</a>'));

                }
            }
            $this->upload_file($register);
            return $register;
        }
        else
            return false;
    }
    private function upload_file($id)
    {
        $data = array();
        // If file upload form submitted
        if(!empty($_FILES['files']['name'])){
            $filesCount = count($_FILES['files']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['file']['name']     = $_FILES['files']['name'][$i];
                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error']     = $_FILES['files']['error'][$i];
                $_FILES['file']['size']     = $_FILES['files']['size'][$i];
                
                // File upload configuration
                $uploadPath = 'uploads/files/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                
                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                // Upload file to server
                if($this->upload->do_upload('file')){
                    // Uploaded file data
                    $fileData = $this->upload->data();
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
                    $uploadData[$i]['register_id'] = $id;
                    $uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
                }
            }
            
            if(!empty($uploadData)){
                // Insert files data into the database
                $insert = $this->insert($uploadData);
                
                // Upload status message
                $statusMsg = $insert?'Files uploaded successfully.':'Some problem occurred, please try again.';
            }
        }
        
        // Get files data from the database
        //$data['files'] = $this->getRows();
    }
    
    public function getRows($register_id){
        $this->db->select('id,file_name,uploaded_on');
        $this->db->from('tbl_register_files');
        if($register_id){
            $this->db->where('register_id',$register_id);
            $query = $this->db->get();
            $result = $query->result_array();
        }else{
            $this->db->order_by('uploaded_on','desc');
            $query = $this->db->get();
            $result = $query->result_array();
        }
        return !empty($result)?$result:false;
    }
    
    /*
     * Insert file data into the database
     * @param array the data for inserting into the table
     */
    public function insert($data = array()){
        $insert = $this->db->insert_batch('tbl_register_files',$data);
        return $insert?true:false;
    }

    public function register_reassign_m($data,$cri)
    {
        $temp_data = array(
            'department_id'   => $data['department'],
            'staff_id'           => $data['staff'],
            'status_id' => $data['department']==5?1:($data['department']==4 || $data['staff']!=''?2:3),
        );

        $this->db->update('tbl_register', $temp_data, $cri);

        if ($this->db->affected_rows() > 0){
            //check if query run successful
            $staff_name=$this->common_m->get_staff_name($this->session->userdata["emp_num"]);
            $reg=$this->register_info($data['register_id']);
            $res=$this->common_m->get_stafflist($data['department']);
            if($data['staff']!=0){
                $this->telegram_m->sendMessage($this->common_m->get_chat_id($data['staff']),"<pre>Assign Register!</pre>From ".$staff_name."\nDriver ID: ".$reg['driver_id']."\nPhone: ".$reg['phone']."\nColor: ".$reg['vehicle_color_name']."\nPlate: ".$reg['vehicle_plate']."\nService: ".$reg['service_name']."\nModel: ".$reg['vehicle_model_name']."\nYear: ".$reg['vehicle_model_year']."\n".'<a href="'.base_url("index.php/register/register_c/register_view/".$data['register_id'].'">Click here to view</a>'));
            }else{
                foreach($res as $row)
                {   
                   $this->telegram_m->sendMessage($this->common_m->get_chat_id($row->emp_num),"<pre>Assign Register!!!</pre>From ".$staff_name."\nDriver ID: ".$reg['driver_id']."\nPhone: ".$reg['phone']."\nColor: ".$reg['vehicle_color_name']."\nPlate: ".$reg['vehicle_plate']."\nService: ".$reg['service_name']."\nModel: ".$reg['vehicle_model_name']."\nYear: ".$reg['vehicle_model_year']."\n".'<a href="'.base_url("index.php/register/register_c/register_view/".$data['register_id'].'">Click here to view</a>')); 
                }
            }
            return true;
        }else{
            return false;
        }
    }

    public function register_dispatch($data,$cri)
    {
        $temp_data = array(
            'department_id'   => $data['department'],
            'staff_id'        => 0,
            'status_id' => 3
        );

        $this->db->update('tbl_register', $temp_data, $cri);

        if ($this->db->affected_rows() > 0)//check if query run successful
        {
            $temp_data1 = array(
            'register_id' => $data['register_id'],
            'left_dept'  => $data['old_dept_id'],
            'right_dept' => $data['department'],
            'current' => 1,
            'move_type' => 14,
            'sequence' => $this->get_sequence_move($data['register_id']),
            'staff_id' => $data['old_staff_id']!=0?$data['old_staff_id']:$data['staff_login_id'],
            'move_date' => date("Y-m-d H:i:s")
            );

            $cri1=array('register_id'=>$data['register_id']);
            $temp_data2 = array(
            'current'   => 0
            );

            $this->db->update('tbl_register_movement',$temp_data2, $cri1);
            $this->db->insert('tbl_register_movement', $temp_data1);
            $staff_name=$this->common_m->get_staff_name($this->session->userdata["emp_num"]);
            $reg=$this->register_info($data['register_id']);
            $res=$this->common_m->get_stafflist($data['department']);
            // -- Start Send to TelegramDis --
            if($res) 
            {
                foreach($res as $row)
                {   
                   $this->telegram_m->sendMessage($this->common_m->get_chat_id($row->emp_num),"<pre>Open Register!!!</pre>From ".$staff_name."\nDriver ID: ".$reg['driver_id']."\nPhone: ".$reg['phone']."\nColor: ".$reg['vehicle_color_name']."\nPlate: ".$reg['vehicle_plate']."\nService: ".$reg['service_name']."\nModel: ".$reg['vehicle_model_name']."\nYear: ".$reg['vehicle_model_year']."\n".'<a href="'.base_url("index.php/register/register_c/register_view/".$data['register_id'].'">Click here to view</a>')); 
                }
            }
            return true;
        }
        else
            return false;
    }
    public function get_sequence_move($register_id)
    {

        $cri = array('register_id'=>$register_id);
        $this->db->select("max(sequence) max_sequence");
        $this->db->from('tbl_register_movement');
        $this->db->where($cri);
        $q = $this->db->get();
        //$row = mysql_fetch_array($q);
        if ($q->num_rows() > 0) {
             return $q->row()->max_sequence+1;
        }
         return 1;
    }

    public function register_note($data,$id)
    {
        $temp_data = array(
            'register_id'   => $id,
            'description' => $data['note'],
            'note_date' =>  date("Y-m-d H:i:s"),
            'note_by_staff_id' => $this->session->userdata["emp_num"]
        );

        $this->db->insert('tbl_register_note', $temp_data);

        if ($this->db->affected_rows() > 0)//check if query run successful
            return true;
        else
            return false;
    }
    public function register_reject($data,$cri)
    {
        $temp_data = array(
            'status_id' => 5,
            'department_id' => $data['department_id']==5?4:$data['department_id'],
            'description' => $data['note'],
            'close_by_staff_id' => $this->session->userdata["emp_num"]
        );

        $this->db->update('tbl_register', $temp_data, $cri);

        if ($this->db->affected_rows() > 0) {
            if($data['department_id']==5){
                $staff_name=$this->common_m->get_staff_name($this->session->userdata["emp_num"]);
                $reg=$this->register_info($data['register_id']);
                $res=$this->common_m->get_stafflist(4);
                // -- Start Send to TelegramDis --
                if($res) 
                {
                    foreach($res as $row)
                    {   
                    $this->telegram_m->sendMessage($this->common_m->get_chat_id($row->emp_num),"<pre>System Rejected!!!</pre>From ".$staff_name."\nDriver ID: ".$reg['driver_id']."\nPhone: ".$reg['phone']."\nColor: ".$reg['vehicle_color_name']."\nPlate: ".$reg['vehicle_plate']."\nService: ".$reg['service_name']."\nModel: ".$reg['vehicle_model_name']."\nYear: ".$reg['vehicle_model_year']."\n".'<a href="'.base_url("index.php/register/register_c/register_view/".$data['register_id'].'">Click here to view</a>')); 
                    }
                }
            }
            return true;
        } else{

            return false;
        }
    }
    public function register_done($data,$cri)
    {
        // $new_department_id=($data['old_dept_id']==5?4:($data['old_dept_id']==4?6:($data['old_dept_id']==6?4:'')));
        $new_department_id=($data['old_dept_id']==5?4:4);
        $old_staff_id=$data['old_staff_id']!=0?$data['old_staff_id']:$data['staff_login_id'];
        $current_flow=$this->register_get_current_flow($data['register_id']);
        
        if($current_flow) 
        {
            foreach($current_flow as $row)
            {   
                $old_staff_id=$row->staff_id;
                $new_department_id= $row->left_dept==''?$new_department_id:$row->left_dept;
                $temp_data1 = array(
                'register_id' => $data['register_id'],
                'left_dept'  => $row->right_dept,
                'right_dept' => $row->left_dept,
                'current' => 1,
                'move_type' => 4,
                'sequence' => $this->get_sequence_move($data['register_id']),
                'staff_id' => $data['old_staff_id']!=0?$data['old_staff_id']:$data['staff_login_id'],
                'move_date' => date("Y-m-d H:i:s")
                );
                $cri1=array('register_id'=>$data['register_id']);
                $temp_data2 = array(
                'current'   => 0
                );
                $this->db->update('tbl_register_movement',$temp_data2, $cri1);
                $this->db->insert('tbl_register_movement', $temp_data1);
            }
        }


         $temp_data = array(
        'status_id' => $data['old_dept_id']==5?3:4,
        'staff_id' => $data['old_staff_id']!=0?$data['old_staff_id']:$data['staff_login_id'],
        'department_id' => $new_department_id,
        'done_date' => date("Y-m-d H:i:s"),
        'done_by_staff_id' => $this->session->userdata["emp_num"]
        );

        $this->db->update('tbl_register', $temp_data, $cri);

        if ($this->db->affected_rows() > 0)//check if query run successful
        {
            $temp_data = array(
            'register_id'   => $data['register_id'],
            'description' => $data['note'],
            'note_date' =>  date("Y-m-d H:i:s"),
            'note_by_staff_id' => $this->session->userdata["emp_num"]
            );

            $this->db->insert('tbl_register_note', $temp_data);

            $staff_name=$this->common_m->get_staff_name($this->session->userdata["emp_num"]);
            $reg=$this->register_info($data['register_id']);
           // $res=$this->common_m->get_stafflist(4);
            if($data['old_staff_id']!=0){
                $driver_data = array(
                    'first_name'     => $reg['first_name'],
                    'last_name'      => $reg['last_name'],
                    'name'           => $reg['name'],
                    'gender'         => $reg['gender'],
                    'nationality_id'    => $reg['nationality_id'],
                    'date_of_birth'  => $reg['date_of_birth']==''?'':date('Y-m-d H:i:s', strtotime($reg['date_of_birth'])),
                    'id_card_number' => $reg['id_card_number'],
                    'house_number'   => $reg['house_number'],
                    'street'         => $reg['street'],
                    'province'       => $reg['pro_id'],
                    'district'       => $reg['dis_id'],
                    'commune'        => $reg['com_id'],
                    'village'        => $reg['village'],
                    'phone'          => $reg['phone'],
                    'driver_id'      => $reg['driver_id'],
                    'id_card_status'         => $reg['id_card_status'],
                    'drive_licences_status'  => $reg['drive_licences_status'],
                    'vehicle_iden_status'    => $reg['vehicle_iden_status'],
                    'family_book_status'     => $reg['family_book_status'],
                    'residen_book_status'    => $reg['residen_book_status'],
                    'accredit_book_status'   => $reg['accredit_book_status'],
                    //-- Vehicle information --
                    'vehicle_plate'          => $reg['vehicle_plate'],
                    'vehicle_model_year'     => $reg['vehicle_model_year'],
                    'vehicle_color_id'       => $reg['vehicle_color_id'],
                    'vehicle_model_id'       => $reg['vehicle_model_id'],
                    //-- Complaint Information --
                    'service_id'         => $reg['service_id'],
                    'staff_id'           => $reg['staff_id'],
                    'description'        => $reg['description'],
                    'department_id'      => $reg['department_id'],
                    'create_date'        => date("Y-m-d H:i:s"),
                    'status_id'          => 4,
                    'create_by_staff_id' => $this->session->userdata["emp_num"],
                    'done_by_staff_id'   => $this->session->userdata["emp_num"]
                );
                $this->db->insert('tbl_driver', $driver_data);
                $driver_id=$this->db->insert_id();
                $this->update_registration_file($driver_id,$data['register_id']);
                $this->update_registration_note($driver_id,$data['register_id']);
                // -- Start Send to Telegram Done --
                // $this->telegram_m->sendMessage($this->common_m->get_chat_id($old_staff_id),"<pre>Complete Register!</pre>From ".$staff_name.",".$reg['driver_id'].",".$reg['phone'].",".$reg['vehicle_color_name'].",".$reg['vehicle_plate'].",".$reg['service_name'].",".$reg['vehicle_model_name'].' has been <b>Completed</b>. Thanks. <a href="'.base_url("index.php/register/regsiter_c/register_view/".$data['register_id'].'">Click here to view</a>'));
            } else {
                $this->telegram_m->sendMessage($this->common_m->get_chat_id($reg['create_by_staff_id']),"<pre>System Done!!!</pre>From ".$staff_name."\nDriver ID: ".$reg['driver_id']."\nName: ".$reg['last_name']." ".$reg['first_name']."\n".'<a href="'.base_url("index.php/register/register_c/register_view/".$data['register_id'].'">Click here to view</a>'));
                // if($res) 
                // {
                //     foreach($res as $row)
                //     {   
                //        $this->telegram_m->sendMessage($this->common_m->get_chat_id($row->emp_num),"<pre>System Done!!!</pre>From ".$staff_name."\nDriver ID: ".$reg['driver_id']."\nName: ".$reg['last_name']." ".$reg['first_name']."\n".'<a href="'.base_url("index.php/register/register_c/register_view/".$data['register_id'].'">Click here to view</a>')); 
                //     }
                // }
            }
            return true;
        }    
        else
            return false;
         
    }
    public function register_get_current_flow($register_id)
    {
        
        $cri= array('register_id'=>$register_id,'move_type'=>14);
        $this->db->select("count(*) no_dispatch");
        $this->db->from('tbl_register_movement');
        $this->db->where($cri);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
             $count_dispatch= $q->row()->no_dispatch;
        }

        $cri= array('register_id'=>$register_id,'move_type'=>4);
        $this->db->select("count(*) no_done");
        $this->db->from('tbl_register_movement');
        $this->db->where($cri);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
             $count_done= $q->row()->no_done;
        }
        
        $cri = array('re.register_id'=>$register_id,'re.move_type'=>14,'re.sequence'=>$count_dispatch - $count_done);
        $this->db->select("re.*");
        $this->db->from('tbl_register_movement re');
        $this->db->where($cri);
        $q = $this->db->get();
        //$row = mysql_fetch_array($q);
        return $q->result();
    }

    public function update_registration_file($driver_id,$register_id)
    {
        $cri= array('register_id'=>$register_id);
        $data = array(
            'driver_id' => $driver_id,
         );
        $this->db->where($cri);
		$this->db->update('tbl_register_files', $data);
    }
    public function update_registration_note($driver_id,$register_id)
    {
        $cri= array('register_id'=>$register_id);
        $data = array(
            'driver_id' => $driver_id,
         );
        $this->db->where($cri);
		$this->db->update('tbl_register_note', $data);
    }
}