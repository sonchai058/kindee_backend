<?php
class Shops_api_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function getShops()
    {

        $where = " fag_allow = 'allow' ";
        $this->db->select('*');
        $this->db->from('shops');
        $this->db->where($where);
        $queryShops = $this->db->get();
        $dataShops = $queryShops->row();

        $numRow = $queryShops->num_rows();
        if ($numRow > 0 ) {
            $res = array();
            $data_shops  = array();
            foreach ($queryShops->result() as $row)
            {

              $data_shops[]  = array(
                                      'shop_id'=>$row->shop_id,
                                      'shop_name'=>$row->shop_name_th,
                                      'shop_photo'=>$row->shop_photo,
                                      'mobile_no'=>$row->mobile_no,
                                      'email_addr'=>$row->email_addr,
                                      'addr'=>$row->addr,
                                      'point_lat'=>$row->point_lat,
                                      'point_long'=>$row->point_long
                                    );
            }
            $res['data_shops'] = $data_shops;
            return $res;
        } else {
            return false;
        }

    }

}
