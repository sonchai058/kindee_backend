<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Outfood_model Class
 * @date 2019-12-05
 */
class Outfood_model extends MY_Model
{

	private $my_table;
	public $session_name;
	public $order_field;
	public $order_sort;
	public $owner_record;

	public function __construct()
	{
		parent::__construct();
		$this->my_table = 'outfood';
		$this->my_table_1 = 'raw_material_1';
		$this->my_column = 'rmat_name';

		$this->set_table_name($this->my_table);
		$this->order_field = '';
		$this->order_sort = '';
	}


	public function exists($data)
	{
		$outfood_id = checkEncryptData($data['outfood_id']);
		$this->set_where("$this->my_table.outfood_id = $outfood_id");
		return $this->count_record();
	}


	public function load($id)
	{
		$this->set_where("$this->my_table.outfood_id = $id");
		return $this->load_record();
	}


	public function create($post)
	{

		$data = array(
			'date_public' => setDateToStandard($post['date_public']), 'rmat_id' => $post['rmat_id'], 'fag_allow' => 'allow'
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
		// echo "<pre>";
		// print_r($search_field);
		// echo "</pre>";
		// die();
		$where	= '';
		$order_by	= '';
		if ($this->order_field != '') {
			$order_field = $this->order_field;
			$order_sort = $this->order_sort;
			$order_by	= " $this->my_table.$order_field $order_sort";
		}

		if ($search_field != '' && $value != '') {
			$search_method_field = "$this->my_table_1.$this->my_column";

			$search_method_value = '';
			if ($search_field == 'rmat_id') {
				$search_method_value = "LIKE '%$value%'";
			}
			if ($search_field == 'user_update') {
				$search_method_field = "users_3.user_fname";
				$search_method_value = "LIKE '%$value%'";
			}
			if ($search_field == 'fag_allow') {
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
			$this->db->join('users AS users_1', "$this->my_table.user_delete = users_1.user_id", 'left');
			$this->db->join('users AS users_2', "$this->my_table.user_add = users_2.user_id", 'left');
			$this->db->join('users AS users_3', "$this->my_table.user_update = users_3.user_id", 'left');
			$this->db->join('raw_material AS raw_material_1', "$this->my_table.rmat_id = raw_material_1.rmat_id", 'left');

			$this->set_where($where);
			$search_row = $this->count_record();
			// echo $this->db->last_query();
			// die();
		}
		$offset = $start_row;
		$limit = $per_page;
		$this->set_order_by($order_by);
		$this->set_offset($offset);
		$this->set_limit($limit);
		$this->db->select("$this->my_table.*, users_1.user_fname AS userDeleteUserFname
				, users_2.user_fname AS userAddUserFname
				, users_3.user_fname AS userUpdateUserFname
				");
		$this->db->join('users AS users_1', "$this->my_table.user_delete = users_1.user_id", 'left');
		$this->db->join('users AS users_2', "$this->my_table.user_add = users_2.user_id", 'left');
		$this->db->join('users AS users_3', "$this->my_table.user_update = users_3.user_id", 'left');
		$this->db->join('raw_material AS raw_material_1', "$this->my_table.rmat_id = raw_material_1.rmat_id", 'left');


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
			'date_public' => setDateToStandard($post['date_public']), 'rmat_id' => $post['rmat_id']
			//,'fag_allow' => $post['fag_allow']
		);

		$outfood_id = checkEncryptData($post['encrypt_outfood_id']);
		$this->set_where("$this->my_table.outfood_id = $outfood_id");
		return $this->update_record($data);
	}


	public function delete($post)
	{
		$outfood_id = checkEncryptData($post['encrypt_outfood_id']);
		$this->set_where("$this->my_table.outfood_id = $outfood_id");
		return $this->delete_record_Outfood();
	}
}
/*---------------------------- END Model Class --------------------------------*/
