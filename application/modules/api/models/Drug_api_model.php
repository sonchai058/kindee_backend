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
        //$whereChemical .= " and exam_date = '".$date."' ";
        $this->db->select('*');
        $this->db->from('users_drug');
        $this->db->where($whereDrug);
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
              $show_date_eat = $arr_date[1];
              $data_drug[]  = array(
                                      'date_eat'=>$show_date_eat,
                                      'drug_name'=>$row->drug_name
                                    );
            }
            $res['data_drug'] = $data_drug;
            return $res;
        } else {
            return false;
        }

    }

}
