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

    public function getShopDetail($shop_id='')
    {

      $whereShop = "shops.shop_id = '".$drug_id."' ";
      $where = " fag_allow = 'allow' ";
      $this->db->select('*');
      $this->db->from('shops');
      $this->db->where($where);
      $queryShops = $this->db->get();
      $data = $queryShops->row();
      $numRow = $queryShops->num_rows();
      if ($numRow > 0 ) {
          $res = array();
          $res['shop_id'] = $data->shop_id;
          $res['shop_name_th'] = $data->shop_name_th;
          $res['shop_photo'] = $data->shop_photo;
          $res['mobile_no'] = $data->mobile_no;
          $res['email_addr'] = $data->email_addr;
          $res['addr'] = $data->addr;
          $res['point_lat'] = $data->point_lat;
          $res['point_lat'] = $data->point_lat;
          $res['point_long'] = $data->point_long;
          return $res;
      } else {
          return false;
      }

    }

}
