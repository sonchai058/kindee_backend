<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Frontend_get_news_model Class
 * @date 2019-12-05
 */
class Frontend_get_news_model extends MY_Model
{

	private $my_table;
	public $session_name;
	public $order_field;
	public $order_sort;
	public $owner_record;

	public function __construct()
	{
		parent::__construct();
		$this->my_table = 'blog';
		$this->set_table_name($this->my_table);
		$this->order_field = '';
		$this->order_sort = '';
	}

	public function read($start_row)
	{
		$order_by	= 'date_public DESC';
		$offset = $start_row;

		$this->set_order_by($order_by);
		$this->set_offset($offset);
		$this->set_limit(4);
		$this->db->select("$this->my_table.*
				, encrypt_name
				, users_1.user_fname AS userDeleteUserFname
				, users_2.user_fname AS userAddUserFname
				, users_3.user_fname AS userUpdateUserFname
				");

		$this->db->join('blog_images', "$this->my_table.blog_id = blog_images.blog_id", 'left');
		$this->db->join('users AS users_1', "$this->my_table.user_delete = users_1.user_id", 'left');
		$this->db->join('users AS users_2', "$this->my_table.user_add = users_2.user_id", 'left');
		$this->db->join('users AS users_3', "$this->my_table.user_update = users_3.user_id", 'left');
		$list_record = $this->list_record();
		$data = array(
			'list_data'	=> $list_record
		);
		return $data;
	}
}
/*---------------------------- END Model Class --------------------------------*/
