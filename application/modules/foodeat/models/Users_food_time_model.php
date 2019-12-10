<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Users_food_time_model Class
 * @date 2019-12-06
 */
class Users_food_time_model extends MY_Model
{

	private $my_table;
	public $session_name;
	public $order_field;
	public $order_sort;
	public $owner_record;

	public function __construct()
	{
		parent::__construct();
		$this->my_table = 'users_food_time';
		$this->set_table_name($this->my_table);
		$this->order_field = '';
		$this->order_sort = '';
	}


	public function exists($data)
	{
		$foodt_id = checkEncryptData($data['foodt_id']);
		$this->set_where("$this->my_table.foodt_id = $foodt_id");
		return $this->count_record();
	}


	public function load($id)
	{
		$this->set_where("$this->my_table.foodt_id = $id");
		return $this->load_record();
	}


	public function create($post)
	{

		$data = array(
				'user_id' => $post['user_id']
				,'food_source' => $post['food_source']
				,'eat_time' => $post['eat_time']
				,'date_eat' => setDateToStandard($post['date_eat'])
				,'food_id' => $post['food_id']
				,'food_energy' => str_replace(",", "", $post['food_energy'])
				,'fag_allow' => $post['fag_allow']
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
		$order_by	= '';
		if($this->order_field != ''){
			$order_field = $this->order_field;
			$order_sort = $this->order_sort;
			$order_by	= " $this->my_table.$order_field $order_sort";
		}
		
		if($search_field != '' && $value != ''){
			$search_method_field = "$this->my_table.$search_field";
			$search_method_value = '';
			if($search_field == 'user_id'){
				$search_method_field = "users_1.user_fname";
				$search_method_value = "LIKE '%$value%'";				
			}
			if($search_field == 'food_source'){
				$search_method_value = "LIKE '%$value%'";				
			}
			if($search_field == 'eat_time'){
				$search_method_value = "LIKE '%$value%'";				
			}
			if($search_field == 'food_id'){
				$search_method_field = "CONCAT_WS(' ', self_food_menu_2.self_food_name, self_food_menu_2.energy_amt)";
				$search_method_value = "LIKE '%$value%'";				
			}
			if($search_field == 'datetime_update'){
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
			$this->db->join('users AS users_1', "$this->my_table.user_id = users_1.user_id", 'left');
		$this->db->join('self_food_menu AS self_food_menu_2', "$this->my_table.food_id = self_food_menu_2.self_food_id", 'left');

			$this->set_where($where);
			$search_row = $this->count_record();
		}
		$offset = $start_row;
		$limit = $per_page;
		$this->set_order_by($order_by);
		$this->set_offset($offset);
		$this->set_limit($limit);
		$this->db->select("$this->my_table.*, users_1.user_fname AS userIdUserFname
				, self_food_menu_2.self_food_name AS foodIdSelfFoodName, self_food_menu_2.energy_amt AS foodIdEnergyAmt
				");
		$this->db->join('users AS users_1', "$this->my_table.user_id = users_1.user_id", 'left');
		$this->db->join('self_food_menu AS self_food_menu_2', "$this->my_table.food_id = self_food_menu_2.self_food_id", 'left');

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
				'user_id' => $post['user_id']
				,'food_source' => $post['food_source']
				,'eat_time' => $post['eat_time']
				,'date_eat' => setDateToStandard($post['date_eat'])
				,'food_id' => $post['food_id']
				,'food_energy' => str_replace(",", "",$post['food_energy'])
				,'fag_allow' => $post['fag_allow']
		);

		$foodt_id = checkEncryptData($post['encrypt_foodt_id']);
		$this->set_where("$this->my_table.foodt_id = $foodt_id");
		return $this->update_record($data);
	}


	public function delete($post)
	{
		$foodt_id = checkEncryptData($post['encrypt_foodt_id']);
		$this->set_where("$this->my_table.foodt_id = $foodt_id");
		return $this->delete_record();
	}


}
/*---------------------------- END Model Class --------------------------------*/