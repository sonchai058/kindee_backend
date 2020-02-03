<?php
class Login_api_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function getLogin($pid, $passcode)
    {

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email_addr', $pid);
        $query = $this->db->get();
        $data = $query->row();

        $numMember = $query->num_rows();
        if ($numMember > 0 and $passcode == $data->cus_passwd) {
            $res = array();
            $res['user_id'] = $data->user_id;
            $res['email_addr'] = $pid;
            $res['cus_passwd'] = $passcode;
            $res['title_name'] = $data->title_name;
            $res['user_photo'] = $data->user_photo;
            $res['user_fname'] = $data->user_fname;
            $res['user_lname'] = $data->user_lname;
            $res['date_of_birth'] = $data->date_of_birth;
            $res['mobile_no'] = $data->mobile_no;
            $res['addr'] = $data->addr;
            $res['title_name'] = $data->title_name;
            return $res;
        } else {
            return false;
        }

    }

    public function getLogout($id)
    {

        $login_date = date('Y-m-d H:i:s');
        // $ip = $this->input->ip_address();
        $this->db->set('app_id', 2);
        $this->db->set('org_id', 1);
        $this->db->set('process_action', 'Authen');
        $this->db->set('log_action', 'Sign out');
        $this->db->set('user_id', $id);
        $this->db->set('log_datetime', "to_date('{$login_date}','YYYY-MM-DD HH24:MI:SS')", false);
        $this->db->set('log_status', 'Success');
        return $this->db->insert('usrm_log');
    }

}
