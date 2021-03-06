<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Users_model Class
 * @date 2019-12-05
 */
class Users_model extends MY_Model
{

	private $my_table;
	public $session_name;
	public $order_field;
	public $order_sort;
	public $owner_record;

	public function __construct()
	{
		parent::__construct();
		$this->my_table = 'users';
		$this->set_table_name($this->my_table);
		$this->order_field = '';
		$this->order_sort = '';
	}


	public function exists($data)
	{
		$user_id = checkEncryptData($data['user_id']);
		$this->set_where("$this->my_table.user_id = $user_id");
		return $this->count_record();
	}


	public function load($id)
	{
		$this->set_where("$this->my_table.user_id = $id");
		return $this->load_record();
	}


	public function create($post)
	{

		$data = array(
			'title_name' => $post['title_name'],
			'user_photo' => $post['user_photo'],
			'user_fname' => $post['user_fname'],
			'user_lname' => $post['user_lname'],
			'date_of_birth' => setDateToStandard($post['date_of_birth']),
			'mobile_no' => $post['mobile_no'],
			'email_addr' => $post['email_addr'],
			'cus_passwd' => $post['cus_passwd'],
			'addr' => $post['addr'],
			'fag_allow' => 'allow',
			'org_id' => @$post['org_id'],
			'user_sex' => $post['user_sex'],
			'user_height' => str_replace(",", "", $post['user_height']),
			'goal_reduce_weight' => str_replace(",", "", $post['goal_reduce_weight']),
			'reduce_date_start' => setDateToStandard($post['reduce_date_start']),
			'reduce_date_end' => setDateToStandard($post['reduce_date_end']),
			'goal_increase_weight' => str_replace(",", "", $post['goal_increase_weight']),
			'increase_date_start' => setDateToStandard($post['increase_date_start']),
			'increase_date_end' => setDateToStandard($post['increase_date_end']),
			'user_level' => @$post['user_level'],
			'limit_allmeat' => $post['limit_allmeat'],
			'limit_pig' => $post['limit_pig'],
			'limit_meat' => $post['limit_meat'],
			'limit_animal' => $post['limit_animal'],
			'limit_seafood' => $post['limit_seafood'],
			'limit_additives' => $post['limit_additives']
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
			if ($search_field == 'user_fname') {
				$search_method_value = "LIKE '%$value%'";
			}
			if ($search_field == 'user_lname') {
				$search_method_value = "LIKE '%$value%'";
			}
			if ($search_field == 'mobile_no') {
				$search_method_value = "LIKE '%$value%'";
			}
			if ($search_field == 'fag_allow') {
				$search_method_value = "LIKE '%$value%'";
			}
			if ($search_field == 'org_id') {
				$search_method_field = "organizations_4.org_name";
				$search_method_value = "LIKE '%$value%'";
			}
			if ($search_field == 'user_sex') {
				$search_method_value = "LIKE '%$value%'";
			}
			if ($search_field == 'user_level') {
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
			$this->db->join('organizations AS organizations_4', "$this->my_table.org_id = organizations_4.org_id", 'left');

			$this->set_where($where);
			$search_row = $this->count_record();
		}
		$offset = $start_row;
		$limit = $per_page;
		$this->set_order_by($order_by);
		$this->set_offset($offset);
		$this->set_limit($limit);
		$this->db->select("$this->my_table.*, users_1.user_fname AS userDeleteUserFname
				, users_2.user_fname AS userAddUserFname
				, users_3.user_fname AS userUpdateUserFname
				, organizations_4.org_name AS orgIdOrgName
				");
		$this->db->join('users AS users_1', "$this->my_table.user_delete = users_1.user_id", 'left');
		$this->db->join('users AS users_2', "$this->my_table.user_add = users_2.user_id", 'left');
		$this->db->join('users AS users_3', "$this->my_table.user_update = users_3.user_id", 'left');
		$this->db->join('organizations AS organizations_4', "$this->my_table.org_id = organizations_4.org_id", 'left');

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
			'title_name' => $post['title_name'], 'user_fname' => $post['user_fname'], 'user_lname' => $post['user_lname'], 'date_of_birth' => setDateToStandard($post['date_of_birth']), 'mobile_no' => $post['mobile_no'], 'email_addr' => $post['email_addr']
			//,'cus_passwd' => pass_secure_hash($post['cus_passwd'])
			, 'cus_passwd' => $post['cus_passwd'], 'addr' => $post['addr']
			,'user_status' => $post['user_status'],'user_level' => $post['user_level']
			//,'fag_allow' => @$post['fag_allow']
			, 'org_id' => @$post['org_id'], 'user_sex' => $post['user_sex'], 'user_height' => str_replace(",", "", $post['user_height']), 'goal_reduce_weight' => str_replace(",", "", $post['goal_reduce_weight']), 'reduce_date_start' => setDateToStandard($post['reduce_date_start']), 'reduce_date_end' => setDateToStandard($post['reduce_date_end']), 'goal_increase_weight' => str_replace(",", "", $post['goal_increase_weight']), 'increase_date_start' => setDateToStandard($post['increase_date_start']), 'increase_date_end' => setDateToStandard($post['increase_date_end']), 'user_level' => @$post['user_level'], 'user_status' => @$post['user_status']
			//,'food_intol_exam' => $post['food_intol_exam']
			, 'limit_allmeat' => $post['limit_allmeat'], 'limit_pig' => $post['limit_pig'], 'limit_meat' => $post['limit_meat'], 'limit_animal' => $post['limit_animal'], 'limit_seafood' => $post['limit_seafood'], 'limit_additives' => $post['limit_additives']
		);

		if (isset($post['user_photo'])) {
			$data['user_photo'] = $post['user_photo'];
		}

		$user_id = checkEncryptData($post['encrypt_user_id']);
		$this->set_where("$this->my_table.user_id = $user_id");
		return $this->update_record($data);
	}


	public function delete($post)
	{
		$user_id = checkEncryptData($post['encrypt_user_id']);
		$this->set_where("$this->my_table.user_id = $user_id");
		return $this->delete_record();
	}
}
/*---------------------------- END Model Class --------------------------------*/
