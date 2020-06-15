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
            $res['user_height'] = $data->user_height;
            $res['user_sex'] = ($data->user_sex=='ชาย')?1:2;
            $res['mobile_no'] = $data->mobile_no;
            $res['addr'] = $data->addr;
            $res['title_name'] = $data->title_name;
            return $res;
        } else {
            return false;
        }

    }

    public function save($data=array(), $where=array()){

        if($where){
            $this->db->where($where);
            $this->db->update('users', $data);
            $res['id'] = $where['user_id'];
        }else{

            $this->db->insert('users', $data);
            $id = $this->db->insert_id();
            $res['id'] = $id;
        }
        return $res;
    }

    public function getBMI($pid='', $date='')
    {

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email_addr', $pid);
        $queryUser = $this->db->get();
        $dataUser = $queryUser->row();


        $whereWeight = "user_id = '".$dataUser->user_id."' ";
        $whereWeight .= " and date(date_exam) <= '".$date."' ";
        $this->db->select('*');
        $this->db->from('users_exam_weight');
        $this->db->where($whereWeight);
        $this->db->order_by("date_exam", "DESC" );
        $this->db->order_by("eweight_id","DESC" );
        $this->db->limit(1);
        $queryWeight = $this->db->get();
        $dataWeight = $queryWeight->row();
        //echo $this->db->last_query();

        $whereFood = "users_food.user_id = '".$dataUser->user_id."' ";
        $whereFood .= " and users_food.date_eat = '".$date."' ";
        $whereFoodType .= "  and users_food.fag_allow = 'allow' and `composition`.`fag_allow` = 'allow' ";

        $this->db->select('users_food.food_energy,
                          composition.amount,
                          SUM(material.energy_val*composition.amount),
                          SUM(material.protein_val*composition.amount)/100 as protein_val,
                          SUM(material.fat_val*composition.amount)/100 as fat_val,
                          SUM(material.carboh_val*composition.amount)/100 as carboh_val '
                        );
        $this->db->from('users_food_time as users_food');
        $this->db->join('self_food_menu as menu', "users_food.food_id = menu.self_food_id", 'left');
        $this->db->join('self_food_menu_composition as composition', "users_food.food_id = composition.self_food_id");
        $this->db->join('raw_material as material', "composition.rmat_id = material.rmat_id");

        $this->db->where($whereFood.$whereFoodType);
        $queryFoodType = $this->db->get();
        $dataFoodType = $queryFoodType->row();
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
            $res['user_bmi'] = number_format($dataWeight->user_weight/pow(($dataUser->user_height/100),2),2);
            $res['sum_food_energy'] = number_format($dataFood->sum_food_energy/100,2);
            $res['sum_protein_val'] = number_format($dataFoodType->protein_val,2);
            $res['sum_fat_val'] = number_format($dataFoodType->fat_val,2);
            $res['sum_carboh_val'] = number_format($dataFoodType->carboh_val,2);
            return $res;
        } else {
            return false;
        }

    }

    public function saveWeight($data=array(), $where=array()){

        if($where){
            $this->db->where($where);
            $this->db->update('users_exam_weight', $data);
            $res['id'] = $where['eweight_id'];
        }else{

            $this->db->insert('users_exam_weight', $data);
            $id = $this->db->insert_id();
            $res['id'] = $id;
        }
        return $res;
    }

    public function saveWaistline($data=array(), $where=array()){

        if($where){
            $this->db->where($where);
            $this->db->update('users_exam_waistline', $data);
            $res['id'] = $where['ewaist_id'];
        }else{

            $this->db->insert('users_exam_waistline', $data);
            $id = $this->db->insert_id();
            $res['id'] = $id;
        }
        return $res;
    }

    public function saveHip($data=array(), $where=array()){

        if($where){
            $this->db->where($where);
            $this->db->update('users_exam_hip', $data);
            $res['id'] = $where['ehip_id'];
        }else{

            $this->db->insert('users_exam_hip', $data);
            $id = $this->db->insert_id();
            $res['id'] = $id;
        }
        return $res;
    }

    public function getBodyInfo($pid='', $date='')
    {

          $this->db->select('*');
          $this->db->from('users');
          $this->db->where('email_addr', $pid);
          $queryUser = $this->db->get();
          $dataUser = $queryUser->row();

          $where = "user_id = '".$dataUser->user_id."' ";
          $where .= " and date_exam <= '".$date."' ";

          $this->db->select('*');
          $this->db->from('users_exam_weight');
          $this->db->where($where);
          $this->db->order_by("date_exam", "desc");
          $queryWeight = $this->db->get();
          $dataWeight = $queryWeight->row();

          $this->db->select('*');
          $this->db->from('users_exam_waistline');
          $this->db->where($where);
          $this->db->order_by("date_exam", "desc");
          $queryWaistline = $this->db->get();
          $dataWaistline = $queryWaistlinet->row();

          $this->db->select('*');
          $this->db->from('users_exam_hip');
          $this->db->where($where);
          $this->db->order_by("date_exam", "desc");
          $queryHip = $this->db->get();
          $dataHip = $queryHip->row();

          $numMember = $queryUser->num_rows();
          if ($numMember > 0 ) {
              $res = array();
              $res['user_id'] = $dataUser->user_id;
              $res['date_exam'] = $dataUser->date_exam;
              $res['user_weight'] = $dataWeight->user_weight;
              $res['user_waistline'] = $dataWaistline->user_waistline;
              $res['user_hip'] = $dataHip->user_hip;
              return $res;
          } else {
              return false;
          }
    }



}
