<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Shop_food_menu_model Class
 * @date 2019-12-07
 */
class Shop_food_menu_model extends MY_Model
{

	private $my_table;
	public $session_name;
	public $order_field;
	public $order_sort;
	public $owner_record;

	public function __construct()
	{
		parent::__construct();
		$this->my_table = 'self_food_menu';
		$this->set_table_name($this->my_table);
		$this->order_field = '';
		$this->order_sort = '';
	}


	public function exists($data)
	{
		$self_food_id = checkEncryptData($data['self_food_id']);
		$this->set_where("$this->my_table.self_food_id = $self_food_id");
		return $this->count_record();
	}


	public function load($id)
	{
		$this->set_where("$this->my_table.self_food_id = $id");
		return $this->load_record();
	}


	public function create($post)
	{

		$data = array(
				'self_food_name' => $post['self_food_name']
				,'cate_id' => $post['cate_id']
				,'price_amt' => str_replace(",", "", $post['price_amt'])
				//,'energy_amt' => str_replace(",", "", $post['energy_amt'])
				,'fag_allow' => 'allow'
				,'food_source'=> 'เมนูร้านอาหาร',
				'shop_id'=>$post['shop_id'],
				'user_id'=>$this->session->userdata('user_id')
		);
		return $this->add_record($data);
	}


	/**
	* List all data
	* @param $start_row	Number offset record start
	* @param $per_page	Number limit record perpage
	*/
	public function read($start_row, $per_page)
	{
		$search_field 	= $this->session->userdata($this->session_name . '_search_field');
		$value 	= $this->session->userdata($this->session_name . '_value');
		$value 	= trim($value);

		$where	= '';
		$order_by	= 'datetime_update DESC';
		if($this->order_field != ''){
			$order_field = $this->order_field;
			$order_sort = $this->order_sort;
			$order_by	= " $this->my_table.$order_field $order_sort";
		}

		if($search_field != '' && $value != ''){
			$search_method_field = "$this->my_table.$search_field";
			$search_method_value = '';
			if($search_field == 'self_food_name'){
				$search_method_value = "LIKE '%$value%'";
			}
			if($search_field == 'cate_id'){
				$search_method_field = "category_1.cate_name";
				$search_method_value = "LIKE '%$value%'";
			}
			if($search_field == 'price_amt'){
				if(!is_numeric($value)){
					$value = 0;
				}
				$value = $value + 0;
				$search_method_value = "LIKE '%$value%'";
			}
			if($search_field == 'user_update'){
				$search_method_field = "users_4.user_fname";
				$search_method_value = "LIKE '%$value%'";
			}
			if($search_field == 'fag_allow'){
				$search_method_value = "LIKE '%$value%'";
			}
			$where	.= ($where != '' ? ' AND ' : '') . " $search_method_field $search_method_value ";
			if($order_by == ''){
				$order_by	= " $this->my_table.$search_field";
			}
		}
		$total_row = $this->count_record();
		$search_row = $total_row;
		if ($where != '') {
			$this->db->join('category AS category_1', "$this->my_table.cate_id = category_1.cate_id", 'left');
		$this->db->join('users AS users_2', "$this->my_table.user_delete = users_2.user_id", 'left');
		$this->db->join('users AS users_3', "$this->my_table.user_add = users_3.user_id", 'left');
		$this->db->join('users AS users_4', "$this->my_table.user_update = users_4.user_id", 'left');

			$this->set_where($where);
			$search_row = $this->count_record();
		}
		$offset = $start_row;
		$limit = $per_page;
		$this->set_order_by($order_by);
		$this->set_offset($offset);
		$this->set_limit($limit);
		$this->db->select("$this->my_table.*, category_1.cate_name AS cateIdCateName
				, users_2.user_fname AS userDeleteUserFname
				, users_3.user_fname AS userAddUserFname
				, users_4.user_fname AS userUpdateUserFname
				");
		$this->db->join('category AS category_1', "$this->my_table.cate_id = category_1.cate_id", 'left');
		$this->db->join('users AS users_2', "$this->my_table.user_delete = users_2.user_id", 'left');
		$this->db->join('users AS users_3', "$this->my_table.user_add = users_3.user_id", 'left');
		$this->db->join('users AS users_4', "$this->my_table.user_update = users_4.user_id", 'left');

		$list_record = $this->list_record();
		$data = array(
				'total_row'	=> $total_row,
				'search_row'	=> $search_row,
				'list_data'	=> $list_record
		);
		return $data;
	}

	public function update($post)
	{
		$data = array(
				'self_food_name' => $post['self_food_name']
				,'cate_id' => $post['cate_id']
				,'price_amt' => str_replace(",", "",$post['price_amt'])
				//,'energy_amt' => str_replace(",", "",$post['energy_amt'])
				//,'fag_allow' => $post['fag_allow']
		);

		$self_food_id = checkEncryptData($post['encrypt_self_food_id']);
		$this->set_where("$this->my_table.self_food_id = $self_food_id");
		return $this->update_record($data);
	}


	public function delete($post)
	{
		$self_food_id = checkEncryptData($post['encrypt_self_food_id']);
		$this->set_where("$this->my_table.self_food_id = $self_food_id");
		return $this->delete_record();
	}


}
/*---------------------------- END Model Class --------------------------------*/
