<?php
class Drug_api_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function getDrug($pid='', $date='')
    {

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email_addr', $pid);
        $queryUser = $this->db->get();
        $dataUser = $queryUser->row();

        $whereDrug = "user_id = '".$dataUser->user_id."' ";
        $whereDrug .= "and fag_allow = 'allow' ";
        //$whereChemical .= " and exam_date = '".$date."' ";
        $this->db->select('*');
        $this->db->from('users_drug');
        $this->db->where($whereDrug);
        $this->db->order_by("date_eat", "asc");
        $queryDrug = $this->db->get();
        $dataDrug = $queryDrug->row();

        $numMember = $queryUser->num_rows();
        if ($numMember > 0 ) {
            $res = array();
            $res['user_id'] = $dataUser->user_id;
            $data_drug  = array();
            foreach ($queryDrug->result() as $row)
            {
              $arr_date = explode(" ",$row->date_eat);
              $show_date_eat = substr($arr_date[1],0,5);
              $data_drug[]  = array(
                                      'drug_id'=>$row->drug_id,
                                      'date_eat'=>$show_date_eat,
                                      'eat_time'=>$row->eat_time,
                                      'drug_name'=>$row->drug_name
                                    );
            }
            $res['data_drug'] = $data_drug;
            return $res;
        } else {
            return false;
        }

    }

    public function getDrugDetail($drug_id='')
    {

      $whereDrug = "users_drug.drug_id = '".$drug_id."' ";
      $whereDrug .= "and users_drug.fag_allow = 'allow' ";

      //$whereFoodallergy .= " and users_food.date_eat = '".$date."' ";

      $this->db->select('users_drug.*');
      $this->db->from('users_drug');
      $this->db->where($whereDrug);
      $queryDrug = $this->db->get();
      $dataDrug = $queryDrug->row();
      //echo $this->db->last_query();
      $numRow = $queryDrug->num_rows();
      if ($numRow > 0 ) {
          $arr_date = explode(" ",$dataDrug->date_eat);
          $show_date_eat = substr($arr_date[1],0,5);
          if($dataDrug->eat_time=="ก่อนอาหาร"){
            $eat_time =  1;
          }else if($dataDrug->eat_time=="หลังอาหาร"){
            $eat_time =  2;
          }
          $res = array();
          $res['drug_id'] = $dataDrug->drug_id;
          $res['user_id'] = $dataDrug->user_id;
          $res['drug_name'] = $dataDrug->drug_name;
          $res['eat_time'] = $eat_time;
          $res['date_eat'] = $show_date_eat;

          return $res;
      } else {
          return false;
      }

    }

    public function save($data=array(), $where=array()){

        if($where){
            $this->db->where($where);
            $this->db->update('users_drug', $data);
            $res['id'] = $where['drug_id'];
        }else{

            $this->db->insert('users_drug', $data);
            $id = $this->db->insert_id();
            $res['id'] = $id;
        }
        return $res;
    }

}
