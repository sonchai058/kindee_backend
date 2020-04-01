<?php
class Foodallergy_api_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function getFoodallergy($pid='', $date='')
    {

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email_addr', $pid);
        $queryUser = $this->db->get();
        $dataUser = $queryUser->row();

        $whereFoodallergy = "users_result_exam_food_allergy.user_id = '".$dataUser->user_id."' ";
        $whereFoodallergy .= "and users_result_exam_food_allergy.fag_allow = 'allow' ";

        //$whereFoodallergy .= " and users_food.date_eat = '".$date."' ";

        $this->db->select('food_allergy.alg_name, users_result_exam_food_allergy.*');
        $this->db->from('users_result_exam_food_allergy');
        $this->db->join('food_allergy', "users_result_exam_food_allergy.alg_id = food_allergy.alg_id", 'left');
        $this->db->where($whereFoodallergy);
        $queryFoodallergy = $this->db->get();


        $numMember = $queryUser->num_rows();
        if ($numMember > 0 ) {
            $res = array();
            $res['user_id'] = $dataUser->user_id;
            $data_food1  = array();
            foreach ($queryFoodallergy->result() as $row)
            {
              $data_foodallergy[]  = array(
                                      'exam_id'=>$row->exam_id,
                                      'food_name'=>$row->alg_name,
                                      'food_alg_val'=>$row->food_alg_val
                                    );
            }

            $res['data_foodallergy'] = $data_foodallergy;

            return $res;
        } else {
            return false;
        }

    }

    public function getFoodallergyDetail($exam_id='')
    {

        $whereFoodallergy = "users_result_exam_food_allergy.exam_id = '".$exam_id."' ";
        $whereFoodallergy .= "and users_result_exam_food_allergy.fag_allow = 'allow' ";

        //$whereFoodallergy .= " and users_food.date_eat = '".$date."' ";

        $this->db->select('users_result_exam_food_allergy.*, food_allergy.alg_name');
        $this->db->from('users_result_exam_food_allergy');
        $this->db->join('food_allergy', "users_result_exam_food_allergy.alg_id = food_allergy.alg_id", 'left');
        $this->db->where($whereFoodallergy);
        $queryFoodallergy = $this->db->get();
        $dataFoodallergy = $queryFoodallergy->row();
        //echo $this->db->last_query();
        $numRow = $queryFoodallergy->num_rows();
        if ($numRow > 0 ) {
            $res = array();
            $res['exam_id'] = $dataFoodallergy->exam_id;
            $res['user_id'] = $dataFoodallergy->user_id;
            $res['alg_id'] = $dataFoodallergy->alg_id;
            $res['alg_name'] = $dataFoodallergy->alg_name;
            $res['food_alg_val'] = $dataFoodallergy->food_alg_val;

            return $res;
        } else {
            return false;
        }

    }

    public function getFoodallergyList()
    {
        $this->db->select('alg_id, alg_name');
        $this->db->from('food_allergy');
        $this->db->order_by("alg_name", "asc");
        $query = $this->db->get();
        foreach ($query->result() as $row)
        {
          $data_food_allergy[]  = array(
                                  'alg_id'=>$row->alg_id,
                                  'alg_name'=>$row->alg_name
                                );
        }
        $res['data_food_allergy'] = $data_food_allergy;
        return $res;
    }

    public function save($data=array(), $where=array()){

        if($where){
            $this->db->where($where);
            $this->db->update('users_result_exam_food_allergy', $data);
            $res['id'] = $where['ualg_id'];
        }else{

            $this->db->insert('users_result_exam_food_allergy', $data);
            $id = $this->db->insert_id();
            $res['id'] = $id;
        }
        return $res;
    }

}
