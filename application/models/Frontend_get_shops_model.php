<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Frontend_get_shops_model Class
 * @date 2019-12-05
 */
class Frontend_get_shops_model extends MY_Model
{

	private $my_table;
	public $session_name;
	public $order_field;
	public $order_sort;
	public $owner_record;

	public function __construct()
	{
		parent::__construct();
		$this->my_table = 'shops';
		$this->set_table_name($this->my_table);
		$this->order_field = '';
		$this->order_sort = '';
	}

	public function read($start_row, $per_page)
	{
		$total_row = $this->count_record();
		$search_row = $total_row;

		$order_by	= 'datetime_update DESC';
		$offset = $start_row;
		$limit = $per_page;


		$this->set_order_by($order_by);
		$this->set_offset($offset);
		$this->set_limit($limit);
		// $this->set_limit(8);
		$this->db->select("$this->my_table.*, category_1.cate_name AS cateIdCateName
				, users_2.user_fname AS shopUserUserFname
				, users_3.user_fname AS userDeleteUserFname
				, users_4.user_fname AS userAddUserFname
				, users_5.user_fname AS userUpdateUserFname
				");
		$this->db->join('category AS category_1', "$this->my_table.cate_id = category_1.cate_id", 'left');
		$this->db->join('users AS users_2', "$this->my_table.shop_user = users_2.user_id", 'left');
		$this->db->join('users AS users_3', "$this->my_table.user_delete = users_3.user_id", 'left');
		$this->db->join('users AS users_4', "$this->my_table.user_add = users_4.user_id", 'left');
		$this->db->join('users AS users_5', "$this->my_table.user_update = users_5.user_id", 'left');

		$list_record = $this->list_record();
		//echo $this->db->last_query();
		// die();

		$data = array(
			'search_row'	=> $search_row,
			'total_row'	=> $total_row,
			'list_data'	=> $list_record
		);
		return $data;
	}

	public function detail_read($shop_id)
	{
		$order_by	= 'datetime_update DESC';

		$this->set_order_by($order_by);
		$this->db->select("$this->my_table.*, category_1.cate_name AS cateIdCateName
				, users_2.user_fname AS shopUserUserFname
				, users_3.user_fname AS userDeleteUserFname
				, users_4.user_fname AS userAddUserFname
				, users_5.user_fname AS userUpdateUserFname
				");
		$this->db->from($this->my_table);
		$this->db->join('category AS category_1', "$this->my_table.cate_id = category_1.cate_id", 'left');
		$this->db->join('users AS users_2', "$this->my_table.shop_user = users_2.user_id", 'left');
		$this->db->join('users AS users_3', "$this->my_table.user_delete = users_3.user_id", 'left');
		$this->db->join('users AS users_4', "$this->my_table.user_add = users_4.user_id", 'left');
		$this->db->join('users AS users_5', "$this->my_table.user_update = users_5.user_id", 'left');
		$this->db->where($this->my_table . ".shop_id='" . $shop_id . "'");
		$queryShops = $this->db->get();
		//echo $this->db->last_query();
		$row = $queryShops->row();

		$res = array();
		$res['shop_id'] = $row->shop_id;
		$res['shop_cover'] = $row->shop_cover;
		$res['shop_name_th'] = $row->shop_name_th;
		$res['shop_name_en'] = $row->shop_name_en;
		$res['addr'] = $row->addr;
		$res['mobile_no'] = $row->mobile_no;

		$data = $res;
		return $data;
	}

	public function food_read($shop_id)
	{

		$where = "self_food_menu.shop_id = '" . $shop_id . "' ";
		$where .= "and self_food_menu.fag_allow = 'allow' ";

		$this->db->select('self_food_menu.*,shop_food_menu_images.encrypt_name');
		$this->db->from('self_food_menu');
		$this->db->join('shop_food_menu_images', "shop_food_menu_images.food_id = self_food_menu.self_food_id", 'left');
		$this->db->where($where);
		$this->db->group_by("self_food_menu.self_food_id");
		$query = $this->db->get();
		//echo $this->db->last_query();
		$list_record = array();
		foreach ($query->result() as $row) {
			$list_record[] = array(
				'self_food_id' => $row->self_food_id,
				'self_food_name' => $row->self_food_name,
				'price_amt' => $row->price_amt,
				'energy_amt' => $row->energy_amt,
				'encrypt_name' => ($row->encrypt_name) ? $row->encrypt_name : './assets/uploads/shop_food_menu/no-image.jpg'
			);
		}

		$data = array(
			'list_data'	=> $list_record
		);
		return $data;
	}

	public function promotions_read($shop_id)
	{
		$where = "shop_promotions.shop_id = '" . $shop_id . "' ";
		$where .= "and shop_promotions.fag_allow = 'allow' ";

		$this->db->select('shop_promotions.*,promotions.pro_name');
		$this->db->from('shop_promotions');
		$this->db->join('promotions', "promotions.pro_id = shop_promotions.pro_id", 'left');
		$this->db->where($where);
		$this->db->group_by("shop_promotions.pro_id");
		$query = $this->db->get();
		//echo $this->db->last_query();
		$list_record = array();
		foreach ($query->result() as $row) {
			$list_record[] = array(
				'shop_id' => $row->shop_id,
				'pro_name' => $row->pro_name,
				'pro_discount' => $row->pro_discount
			);
		}

		$data = array(
			'list_data'	=> $list_record
		);
		return $data;
	}

	public function read_index($start_row)
	{
		$order_by	= 'datetime_update DESC';
		$offset = $start_row;
		$this->set_order_by($order_by);
		$this->set_offset($offset);
		$this->set_limit(8);
		$this->db->select("$this->my_table.*, category_1.cate_name AS cateIdCateName
				, users_2.user_fname AS shopUserUserFname
				, users_3.user_fname AS userDeleteUserFname
				, users_4.user_fname AS userAddUserFname
				, users_5.user_fname AS userUpdateUserFname
				");
		$this->db->join('category AS category_1', "$this->my_table.cate_id = category_1.cate_id", 'left');
		$this->db->join('users AS users_2', "$this->my_table.shop_user = users_2.user_id", 'left');
		$this->db->join('users AS users_3', "$this->my_table.user_delete = users_3.user_id", 'left');
		$this->db->join('users AS users_4', "$this->my_table.user_add = users_4.user_id", 'left');
		$this->db->join('users AS users_5', "$this->my_table.user_update = users_5.user_id", 'left');

		$list_record = $this->list_record();
		//echo $this->db->last_query();
		// die();

		$data = array(
			'list_data'	=> $list_record
		);
		return $data;
	}
}
/*---------------------------- END Model Class --------------------------------*/
