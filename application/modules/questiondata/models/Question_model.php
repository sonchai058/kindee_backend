<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Question_model Class
 * @date 2019-12-05
 */
class Question_model extends MY_Model
{

	private $my_table;
	public $session_name;
	public $order_field;
	public $order_sort;
	public $owner_record;

	public function __construct()
	{
		parent::__construct();
		$this->my_table = 'question';
		$this->set_table_name($this->my_table);
		$this->order_field = '';
		$this->order_sort = '';
	}


	public function exists($data)
	{
		$question_id = checkEncryptData($data['question_id']);
		$this->set_where("$this->my_table.question_id = $question_id");
		return $this->count_record();
	}


	public function load($id)
	{
		$this->set_where("$this->my_table.question_id = $id");
		return $this->load_record();
	}


	public function create($post)
	{

		$data = array(
			'date_public' => setDateToStandard($post['date_public']), 'question_name' => $post['question_name'], 'question_detail' => $post['question_detail'], 'question_status' => 'not_responded', 'fag_allow' => 'allow'
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
		if ($this->session->userdata('user_level') == 'nutritionist') {
			$search_field 	= $this->session->userdata($this->session_name . '_search_field');
			$value 	= $this->session->userdata($this->session_name . '_value');
			$value 	= trim($value);
			$order_by_desc = 'date_public DESC';
			$where	= '';
			$order_by	= '';
			if ($this->order_field != '') {
				$order_field = $this->order_field;
				$order_sort = $this->order_sort;
				$order_by	= " $this->my_table.$order_field $order_sort";
			}

			if ($search_field != '' && $value != '') {
				$search_method_field = "$this->my_table.$search_field";
				$search_method_value = '';
				if ($search_field == 'question_name') {
					$search_method_value = "LIKE '%$value%'";
				}
				if ($search_field == 'question_detail') {
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

			if ($where == '') {
				$offset = $start_row;
				$limit = $per_page;
				$this->set_order_by($order_by_desc);
				$this->set_offset($offset);
				$this->set_limit($limit);
				$this->db->select("$this->my_table.*, users_1.user_fname AS userDeleteUserFname
				, users_2.user_fname AS userAddUserFname
				, users_3.user_fname AS userUpdateUserFname
				");
				$this->db->join('users AS users_1', "$this->my_table.user_delete = users_1.user_id", 'left');
				$this->db->join('users AS users_2', "$this->my_table.user_add = users_2.user_id", 'left');
				$this->db->join('users AS users_3', "$this->my_table.user_update = users_3.user_id", 'left');

				$list_record = $this->list_record();
				$total_row = count($list_record);

				$data = array(
					'total_row'	=> $total_row,
					'search_row'	=> $search_row,
					'list_data'	=> $list_record
				);
				return $data;
			} else if ($where != '') {
				$offset = $start_row;
				$search_row = $this->count_record();
				$limit = $per_page;
				$this->set_order_by($order_by);
				$this->set_offset($offset);
				$this->set_limit($limit);
				$this->db->join('users AS users_1', "$this->my_table.user_delete = users_1.user_id", 'left');
				$this->db->join('users AS users_2', "$this->my_table.user_add = users_2.user_id", 'left');
				$this->db->join('users AS users_3', "$this->my_table.user_update = users_3.user_id", 'left');


				$this->set_where($where);
				$search_row = $this->count_record();

				$list_record = $this->list_record();

				$data = array(
					'total_row'	=> $total_row,
					'search_row'	=> $search_row,
					'list_data'	=> $list_record
				);
				// print_r($this->db->last_query());
				// die();

				return $data;
			}
		} else if ($this->session->userdata('user_level') == 'user') {
			$search_field 	= $this->session->userdata($this->session_name . '_search_field');
			$value 	= $this->session->userdata($this->session_name . '_value');
			$value 	= trim($value);

			$where	= '';
			$order_by	= '';
			if ($this->order_field != '') {
				$order_field = $this->order_field;
				$order_sort = $this->order_sort;
				$order_by	= " $this->my_table.$order_field $order_sort";
			}

			if ($search_field != '' && $value != '') {
				$search_method_field = "$this->my_table.$search_field";
				$search_method_value = '';
				if ($search_field == 'question_name') {
					$search_method_value = "LIKE '%$value%'";
				}
				if ($search_field == 'question_detail') {
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
			$where_user_id = " {$this->my_table}.user_add=" . $this->session->userdata('user_id');
			$where_user = " AND {$this->my_table}.user_add=" . $this->session->userdata('user_id');

			if ($where == '') {
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
				$this->set_where($where_user_id);

				$list_record = $this->list_record();
				$total_row = count($list_record);

				$data = array(
					'total_row'	=> $total_row,
					'search_row'	=> $total_row,
					'list_data'	=> $list_record
				);
				// print_r($this->db->last_query());
				// die();

				return $data;
			} else if ($where != '') {
				$offset = $start_row;
				$search_row = $this->count_record();
				$limit = $per_page;
				$this->set_order_by($order_by);
				$this->set_offset($offset);
				$this->set_limit($limit);
				$this->db->join('users AS users_1', "$this->my_table.user_delete = users_1.user_id", 'left');
				$this->db->join('users AS users_2', "$this->my_table.user_add = users_2.user_id", 'left');
				$this->db->join('users AS users_3', "$this->my_table.user_update = users_3.user_id", 'left');

				$this->set_where($where . $where_user);
				$search_row = $this->count_record();

				$list_record = $this->list_record();

				$data = array(
					'total_row'	=> $total_row,
					'search_row'	=> $search_row,
					'list_data'	=> $list_record
				);

				return $data;
			}
		}
	}

	public function update($post)
	{
		$data = array(
			'date_public' => setDateToStandard($post['date_public']), 'question_name' => $post['question_name'], 'question_detail' => $post['question_detail']
			//,'fag_allow' => $post['fag_allow']
		);

		$question_id = checkEncryptData($post['encrypt_question_id']);
		$this->set_where("$this->my_table.question_id = $question_id");
		return $this->update_record($data);
	}

	public function update_answer($post)
	{
		$data = array(
			'answer_question' => $post['answer_question'], 'user_answer' => $this->session->userdata('user_id'), 'question_status' => 'responded',
			//,'fag_allow' => $post['fag_allow']
		);

		$question_id = checkEncryptData($post['encrypt_question_id']);
		$this->set_where("$this->my_table.question_id = $question_id");
		return $this->update_record($data);
	}


	public function delete($post)
	{
		$question_id = checkEncryptData($post['encrypt_question_id']);
		$this->set_where("$this->my_table.question_id = $question_id");
		return $this->delete_record();
	}
}
/*---------------------------- END Model Class --------------------------------*/
