<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * This is user class/model for main-menu of My Profile
 */
class Driver_m extends CI_Model {

    public function __construct()
	{
        parent::__construct();
        $this->load->model('telegram_m');

    }
    
    public function list_driver_by_cri($cri)
    {
        $this->db->select("dr.id,dr.first_name,dr.gender,dr.last_name,CONCAT(p.emp_firstname,' ',p.emp_lastname) create_by,CONCAT(p2.emp_firstname,' ',p2.emp_lastname) staff,dr.driver_id,dr.create_date,dr.phone,dr.description,d.name department_name");
        $this->db->from('tbl_driver dr');
        $this->db->join('tbl_register_department d', 'dr.department_id=d.id');
        $this->db->join('tbl_employee e', 'dr.create_by_staff_id=e.emp_num','left');
        $this->db->join('tbl_employee e2', 'dr.staff_id=e2.emp_num','left');
        $this->db->join('tbl_personal_detail p', 'e.emp_num=p.emp_num','left');
        $this->db->join('tbl_personal_detail p2', 'e2.emp_num=p2.emp_num','left');
        $this->db->where($cri);
        $q = $this->db->get();
        return $q->result();
    }

    public function driver_info($id)
    {
        $cri = array('dr.id'=>$id);
        $this->db->select("dr.id,dr.first_name,dr.last_name,dr.name,dr.status_id,dr.gender,na.id nationality_id,na.name nationality_name,dr.date_of_birth,dr.id_card_number,dr.driver_id,dr.house_number,dr.street,dr.province,dr.district,dr.commune,dr.village,dr.vehicle_plate, dr.vehicle_model_year,col.name vehicle_color_name,col.id vehicle_color_id,vm.id vehicle_model_id ,vm.name vehicle_model_name,dr.id_card_status,dr.drive_licences_status,dr.vehicle_iden_status,dr.family_book_status,dr.residen_book_status,dr.accredit_book_status,dr.create_by_staff_id,CONCAT(p2.emp_firstname,' ',p2.emp_lastname) staff,dr.create_date,dr.phone,dr.description,d.name department_name,s.name service_name,s.id service_id,pro.pro_id, pro.pro_name_kh province,dis.dis_id,dis.dis_name_kh district,com.com_id,com.com_name_kh commune,CONCAT(p1.emp_firstname,' ',p1.emp_lastname) create_by,d.id department_id,dr.staff_id");
        $this->db->from('tbl_driver dr');
        $this->db->join('tbl_register_department d', 'dr.department_id=d.id');
        $this->db->join('tbl_employee e', 'dr.staff_id=e.emp_num','left');
        $this->db->join('tbl_personal_detail p2', 'e.emp_num=p2.emp_num','left');
        $this->db->join('tbl_employee e1', 'dr.create_by_staff_id=e1.emp_num','inner');
        $this->db->join('tbl_personal_detail p1', 'e1.emp_num=p1.emp_num','inner');
        $this->db->join('tbl_service s', 'dr.service_id=s.id','left');
        $this->db->join('tbl_province pro', 'pro.pro_id=dr.province','left');
        $this->db->join('tbl_district dis', 'dis.dis_id=dr.district','left');
        $this->db->join('tbl_commune com', 'com.com_id=dr.commune','left');
        $this->db->join('tbl_nationality na', 'dr.nationality_id=na.id','left');
        $this->db->join('tbl_color col', 'dr.vehicle_color_id=col.id','left');
        $this->db->join('tbl_vehicle_model vm', 'dr.vehicle_model_id=vm.id','left');
        $this->db->where($cri);
        $q = $this->db->get();
        return $q->row_array();
    }
    public function driver_note_list($id)
    {
        $cri = array('re.driver_id'=>$id);
        $this->db->select("re.description,re.driver_id,re.register_id,re.note_date,CONCAT(p1.emp_firstname,' ',p1.emp_lastname) create_by");
        $this->db->from('tbl_register_note re');
        $this->db->join('tbl_employee e1', 're.note_by_staff_id=e1.emp_num','inner');
        $this->db->join('tbl_personal_detail p1', 'e1.emp_num=p1.emp_num','inner');
        $this->db->where($cri);
        $this->db->order_by('re.note_date','DESC');
        $q = $this->db->get();
        return $q->result();
    }
    public function get_driver_img($id){
        $this->db->select('id,file_name,uploaded_on');
        $this->db->from('tbl_register_files');
        if($id){
            $this->db->where('driver_id',$id);
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
    public function driver_insert_new_doc($data = array()){
        $insert = $this->db->insert_batch('tbl_register_files',$data);
        return $insert?true:false;
    }

    public function driver_update($data)
    {       
        $driver_info = $this->driver_info($data['id']);
        $last_date  = date('Y-m-d H:i:s', strtotime('-18 years'));
        $date_of_birth = date('Y-m-d H:i:s', strtotime($data['date_of_birth']));
        $meta_data['description'] = '';
        $id_card_status           = (!isset($data['id_card_status']) || is_null($data['id_card_status']))?0:1;
        $drive_licences_status    = (!isset($data['drive_licences_status']) || is_null($data['drive_licences_status']))?0:1;
        $vehicle_iden_status      = (!isset($data['vehicle_iden_status']) || is_null($data['vehicle_iden_status']))?0:1;
        $family_book_status       = (!isset($data['family_book_status']) || is_null($data['family_book_status']))?0:1;
        $residen_book_status      = (!isset($data['residen_book_status']) || is_null($data['residen_book_status']))?0:1;
        $accredit_book_status     = (!isset($data['accredit_book_status']) || is_null($data['accredit_book_status']))?0:1;

        if($driver_info['first_name'] != $data['first_name']){
            $meta_data['description'].= 'First Name('.$driver_info['first_name'].' to '.$data['first_name'].'),';
        }
        if($driver_info['last_name'] != $data['last_name']){
            $meta_data['description'].= 'Last Name('.$driver_info['last_name'].' : '.$data['last_name'].'),';
        }
        if($driver_info['gender'] != $data['gender']){
            $meta_data['description'].= 'Gender('.$driver_info['gender'].' : '.$data['gender'].'),';
        } 
        if($driver_info['nationality_id'] != $data['nationality_id']){
            $meta_data['description'].= 'Nationality('.$driver_info['nationality_id'].' : '.$data['nationality_id'].'),';
        } 
        if($driver_info['date_of_birth'] != $date_of_birth){
            $meta_data['description'].= 'Date Of Birth('.$driver_info['date_of_birth'].' : '.$date_of_birth.'),';
        }
        if($driver_info['id_card_number'] != $data['id_card_number']){
            $meta_data['description'].= 'ID Card('.$driver_info['id_card_number'].' : '.$data['id_card_number'].'),';
        }
        if($driver_info['house_number'] != $data['house_number']){
            $meta_data['description'].= 'House Number('.$driver_info['house_number'].' : '.$data['house_number'].'),';
        }
        if($driver_info['street'] != $data['street']){
            $meta_data['description'].= 'Street('.$driver_info['street'].' : '.$data['street'].'),';
        }
        if($driver_info['pro_id'] != $data['province']){
            $meta_data['description'].= 'Province('.$driver_info['province'].' : '.$data['province'].'),';
        }
        if($driver_info['dis_id'] != $data['district']){
            $meta_data['description'].= 'District('.$driver_info['dis_id'].' : '.$data['district'].'),';
        }
        if($driver_info['com_id'] != $data['commune']){
            $meta_data['description'].= 'Commune('.$driver_info['com_id'].' : '.$data['commune'].'),';
        }
        if($driver_info['phone'] != $data['phone']){
            $meta_data['description'].= 'Phone number('.$driver_info['phone'].' : '.$data['phone'].'),';
        }
        if($driver_info['driver_id'] != $data['driver_id']){
            $meta_data['description'].= 'Driver ID('.$driver_info['driver_id'].' : '.$data['driver_id'].'),';
        }
        if($driver_info['id_card_status'] != $id_card_status){
            $meta_data['description'].= 'ID Card Status('.$driver_info['id_card_status'].' : '.$id_card_status.'),';
        }
        if($driver_info['drive_licences_status'] != $drive_licences_status){
            $meta_data['description'].= 'Driving Licences Status('.$driver_info['drive_licences_status'].' : '.$drive_licences_status.'),';
        }
        if($driver_info['vehicle_iden_status'] != $vehicle_iden_status){
            $meta_data['description'].= 'Vehicle Iden Status('.$driver_info['vehicle_iden_status'].' : '.$vehicle_iden_status.'),';
        }
        if($driver_info['family_book_status'] != $family_book_status){
            $meta_data['description'].= 'Family Book Status('.$driver_info['family_book_status'].' : '.$family_book_status.'),';
        }
        if($driver_info['residen_book_status'] != $residen_book_status){
            $meta_data['description'].= 'Residen Book Status('.$driver_info['residen_book_status'].' : '.$residen_book_status.'),';
        }
        if($driver_info['accredit_book_status'] != $accredit_book_status){
            $meta_data['description'].= 'Accredit Book Status('.$driver_info['accredit_book_status'].' : '.$accredit_book_status.'),';
        }
        if($driver_info['vehicle_plate'] != $data['vehicle_plate']){
            $meta_data['description'].= 'Plate('.$driver_info['vehicle_plate'].' : '.$data['vehicle_plate'].'),';
        }
        if($driver_info['vehicle_model_year'] != $data['vehicle_model_year']){
            $meta_data['description'].= 'Model Year('.$driver_info['vehicle_model_year'].' : '.$data['vehicle_model_year'].'),';
        }
        if($driver_info['vehicle_color_id'] != $data['vehicle_color_id']){
            $meta_data['description'].= 'Color('.$driver_info['vehicle_color_id'].' : '.$data['vehicle_color_id'].'),';
        }
        if($driver_info['vehicle_model_id'] != $data['vehicle_model_id']){
            $meta_data['description'].= 'Model('.$driver_info['vehicle_model_id'].' : '.$data['vehicle_model_id'].'),';
        }
        if($driver_info['service_id'] != $data['service_id']){
            $meta_data['description'].= 'Service('.$driver_info['service_id'].' : '.$data['service_id'].')';
        }
        $driver_audit = array(
            'description'           => $meta_data['description'],
            'driver_id'             => $data['id'],
            'audit_by_staff_id'     => $this->session->userdata['emp_num'],
            'audit_date'            => date("Y-m-d H:i:s")
        );
        // INSERT Into Table register_audit
        if($meta_data['description']!=''){
            $this->db->insert('tbl_driver_audit', $driver_audit);
        }
        // Data for Update
        $temp_data = array(
            'first_name'     => $data['first_name'],
            'last_name'      => $data['last_name'],
            'name'           => $data['last_name'].' '.$data['first_name'],
            'gender'         => $data['gender'],
            'nationality_id' => $data['nationality_id'],
            'date_of_birth'  => $date_of_birth <= $last_date ? $date_of_birth:$last_date,
            'id_card_number' => $data['id_card_number'],
            'house_number'   => $data['house_number'],
            'street'         => $data['street'],
            'province'       => $data['province'],
            'district'       => (!isset($data['district']) || is_null($data['district']))?0:$data['district'],
            'commune'        => (!isset($data['commune']) || is_null($data['commune']))?0:$data['commune'],
            'village'        => $data['village'],
            'phone'          => $data['phone'],
            'driver_id'      => $data['driver_id'],
            'id_card_status'          => $id_card_status,
            'drive_licences_status'   => $drive_licences_status,
            'vehicle_iden_status'     => $vehicle_iden_status,
            'family_book_status'      => $family_book_status,
            'residen_book_status'     => $residen_book_status,
            'accredit_book_status'    => $accredit_book_status,
            //-- Vehicle information --
            'vehicle_plate'           => $data['vehicle_plate'],
            'vehicle_model_year'      => $data['vehicle_model_year'],
            'vehicle_color_id'        => $data['vehicle_color_id'],
            'vehicle_model_id'        => $data['vehicle_model_id'],
            'service_id'              => $data['service_id'],
        );

        $cri= array('id'=>$data['id']);
        $this->db->where($cri);
        $this->db->update('tbl_driver', $temp_data);
        if ($this->db->affected_rows() > 0) //check if query run successful
        {
            $this->driver_upload_file($data['id']);
            return $data['id'];
        }
        else
            return false;
    }
    private function driver_upload_file($id)
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
                    $uploadData[$i]['driver_id'] = $id;
                    $uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
                }
            }
            
            if(!empty($uploadData)){
                // Insert files data into the database
                $insert = $this->driver_insert_new_doc($uploadData);

                // Upload status message
                $statusMsg = $insert?'Files uploaded successfully.':'Some problem occurred, please try again.';
            }
        }
    }

}