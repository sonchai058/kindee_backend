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
            $res['user_status'] = $data->user_status;
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
        $whereFoodType = '';
        $whereFood = "users_food.user_id = '".$dataUser->user_id."' ";
        $whereFood .= " and users_food.date_eat = '".$date."' ";
        $whereFoodType .= "  and users_food.fag_allow = 'allow' and `composition`.`fag_allow` = 'allow' ";

        $this->db->select(' material.rmat_name,
                            users_food.food_energy,
                            composition.amount,
                            material.energy_val,
                            material.carboh_val,
                            material.protein_val,
                            material.fat_val,
                            material.sodium_val,
                            material.sugar_val,
                            material.vita_val,
                            material.thiamin_val,
                            material.niacin_val,
                            material.vitc_val,
                            material.vite_val
                              '
                        );
        $this->db->from('users_food_time as users_food');
        $this->db->join('self_food_menu as menu', "users_food.food_id = menu.self_food_id", 'left');
        $this->db->join('self_food_menu_composition as composition', "users_food.food_id = composition.self_food_id");
        $this->db->join('raw_material as material', "composition.rmat_id = material.rmat_id");

        $this->db->where($whereFood.$whereFoodType);
        $queryFoodType = $this->db->get();
        //echo $this->db->last_query();
        //$dataFoodType = $queryFoodType->row();
        //$dataFoodType = array();
        $carboh_val = 0;
        $protein_val = 0;
        $fat_val = 0;
        $sodium_val = 0;
        $sugar_val = 0;
        $vita_val = 0;
        $thiamin_val = 0;
        $niacin_val = 0;
        $vitc_val = 0;
        $vite_val = 0;
        foreach ($queryFoodType->result() as $row)
        {
          $sum_cpf = 0;
          $percent_carboh = 0;
          $percent_protein = 0;
          $percent_fat = 0;
          $ratio_carboh = 0;
          $ratio_protein = 0;
          $ratio_fat = 0;
          $kcal_gram_carboh = 0;
          $kcal_gram_protein = 0;
          $kcal_gram_fat = 0;

          $sum_cpf = $row->carboh_val+$row->protein_val+$row->fat_val;
          if($sum_cpf>0){
            $percent_carboh = $row->carboh_val/$sum_cpf;
            $percent_protein = $row->protein_val/$sum_cpf;
            $percent_fat = $row->fat_val/$sum_cpf;
            $ratio_carboh = $percent_carboh*$row->energy_val;
            $ratio_protein = $percent_protein*$row->energy_val;
            $ratio_fat = $percent_fat*$row->energy_val;
            if($row->carboh_val>0){
              $kcal_gram_carboh = $ratio_carboh/$row->carboh_val;
            }else{
              $kcal_gram_carboh = 0;
            }
            if($row->protein_val>0){
              $kcal_gram_protein = $ratio_protein/$row->protein_val;
            }else{
              $kcal_gram_protein = 0;
            }
            if($row->fat_val>0){
              $kcal_gram_fat = $ratio_fat/$row->fat_val;
            }else{
              $kcal_gram_fat = 0;
            }

          }else{
            $kcal_gram_carboh = 0;
            $kcal_gram_protein = 0;
            $kcal_gram_fat = 0;
          }

          $carboh_val += ($kcal_gram_carboh*$row->carboh_val)*round(($row->amount/100),1);
          $protein_val += round($kcal_gram_protein*$row->protein_val,5)*round(($row->amount/100),5);
          //echo "(".$kcal_gram_protein."*".$row->protein_val.")*".($row->amount/100)."<br/>";
          $fat_val += ($kcal_gram_fat*$row->fat_val)*round(($row->amount/100),1);
          $sodium_val += $row->sodium_val*($row->amount/100);
          $sugar_val += $row->sugar_val*($row->amount/100);
          $vita_val += $row->vita_val*($row->amount/100);
          $thiamin_val += $row->thiamin_val*($row->amount/100);
          $niacin_val += $row->niacin_val*($row->amount/100);
          $vitc_val += $row->vitc_val*($row->amount/100);
          $vite_val += $row->vite_val*($row->amount/100);
          //echo $row->rmat_name.":".round(($kcal_gram_protein*$row->protein_val)*($row->amount/100),2).'<br/>';
        }
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
            $res['sum_food_energy'] = number_format($dataFood->sum_food_energy,2);
            $res['sum_protein_val'] = number_format($protein_val,2);
            $res['sum_fat_val'] = number_format($fat_val,2);
            $res['sum_carboh_val'] = number_format($carboh_val,2);
            $res['sum_sodium_val'] = number_format($sodium_val,2);
            $res['sum_sugar_val'] = number_format($sugar_val,2);
            $res['sum_vita_val'] = number_format($vita_val,2);
            $res['sum_thiamin_val'] = number_format($thiamin_val,2);
            $res['sum_niacin_val'] = number_format($niacin_val,2);
            $res['sum_vitc_val'] = number_format($vitc_val,2);
            $res['sum_vite_val'] = number_format($vite_val,2);
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
