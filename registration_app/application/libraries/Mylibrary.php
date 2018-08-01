<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mylibrary
{

    function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->model('mylibrary/mylibrary_m');

    }

    function do_system_logs($action, $type)
    {
        $this->ci->load->library('user_agent');
        $usergent = $this->ci->input->user_agent();
        $ip = $this->ci->input->ip_address();
        $userid = $this->ci->session->userdata('user_id');
        date_default_timezone_set("Asia/Bangkok");
        $current = date('Y-m-d H:i:s');

        $os = strstr($this->ci->agent->platform(), ' ', true);
        // echo $os;exit;
        /*if ($os == 'Windows') {
            exec("ipconfig /all", $arr, $retval);
            $arr[0];

            $ph = explode(":", $arr[0]);
            $macaddress = trim($ph[1]);

        } else {
            $macaddress = NULL;
        }*/

        $logs = array('saction' => $action, 'stype' => $type, 'suserid' => $userid, 'suseragent' => $usergent, 'sip' => $ip, 'sdate' => $current);

        $this->ci->mylibrary_m->insert_system_logs($logs);

    }


    function do_change_pass($oldpass, $newpass, $userid)
    {

        $result = $this->ci->mylibrary_m->check_password_user($oldpass, $newpass, $userid);
        return $result;

    }

    function check_email_user($email, $random_code)
    {

        $query = $this->ci->mylibrary_m->check_exist_email($email, $random_code);
        if ($query['user_name'] == $email) {
            $this->ci->mylibrary_m->update_status_user($email, $random_code);
            return true;
        } else {
            return false;
        }
    }

    function check_exist_send_email($email)
    {
        $result = $this->ci->mylibrary_m->check_exist_send_email($email);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function send_email($emailto, $random_code)
    {
        $this->ci->load->library('my_mail_lib');
        $link = base_url() . 'change_password_user_c/update_password_by_link/' . $random_code;
        $to = $emailto;
        $sub = "eHRM: Reset Password";
        $msg = "Dear Madam or Sir,<br><br>
                To reset your password please follow the link below:<br>
                <a href='" . $link . "'>Reset Password</a><br><br>
                Thanks!<br>
                EHRM-EZECOM";
        if ($this->ci->my_mail_lib->sendEmail($to, $sub, $msg) == true) {
            $this->ci->session->set_flashdata('message', '<div class="alert alert-success"><strong>Reset password have been sent to your email.<br>Please check your Inbox!</strong></div>');
            redirect('authentication/authen_c/login', 'refresh');
        } else {
            $this->ci->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Try again Email not sent.!</strong></div>');
            redirect('change_password_user_c/reset_password', 'refresh');
        }

    }

    function check_random_code_user($random_code)
    {

        $query = $this->ci->mylibrary_m->check_exist_email_by_random_code($random_code);
        return $query;
    }

    function set_update_password_by_link($random_code, $newpass)
    {

        $result = $this->ci->mylibrary_m->update_password_by_link($random_code, $newpass);
        return $result;

    }

    function set_update_password_next_login($newpass)
    {
        $query = $this->ci->mylibrary_m->update_password_next_login_by_id($newpass);
        return $query;
    }

    function get_info_user_login($id)
    {

        $result = $this->ci->mylibrary_m->get_emp_info_user_login($id);
        return $result;
    }

    public function find_manager($id)
    {
        $cri1 = array('emp_num' => $id);
        $div_up = $this->ci->mylibrary_m->get_div_up($cri1);
        $div_up_id = $div_up['div_up_id'];
        $cri2 = array(
            'div_down_id' => $div_up_id,
            'role_down' => 0,
            'emp_num <>' => $id
        );
        $manager = $this->ci->mylibrary_m->get_manager($cri2);
        return $manager; // return emp_num(INT)
    }

    public function get_duration_in_office($my_check_in_time, $my_break_out_time, $my_break_in_time, $my_check_out_time)
    {
        // calculate total duration in office
        $duration_in_office = array('h'=>0,'i'=>0);
        if ($my_check_in_time && $my_check_out_time && $my_break_in_time && $my_break_out_time) {
            $t1 = new DateTime($my_check_in_time);
            $t2 = new DateTime($my_break_out_time);
            $interval1 = $t1->diff($t2);
            $h1 = $interval1->format('%h');
            $i1 = $interval1->format('%i');

            $t3 = new DateTime($my_break_in_time);
            $t4 = new DateTime($my_check_out_time);
            $interval2 = $t3->diff($t4);
            $h2 = $interval2->format('%h');
            $i2 = $interval2->format('%i');

            $duration_in_office = array(
                'h' => (($h1 + $h2) + floor(($i1 + $i2) / 60)),
                'i' => (($i1 + $i2) % 60)
            );

        } elseif ($my_check_in_time && $my_check_out_time) {
            $t1 = new DateTime($my_check_in_time);
            $t2 = new DateTime($my_check_out_time);
            $interval = $t1->diff($t2);
            $duration_in_office = array(
                'h' => $interval->format('%h'),
                'i' => $interval->format('%i')
            );
        } elseif ($my_check_in_time && $my_break_out_time) {
            $t1 = new DateTime($my_check_in_time);
            $t2 = new DateTime($my_break_out_time);
            $interval = $t1->diff($t2);
            $duration_in_office = array(
                'h' => $interval->format('%h'),
                'i' => $interval->format('%i')
            );
        } elseif ($my_break_in_time && $my_check_out_time) {
            $t1 = new DateTime($my_break_in_time);
            $t2 = new DateTime($my_check_out_time);
            $interval = $t1->diff($t2);
            $duration_in_office = array(
                'h' => $interval->format('%h'),
                'i' => $interval->format('%i')
            );
        }
        return $duration_in_office;
    }

    public function total_2_duration($d1, $d2)
    {
        $h = $d1['h'] + $d2['h'] + floor(($d1['i'] + $d2['i']) / 60);
        $i = ($d1['i'] + $d2['i']) % 60;
        return array(
            'h' => $h,
            'i' => $i
        );
    }
}
