<?php
class User_api_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function getInfo($pid)
    {

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email_addr', $pid);
        $query = $this->db->get();
        $data = $query->row();

        $numMember = $query->num_rows();
        if ($numMember > 0 ) {
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

    public function getBMI($pid='', $date='')
    {

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email_addr', $pid);
        $queryUser = $this->db->get();
        $dataUser = $queryUser->row();


        $whereWeight = "user_id = '".$dataUser->user_id."' ";
        $whereWeight .= " and date_exam <= '".$date."' ";
        $this->db->select('*');
        $this->db->from('users_exam_weight');
        $this->db->where($whereWeight);
        $this->db->order_by("date_exam", "desc");
        $queryWeight = $this->db->get();
        $dataWeight = $queryWeight->row();
        //echo $this->db->last_query();

        $whereFood = "user_id = '".$dataUser->user_id."' ";
        $whereFood .= " and date_eat = '".$date."' ";
        $this->db->select('SUM(food_energy) as sum_food_energy');
        $this->db->from('users_food_time');
        $this->db->where($whereFood);
        $queryFood = $this->db->get();
        $dataFood = $queryFood->row();

        $numMember = $queryUser->num_rows();
        if ($numMember > 0 ) {
            $res = array();
            $res['user_id'] = $dataUser->user_id;
            $res['user_height'] = $dataUser->user_height;
            $res['user_weight'] = $dataWeight->user_weight;
            $res['user_bmi'] = number_format($dataWeight->user_weight/(($dataUser->user_height/100)*2),2);
            $res['sum_food_energy'] = number_format($dataFood->sum_food_energy,2);
            return $res;
        } else {
            return false;
        }

    }



}
