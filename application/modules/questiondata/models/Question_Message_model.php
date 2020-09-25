<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Question_Message_model Class
 * @date 2019-12-05
 */
class Question_Message_model extends MY_Model
{

	private $my_table;
	public $session_name;
	public $order_field;
	public $order_sort;
	public $owner_record;

	public function __construct()
	{
		parent::__construct();
		$this->my_table = 'question_message';
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
		$this->db->join('users', "$this->my_table.user_message = users.user_id", 'left');

		return $this->load_record();
	}


	/**
	 * List all data
	 * @param $start_row	Number offset record start
	 * @param $per_page	Number limit record perpage
	 */

	public function read($id)
	{
				$this->set_where("$this->my_table.question_id = $id");
				$this->db->join('users', "$this->my_table.user_message = users.user_id", 'left');

				$list_record = $this->list_record();

				$data = array(
					'list_data'	=> $list_record
				);

				return $data;
	}


	public function create($post)
	{
		$data = array(
			'message_question' => $post['message_question'], 'question_id' => $post['question_id'],'user_message' => $this->session->userdata('user_id'), 'fag_allow' => 'allow'
		);
		return $this->add_record($data);
	}

}
/*---------------------------- END Model Class --------------------------------*/
