<? 
Class Authen_m extends CI_Model {

	public function __construct()
	{

		parent::__construct();
	}

	public function validate_user($username,$password) {
        // not yet encrypt password
        $this->db->select('tbl_user.user_id,tbl_user.user_name,tbl_user.user_password,tbl_user.user_status,tbl_user.user_name,tbl_user.emp_num,tbl_user.group_id,tbl_usergroup.group_name,tbl_usergroup.group_id,change_password_next_login');
		$this->db->from('tbl_user');
		$this->db->join('tbl_usergroup', 'tbl_user.group_id = tbl_usergroup.group_id');
		$this->db->where(array('tbl_user.user_status' => '1', 'tbl_user.user_name' => $username,'tbl_user.user_password' => $password));
		return $this->db->get()->row_array();
       
    }

}

?>