<?php
class Food_api_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function getFood($pid='', $date='')
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

        $whereFoodType1 = '';
        $whereFoodType2 = '';
        $whereFoodType3 = '';
        $whereFoodType4 = '';
        $whereFood = "users_food.user_id = '".$dataUser->user_id."' ";
        $whereFood .= " and users_food.date_eat = '".$date."' ";
        $whereFoodType1 .= " and users_food.eat_time = 'เช้า' and users_food.fag_allow = 'allow' ";
        $whereFoodType2 .= " and users_food.eat_time = 'กลางวัน' and users_food.fag_allow = 'allow' ";
        $whereFoodType3 .= " and users_food.eat_time = 'เย็น' and users_food.fag_allow = 'allow' ";
        $whereFoodType4 .= " and users_food.eat_time = 'อาหารว่าง' and users_food.fag_allow = 'allow' ";

        $this->db->select('users_food.foodt_id, menu.self_food_name, users_food.food_energy');
        $this->db->from('users_food_time as users_food');
        $this->db->join('self_food_menu as menu', "users_food.food_id = menu.self_food_id", 'left');
        $this->db->where($whereFood.$whereFoodType1);
        $queryFoodType1 = $this->db->get();

        $this->db->select('SUM(food_energy) as sum');
        $this->db->from('users_food_time as users_food');
        $this->db->where($whereFood.$whereFoodType1);
        $querySumEnergy1 = $this->db->get();
        $dataSumEnergy1 = $querySumEnergy1->row();

        $this->db->select('users_food.foodt_id, menu.self_food_name, users_food.food_energy');
        $this->db->from('users_food_time as users_food');
        $this->db->join('self_food_menu as menu', "users_food.food_id = menu.self_food_id", 'left');
        $this->db->where($whereFood.$whereFoodType2);
        $queryFoodType2 = $this->db->get();

        $this->db->select('SUM(food_energy) as sum');
        $this->db->from('users_food_time as users_food');
        $this->db->where($whereFood.$whereFoodType2);
        $querySumEnergy2 = $this->db->get();
        $dataSumEnergy2 = $querySumEnergy2->row();

        $this->db->select('users_food.foodt_id, menu.self_food_name, users_food.food_energy');
        $this->db->from('users_food_time as users_food');
        $this->db->join('self_food_menu as menu', "users_food.food_id = menu.self_food_id", 'left');
        $this->db->where($whereFood.$whereFoodType3);
        $queryFoodType3 = $this->db->get();

        $this->db->select('SUM(food_energy) as sum');
        $this->db->from('users_food_time as users_food');
        $this->db->where($whereFood.$whereFoodType3);
        $querySumEnergy3 = $this->db->get();
        $dataSumEnergy3 = $querySumEnergy3->row();

        $this->db->select('users_food.foodt_id, menu.self_food_name, users_food.food_energy');
        $this->db->from('users_food_time as users_food');
        $this->db->join('self_food_menu as menu', "users_food.food_id = menu.self_food_id", 'left');
        $this->db->where($whereFood.$whereFoodType4);
        $queryFoodType4 = $this->db->get();

        $this->db->select('SUM(food_energy) as sum');
        $this->db->from('users_food_time as users_food');
        $this->db->where($whereFood.$whereFoodType4);
        $querySumEnergy4 = $this->db->get();
        $dataSumEnergy4 = $querySumEnergy4->row();

        $numMember = $queryUser->num_rows();
        if ($numMember > 0 ) {

            /***
            สูตรคำนวณอัตราการเผาผลาญของร่างกายในชีวิตประจำวันคือ
            สำหรับผู้ชาย : BMR = 66 + (13.7 x น้ำหนักตัวเป็น กก.) + (5 x ส่วนสูงเป็น ซม.) – (6.8 x อายุ)
            สำหรับผู้หญิง : BMR = 665 + (9.6 x น้ำหนักตัวเป็น กก.) + (1.8 x ส่วนสูงเป็น ซม.) – (4.7 x อายุ)
            */
            $res = array();
            $data_food1  = array();
            $data_food2  = array();
            $data_food3  = array();
            $data_food4  = array();

            $res['user_id'] = $dataUser->user_id;

            $birthDate = explode("-", $dataUser->date_of_birth);
            //get age from date or birthdate
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md")? ((date("Y") - $birthDate[0]) - 1): (date("Y") - $birthDate[0]));
            //$age = 35;
            $res['user_age'] = $age;
            if($dataUser->user_sex == 'ชาย'){
              $user_bmi = 66 + (13.7 * $dataWeight->user_weight ) + (5 * $dataUser->user_height) - (6.8 * $age);
            }else if($dataUser->user_sex == 'หญิง'){
              $user_bmi = 665 + (9.6 * $dataWeight->user_weight ) + (1.8 * $dataUser->user_height) - (4.7 * $age);
            }else{
              $user_bmi = 1500;
            }
            $res['user_bmi'] = number_format($user_bmi,2);
            foreach ($queryFoodType1->result() as $row)
            {
              $data_food1[]  = array(
                                      'foodt_id' => intval($row->foodt_id),
                                      'food_name' => $row->self_food_name,
                                      'food_energy' => $row->food_energy
                                    );
            }
            foreach ($queryFoodType2->result() as $row)
            {
              $data_food2[]  = array(
                                      'foodt_id' => intval($row->foodt_id),
                                      'food_name'=>$row->self_food_name,
                                      'food_energy'=>$row->food_energy
                                    );
            }
            foreach ($queryFoodType3->result() as $row)
            {
              $data_food3[]  = array(
                                      'foodt_id' => intval($row->foodt_id),
                                      'food_name'=>$row->self_food_name,
                                      'food_energy'=>$row->food_energy
                                    );
            }
            foreach ($queryFoodType4->result() as $row)
            {
              $data_food4[]  = array(
                                      'foodt_id' => intval($row->foodt_id),
                                      'food_name'=>$row->self_food_name,
                                      'food_energy'=>number_format($row->food_energy,2)
                                    );
            }
            $res['data_food1'] = $data_food1;
            $res['data_sum_energy1'] = number_format($dataSumEnergy1->sum,2);
            $res['data_food2'] = $data_food2;
            $res['data_sum_energy2'] = number_format($dataSumEnergy2->sum,2);
            $res['data_food3'] = $data_food3;
            $res['data_sum_energy3'] = number_format($dataSumEnergy3->sum,2);
            $res['data_food4'] = $data_food4;
            $res['data_sum_energy4'] = number_format($dataSumEnergy4->sum,2);
            $data_sum_energyall = $dataSumEnergy1->sum+$dataSumEnergy2->sum+$dataSumEnergy3->sum+$dataSumEnergy4->sum;
            $res['data_sum_energyall'] = number_format($data_sum_energyall,2);
            return $res;
        } else {
            return false;
        }

    }

    public function getFoodDetail($id='')
    {
      $whereFood = "users_food_time.foodt_id = '".$id."' ";
      $whereFood .= "and users_food_time.fag_allow = 'allow' ";

      $this->db->select('users_food_time.*');
      $this->db->from('users_food_time');
      $this->db->where($whereFood);
      $queryFood = $this->db->get();
      $dataFood = $queryFood->row();
      //echo $this->db->last_query();
      $numRow = $queryFood->num_rows();
      if ($numRow > 0 ) {
          if($dataFood->food_source == 'เมนูจากระบบ'){
            $food_source_id = 1;
          }else if($dataFood->food_source == 'เมนูปรุงเอง'){
            $food_source_id = 2;
          }else if($dataFood->food_source == 'เมนูร้านอาหาร'){
            $food_source_id = 3;
          }else{
            $food_source_id = 0;
          }

          if($dataFood->eat_time == 'เช้า'){
            $eat_time_id = 1;
          }else if($dataFood->eat_time == 'กลางวัน'){
            $eat_time_id = 2;
          }else if($dataFood->eat_time == 'เย็น'){
            $eat_time_id = 3;
          }else if($dataFood->eat_time == 'อาหารว่าง'){
            $eat_time_id = 4;
          }

          $res = array();
          $res['foodt_id'] = intval($dataFood->foodt_id);
          $res['food_id'] = intval($dataFood->food_id);
          $res['user_id'] = intval($dataFood->user_id);
          $res['food_source'] = $dataFood->food_source;
          $res['food_source_id'] = intval($food_source_id);
          $res['eat_time'] = $dataFood->eat_time;
          $res['eat_time_id'] = intval($eat_time_id);
          $res['date_eat'] = $dataFood->date_eat;
          $res['food_energy'] = $dataFood->food_energy;

          return $res;
      } else {
          return false;
      }
    }

    public function getMenuFoodDetail($id='')
    {
      $whereFood = "self_food_menu.self_food_id = '".$id."' ";
      //$whereFood .= "and users_food_time.fag_allow = 'allow' ";
      $this->db->select(' self_food_menu.self_food_id,
                          self_food_menu.self_food_name,
                          self_food_menu.food_source,
                          self_food_menu.energy_amt');
      $this->db->from('self_food_menu');
      $this->db->where($whereFood);
      $queryMenuFood = $this->db->get();
      $dataMenuFood = $queryMenuFood->row();
      //echo $this->db->last_query();

      $this->db->select(' self_food_menu.self_food_id,
                          self_food_menu.self_food_name,
                          self_food_menu_composition.amount,
                          self_food_menu.food_source,
                          self_food_menu.energy_amt,
                          raw_material.*');
      $this->db->from('self_food_menu_composition');
      $this->db->join('self_food_menu', "self_food_menu.self_food_id = self_food_menu_composition.self_food_id");
      $this->db->join('raw_material', "self_food_menu_composition.rmat_id = raw_material.rmat_id");
      $this->db->where($whereFood);
      $this->db->group_by('raw_material.rmat_id');
      $queryFood = $this->db->get();
      $dataFood = $queryFood->row();
      //echo $this->db->last_query();
      $numRow = $queryMenuFood->num_rows();
      if ($numRow > 0 ) {
          if($dataMenuFood->food_source == 'เมนูจากระบบ'){
            $food_source_id = 1;
          }else if($dataMenuFood->food_source == 'เมนูปรุงเอง'){
            $food_source_id = 2;
          }else if($dataMenuFood->food_source == 'เมนูร้านอาหาร'){
            $food_source_id = 3;
          }else{
            $food_source_id = 0;
          }

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

          foreach ($queryFood->result() as $row)
          {
            $sum_cpf = $row->carboh_val+$dataFood->protein_val+$row->fat_val;
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
              if($dataFood->fat_val>0){
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
         }

          $res = array();
          $res['food_id'] = intval($dataMenuFood->self_food_id);
          $res['food_source'] = $dataMenuFood->food_source;//
          $res['food_name'] = $dataMenuFood->self_food_name;
          $res['food_source_id'] = intval($food_source_id);
          $res['food_energy'] = $dataMenuFood->energy_amt;
          $res['protein_val'] = number_format($protein_val,2);
          $res['fat_val'] = number_format($fat_val,2);
          $res['carboh_val'] = number_format($carboh_val,2);
          $res['sodium_val'] = number_format($sodium_val,2);
          $res['sugar_val'] = number_format($sugar_val,2);
          $res['vita_val'] = number_format($vita_val,2);
          $res['thiamin_val'] = number_format($thiamin_val,2);
          $res['niacin_val'] = number_format($niacin_val,2);
          $res['vitc_val'] = number_format($vitc_val,2);
          $res['vite_val'] = number_format($vite_val,2);

          return $res;
      } else {
          return false;
      }
    }

    public function getFoodMenu($food_source='')
    {
      $where = " self_food_id != '' ";
      if($food_source != ''){
        $where .= " and food_source = '".$food_source."' ";
      }

      $this->db->select('self_food_id, self_food_name, energy_amt');
      $this->db->from('self_food_menu');
      $this->db->where($where);
      $query = $this->db->get();
      foreach ($query->result() as $row)
      {
        $data_food_menu[]  = array(
                                'self_food_id'=>intval($row->self_food_id),
                                'self_food_name'=>$row->self_food_name,
                                'energy_amt'=>number_format($row->energy_amt,2)
                              );
      }
      $res['data_food_menu'] = $data_food_menu;
      return $res;
    }

    public function save($data=array(), $where=array()){

        if($where){
            $this->db->where($where);
            $this->db->update('users_food_time', $data);
            $res['id'] = $where['exam_id'];
        }else{

            $this->db->insert('users_food_time', $data);
            $id = $this->db->insert_id();
            $res['id'] = $id;
        }
        return $res;
    }



}
