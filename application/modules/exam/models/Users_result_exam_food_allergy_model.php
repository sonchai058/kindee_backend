<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Users_result_exam_food_allergy_model Class
 * @date 2019-12-07
 */
class Users_result_exam_food_allergy_model extends MY_Model
{

	private $my_table;
	public $session_name;
	public $order_field;
	public $order_sort;
	public $owner_record;

	public function __construct()
	{
		parent::__construct();
		$this->my_table = 'users_result_exam_food_allergy';
		$this->set_table_name($this->my_table);
		$this->order_field = '';
		$this->order_sort = '';
	}


	public function exists($data)
	{
		$exam_id = checkEncryptData($data['exam_id']);
		$this->set_where("$this->my_table.exam_id = $exam_id");
		return $this->count_record();
	}


	public function load($id)
	{
		$this->set_where("$this->my_table.exam_id = $id");
		return $this->load_record();
	}


	public function create($post)
	{

		$data = array(
			'user_id' => $post['user_id'], 'alg_id' => $post['alg_id'], 'food_type' => $post['food_type'], 'fag_allow' => 'allow', 'food_alg_val' => str_replace(",", "", $post['food_alg_val'])
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
		if ($this->order_field != '') {
			$order_field = $this->order_field;
			$order_sort = $this->order_sort;
			$order_by	= " $this->my_table.$order_field $order_sort";
		}

		if ($search_field != '' && $value != '') {
			$search_method_field = "$this->my_table.$search_field";
			$search_method_value = '';
			if ($search_field == 'alg_id') {
				$search_method_field = "food_allergy_2.alg_name";
				$search_method_value = "LIKE '%$value%'";
			}
			if ($search_field == 'user_update') {
				$search_method_field = "users_5.user_fname";
				$search_method_value = "LIKE '%$value%'";
			}
			if ($search_field == 'food_alg_val') {
				if (!is_numeric($value)) {
					$value = 0;
				}
				$value = $value + 0;
				$search_method_value = "LIKE '%$value%'";
			}
			$where	.= ($where != '' ? ' AND ' : '') . " $search_method_field $search_method_value ";
			if ($order_by == '') {
				$order_by	= " $this->my_table.$search_field";
			}
		}
		$total_row = $this->count_record();
		$search_row = $total_row;
		if ($where != '') {
			$this->db->join('users AS users_1', "$this->my_table.user_id = users_1.user_id", 'left');
			$this->db->join('food_allergy AS food_allergy_2', "$this->my_table.alg_id = food_allergy_2.alg_id", 'left');
			$this->db->join('users AS users_3', "$this->my_table.user_delete = users_3.user_id", 'left');
			$this->db->join('users AS users_4', "$this->my_table.user_add = users_4.user_id", 'left');
			$this->db->join('users AS users_5', "$this->my_table.user_update = users_5.user_id", 'left');

			$this->set_where($where);
			$search_row = $this->count_record();
		}
		$offset = $start_row;
		$limit = $per_page;
		$this->set_order_by($order_by);
		$this->set_offset($offset);
		$this->set_limit($limit);
		$this->db->select("$this->my_table.*, users_1.user_fname AS userIdUserFname
				, food_allergy_2.alg_name AS algIdAlgName
				, users_3.user_fname AS userDeleteUserFname
				, users_4.user_fname AS userAddUserFname
				, users_5.user_fname AS userUpdateUserFname
				");
		$this->db->join('users AS users_1', "$this->my_table.user_id = users_1.user_id", 'left');
		$this->db->join('food_allergy AS food_allergy_2', "$this->my_table.alg_id = food_allergy_2.alg_id", 'left');
		$this->db->join('users AS users_3', "$this->my_table.user_delete = users_3.user_id", 'left');
		$this->db->join('users AS users_4', "$this->my_table.user_add = users_4.user_id", 'left');
		$this->db->join('users AS users_5', "$this->my_table.user_update = users_5.user_id", 'left');

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
			'user_id' => $post['user_id'], 'alg_id' => $post['alg_id'], 'food_type' => $post['food_type']
			//,'fag_allow' => $post['fag_allow']
			, 'food_alg_val' => str_replace(",", "", $post['food_alg_val'])
		);

		$exam_id = checkEncryptData($post['encrypt_exam_id']);
		$this->set_where("$this->my_table.exam_id = $exam_id");
		return $this->update_record($data);
	}


	public function delete($post)
	{
		$exam_id = checkEncryptData($post['encrypt_exam_id']);
		$this->set_where("$this->my_table.exam_id = $exam_id");
		return $this->delete_record();
	}
}
/*---------------------------- END Model Class --------------------------------*/
