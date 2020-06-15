<?php
class Chemical_api_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function getChemical($pid='', $date='')
    {

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email_addr', $pid);
        $queryUser = $this->db->get();
        $dataUser = $queryUser->row();

        $whereChemical = "user_id = '".$dataUser->user_id."' ";
        $whereChemical .= " and exam_date = '".$date."' ";
        $this->db->select('*');
        $this->db->from('users_result_exam_chemical');
        $this->db->where($whereChemical);
        $queryChemical = $this->db->get();
        $dataChemical = $queryChemical->row();

        $numMember = $queryUser->num_rows();
        if ($numMember > 0 ) {
            $res = array();
            $res['user_id'] = $dataUser->user_id;
            $res['exam_id'] = $dataChemical->exam_id;
            $res['exam_date'] = $dataChemical->exam_date;
            $res['fasting_glu'] = $this->setVal($dataChemical->fasting_glu);
            $res['hemo_glo'] = $this->setVal($dataChemical->hemo_glo);
            $res['kidney_blood'] = $this->setVal($dataChemical->uric_arid);
            $res['uric_arid'] = $this->setVal($dataChemical->uric_arid);
            $res['hdl_chol'] = $this->setVal($dataChemical->hdl_chol);
            $res['ldl_chol'] = $this->setVal($dataChemical->ldl_chol);
            $res['trig_cer'] = $this->setVal($dataChemical->trig_cer);
            return $res;
        } else {
            return false;
        }

    }

    public function save($data=array(), $where=array()){

        if($where){
            $this->db->where($where);
            $this->db->update('users_result_exam_chemical', $data);
            $res['id'] = $where['exam_id'];
        }else{

            $this->db->insert('users_result_exam_chemical', $data);
            $id = $this->db->insert_id();
            $res['id'] = $id;
        }
        return $res;
    }

    public function setVal($val='')
    {
      if($val){
        $show_val = number_format($val,2);
      }else{
        $show_val = '';
      }
      return $show_val;
    }


}
