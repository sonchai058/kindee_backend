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

        $whereFood = "users_food.user_id = '".$dataUser->user_id."' ";
        $whereFood .= " and users_food.date_eat = '".$date."' ";
        $whereFoodType1 .= " and users_food.eat_time = 'เช้า' ";
        $whereFoodType2 .= " and users_food.eat_time = 'กลางวัน' ";
        $whereFoodType3 .= " and users_food.eat_time = 'เย็น' ";
        $whereFoodType4 .= " and users_food.eat_time = 'ว่าง' ";

        $this->db->select('menu.self_food_name, users_food.food_energy');
        $this->db->from('users_food_time as users_food');
        $this->db->join('self_food_menu as menu', "users_food.food_id = menu.self_food_id", 'left');
        $this->db->where($whereFood.$whereFoodType1);
        $queryFoodType1 = $this->db->get();

        $this->db->select('SUM(food_energy) as sum');
        $this->db->from('users_food_time as users_food');
        $this->db->where($whereFood.$whereFoodType1);
        $querySumEnergy1 = $this->db->get();
        $dataSumEnergy1 = $querySumEnergy1->row();

        $this->db->select('menu.self_food_name, users_food.food_energy');
        $this->db->from('users_food_time as users_food');
        $this->db->join('self_food_menu as menu', "users_food.food_id = menu.self_food_id", 'left');
        $this->db->where($whereFood.$whereFoodType2);
        $queryFoodType2 = $this->db->get();

        $this->db->select('SUM(food_energy) as sum');
        $this->db->from('users_food_time as users_food');
        $this->db->where($whereFood.$whereFoodType2);
        $querySumEnergy2 = $this->db->get();
        $dataSumEnergy2 = $querySumEnergy2->row();

        $this->db->select('menu.self_food_name, users_food.food_energy');
        $this->db->from('users_food_time as users_food');
        $this->db->join('self_food_menu as menu', "users_food.food_id = menu.self_food_id", 'left');
        $this->db->where($whereFood.$whereFoodType3);
        $queryFoodType3 = $this->db->get();

        $this->db->select('SUM(food_energy) as sum');
        $this->db->from('users_food_time as users_food');
        $this->db->where($whereFood.$whereFoodType3);
        $querySumEnergy3 = $this->db->get();
        $dataSumEnergy3 = $querySumEnergy3->row();

        $this->db->select('menu.self_food_name, users_food.food_energy');
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
            $res = array();
            $res['user_id'] = $dataUser->user_id;
            $data_food1  = array();
            $data_food2  = array();
            $data_food3  = array();
            $data_food4  = array();
            foreach ($queryFoodType1->result() as $row)
            {
              $data_food1[]  = array(
                                      'food_name'=>$row->self_food_name,
                                      'food_energy'=>$row->food_energy
                                    );
            }
            foreach ($queryFoodType2->result() as $row)
            {
              $data_food2[]  = array(
                                      'food_name'=>$row->self_food_name,
                                      'food_energy'=>$row->food_energy
                                    );
            }
            foreach ($queryFoodType3->result() as $row)
            {
              $data_food3[]  = array(
                                      'food_name'=>$row->self_food_name,
                                      'food_energy'=>$row->food_energy
                                    );
            }
            foreach ($queryFoodType4->result() as $row)
            {
              $data_food4[]  = array(
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
                                'self_food_id'=>$row->self_food_id,
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
