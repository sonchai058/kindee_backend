<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Register_model Class
 * @date 2019-12-05
 */
class Register_model extends MY_Model
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
			'user_level' => 'user'
		);
		return $this->add_record($data);
	}
}
/*---------------------------- END Model Class --------------------------------*/
