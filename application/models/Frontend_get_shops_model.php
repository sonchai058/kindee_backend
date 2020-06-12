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

	public function read($start_row)
	{
		$order_by	= 'datetime_update DESC';
		$offset = $start_row;

		$this->set_order_by($order_by);
		$this->set_offset($offset);
		$this->set_limit(4);
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
		// print_r($this->db->last_query());
		// die();

		$data = array(
			'list_data'	=> $list_record
		);
		return $data;
	}
}
/*---------------------------- END Model Class --------------------------------*/
