<?php
ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Question.php ]
 */
class Question extends CRUD_Controller
{

	private $per_page;
	private $another_js;
	private $another_css;

	public function __construct()
	{
		parent::__construct();

		chkUserPerm();

		$this->per_page = 30;
		$this->num_links = 6;
		$this->uri_segment = 4;
		$this->load->model('questiondata/Question_model', 'Question');
		$this->load->model('questiondata/Question_Message_model', 'Question_Message');

		$this->data['page_url'] = site_url('questiondata/question');

		$this->data['page_title'] = 'ปรึกษานักโภชนการ';


		$this->upload_store_path = './assets/uploads/question/';
		/*
		$this->file_allow = array(
						'application/pdf' => 'pdf',
						'application/msword' => 'doc',
						'application/vnd.ms-msword' => 'doc',
						'application/vnd.ms-excel' => 'xls',
						'application/powerpoint' => 'ppt',
						'application/vnd.ms-powerpoint' => 'ppt',
						'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
						'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
						'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
						'application/vnd.oasis.opendocument.text' => 'odt',
						'application/vnd.oasis.opendocument.spreadsheet' => 'ods',
						'application/vnd.oasis.opendocument.presentation' => 'odp',
						'image/bmp' => 'bmp',
						'image/png' => 'png',
						'image/pjpeg' => 'jpeg',
						'image/jpeg' => 'jpg'
		);
		$this->file_allow_type = array_values($this->file_allow);
		$this->file_allow_mime = array_keys($this->file_allow);
		$this->file_check_name = '';
		*/

		$js_url = 'assets/js_modules/questiondata/question.js?ft=' . filemtime('assets/js_modules/questiondata/question.js');
		$this->another_js = '<script src="' . base_url($js_url) . '"></script>';
	}

	// ------------------------------------------------------------------------

	/**
	 * Index of controller
	 */
	public function index()
	{
		$this->list_all();
	}

	// ------------------------------------------------------------------------

	/**
	 * Render this controller page
	 * @param String path of controller
	 * @param Integer total record
	 */
	protected function render_view($path)
	{
		$this->data['top_navbar'] = $this->parser->parse('template/majestic/top_navbar_view', $this->top_navbar_data, TRUE);
		$this->data['left_sidebar'] = $this->parser->parse('template/majestic/left_sidebar_view', $this->left_sidebar_data, TRUE);
		$this->data['breadcrumb_list'] = $this->parser->parse('template/majestic/breadcrumb_view', $this->breadcrumb_data, TRUE);
		$this->data['page_content'] = $this->parser->parse_repeat($path, $this->data, TRUE);
		$this->data['another_css'] = $this->another_css;
		$this->data['another_js'] = $this->another_js;
		$this->parser->parse('template/majestic/homepage_view', $this->data);
	}

	/**
	 * Set up pagination config
	 * @param String path of controller
	 * @param Integer total record
	 */
	public function create_pagination($page_url, $total)
	{
		$this->load->library('pagination');
		$config['base_url'] = $page_url;
		$config['total_rows'] = $total;
		$config['per_page'] = $this->per_page;
		$config['num_links'] = $this->num_links;
		$config['uri_segment'] = $this->uri_segment;
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}

	// ------------------------------------------------------------------------

	/**
	 * List all record
	 */
	public function list_all()
	{
		$this->session->unset_userdata($this->Question->session_name . '_search_field');
		$this->session->unset_userdata($this->Question->session_name . '_value');

		$this->search();
	}

	// ------------------------------------------------------------------------

	/**
	 * Search data
	 */
	public function search()
	{
		$this->load->model("common_model");

		$this->breadcrumb_data['breadcrumb'] = array(
			array('title' => 'ปรึกษานักโภชนการ', 'class' => 'active', 'url' => '#'),
		);
		if (isset($_POST['submit'])) {
			$search_field =  $this->input->post('search_field', TRUE);
			$value = $this->input->post('txtSearch', TRUE);
			$arr = array($this->Question->session_name . '_search_field' => $search_field, $this->Question->session_name . '_value' => $value);
			$this->session->set_userdata($arr);
		} else {
			$search_field = $this->session->userdata($this->Question->session_name . '_search_field');
			$value = $this->session->userdata($this->Question->session_name . '_value');
		}

		$start_row = $this->uri->segment($this->uri_segment, '0');
		if (!is_numeric($start_row)) {
			$start_row = 0;
		}
		$per_page = $this->per_page;
		$order_by =  $this->input->post('order_by', TRUE);
		if ($order_by != '') {
			$arr = explode('|', $order_by);
			$field = $arr[0];
			$sort = $arr[1];
			switch ($sort) {
				case 'asc':
					$sort = 'ASC';
					break;
				case 'desc':
					$sort = 'DESC';
					break;
			}
			$this->Question->order_field = $field;
			$this->Question->order_sort = $sort;
		}
		$results = $this->Question->read($start_row, $per_page);
		$total_row = $results['total_row'];
		$search_row = $results['search_row'];
		$list_data = $this->setDataListFormat($results['list_data'], $start_row);


		$page_url = site_url('questiondata/question');
		$pagination = $this->create_pagination($page_url . '/search', $search_row);
		$end_row = $start_row + $per_page;
		if ($search_row < $per_page) {
			$end_row = $search_row;
		}

		if ($end_row > $search_row) {
			$end_row = $search_row;
		}

		$data = array();
		foreach ($list_data as $key => $v) {
			$data[$key] = array();
			foreach ($v as $column => $value_status) {
				$data[$key][$column] = $value_status;
			}
			$data[$key]['status'] =  ($data[$key]['preview_question_status'] == 'ตอบแล้ว') ? 'disabled' : '';
			$data[$key]['status_message'] =  ($data[$key]['preview_question_status'] == 'ตอบแล้ว') ? '' : 'disabled';

		}
				// echo '<pre>';
				// print_r($data);
				// echo '</pre>';
				// die();
		$this->data['data_list']	= $data;

		$this->data['search_field']	= $search_field;
		$this->data['txt_search']	= $value;
		$this->data['current_page_offset'] = $start_row;
		$this->data['start_row']	= $start_row + 1;
		$this->data['end_row']	= $end_row;
		$this->data['order_by']	= $order_by;
		$this->data['total_row']	= $total_row;
		$this->data['search_row']	= $search_row;
		$this->data['page_url']	= $page_url;
		$this->data['pagination_link']	= $pagination;
		$this->data['csrf_protection_field']	= insert_csrf_field(true);
		// print_r($this->db->last_query());
		// die();
		$this->render_view('questiondata/question/list_view');
	}

	// ------------------------------------------------------------------------

	/**
	 * Preview Data
	 * @param String encrypt id
	 */
	public function preview($encrypt_id = "")
	{
		$this->breadcrumb_data['breadcrumb'] = array(
			array('title' => 'ปรึกษานักโภชนการ', 'url' => site_url('questiondata/question')),
			array('title' => 'แสดงข้อมูลรายละเอียด', 'url' => '#', 'class' => 'active')
		);
		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแสดงข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Question->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->setPreviewFormat($results);
				$this->render_view('questiondata/question/preview_view');
			}
		}
	}


	// ------------------------------------------------------------------------
	/**
	 * Add form
	 */
	public function add()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
			array('title' => 'ปรึกษานักโภชนการ', 'url' => site_url('questiondata/question')),
			array('title' => 'เพิ่มข้อมูล', 'url' => '#', 'class' => 'active')
		);
		// $this->data['count_image'] = 1;
		$this->data['data_id'] = 0;
		$this->data['users_user_delete_option_list'] = $this->Question->returnOptionList("users", "user_id", "user_fname");
		$this->data['users_user_add_option_list'] = $this->Question->returnOptionList("users", "user_id", "user_fname");
		$this->data['users_user_update_option_list'] = $this->Question->returnOptionList("users", "user_id", "user_fname");
		$this->render_view('questiondata/question/add_view');
	}

	public function message($encrypt_id = '')
	{
		$this->breadcrumb_data['breadcrumb'] = array(
			array('title' => 'ปรึกษานักโภชนการ', 'url' => site_url('questiondata/question')),
			array('title' => 'สนทนา', 'url' => '#', 'class' => 'active')
		);

		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแก้ไขข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Question->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->data['csrf_field'] = insert_csrf_field(true);
				$results_Message = $this->Question_Message->read($id);
				$list_data = $this->setDataListFormat($results_Message['list_data']);
				$data = array();
				foreach ($list_data as $key => $v) {
					$data[$key] = array();
					foreach ($v as $column => $value_status) {
						$data[$key][$column] = $value_status;
					}
					$data[$key]['message'] =  ($data[$key]['user_message'] == $this->session->userdata('user_id')) ? 'right' : 'left';
					$data[$key]['message_color'] =  ($data[$key]['message'] == 'right') ? '#94C2ED' : '#86BB71';

				}
				$list_data = $data;
				// echo '<pre>';
				// print_r($list_data);
				// echo '</pre>';
				// die();
				$this->data['data_list']	= $list_data;
				$this->setPreviewFormat($results);

				$this->data['data_id'] = $id;
				$this->data['users_user_delete_option_list'] = $this->Question->returnOptionList("users", "user_id", "user_fname");
				$this->data['users_user_add_option_list'] = $this->Question->returnOptionList("users", "user_id", "user_fname");
				$this->data['users_user_update_option_list'] = $this->Question->returnOptionList("users", "user_id", "user_fname");
				$this->render_view('questiondata/question/message');
			}
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * Default Validation
	 * see also https://www.codeigniter.com/userguide3/libraries/form_validation.html
	 */
	public function formValidate()
	{
		$this->load->library('form_validation');
		$frm = $this->form_validation;

		$frm->set_rules('date_public', 'วันที่ประกาศ', 'trim|required');
		$frm->set_rules('question_name', 'หัวข้อ', 'trim|required');
		$frm->set_rules('question_detail', 'รายละเอียด', 'trim|required');
		$frm->set_rules('fag_allow', 'สถานะ', 'trim');

		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('date_public');
			$message .= form_error('question_name');
			$message .= form_error('question_detail');
			$message .= form_error('fag_allow');
			return $message;
		}
	}

	public function formValidateMessage()
	{
		$this->load->library('form_validation');
		$frm = $this->form_validation;

		$frm->set_rules('message_question', 'ข้อความ', 'trim|required');
		$frm->set_rules('fag_allow', 'สถานะ', 'trim');

		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('message_question');
			$message .= form_error('fag_allow');
			return $message;
		}
	}
	// ------------------------------------------------------------------------

	/**
	 * Default Validation for Update
	 * see also https://www.codeigniter.com/userguide3/libraries/form_validation.html
	 */
	public function formValidateUpdate()
	{
		$this->load->library('form_validation');
		$frm = $this->form_validation;

		$frm->set_rules('date_public', 'วันที่ประกาศ', 'trim|required');
		$frm->set_rules('question_name', 'หัวข้อ', 'trim|required');
		$frm->set_rules('question_detail', 'รายละเอียด', 'trim|required');
		$frm->set_rules('fag_allow', 'สถานะ', 'trim');

		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('date_public');
			$message .= form_error('question_name');
			$message .= form_error('question_detail');
			$message .= form_error('fag_allow');
			return $message;
		}
	}

	// ------------------------------------------------------------------------

	public function formValidateUpdate_Answer()
	{
		$this->load->library('form_validation');
		$frm = $this->form_validation;

		$frm->set_rules('answer_question', 'ปรึกษานักโภชนการ', 'trim|required');

		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('answer_question');
			return $message;
		}
	}

	public function formValidateUpdate_Message()
	{
		$this->load->library('form_validation');
		$frm = $this->form_validation;

		$frm->set_rules('message_question', 'ปรึกษานักโภชนการ', 'trim|required');

		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('message_question');
			return $message;
		}
	}
	// ------------------------------------------------------------------------

	/**
	 * Create new record
	 */
	public function save()
	{

		$message = '';
		$message .= $this->formValidate();
		if ($message != '') {
			$json = json_encode(array(
				'is_successful' => FALSE,
				'message' => $message
			));
			echo $json;
		} else {

			$post = $this->input->post(NULL, TRUE);

			$encrypt_id = '';
			$id = $this->Question->create($post);
			if ($id != '') {
				$success = TRUE;
				$encrypt_id = encrypt($id);
				$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>';
			} else {
				$success = FALSE;
				$message = 'Error : ' . $this->Question->error_message;
			}

			$json = json_encode(array(
				'is_successful' => $success,
				'encrypt_id' =>  $encrypt_id,
				'message' => $message,
				'id' => $id
			));
			echo $json;
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * Load data to form
	 * @param String encrypt id
	 */
	public function edit($encrypt_id = '')
	{
		$this->breadcrumb_data['breadcrumb'] = array(
			array('title' => 'ปรึกษานักโภชนการ', 'url' => site_url('questiondata/question')),
			array('title' => 'แก้ไขข้อมูล', 'url' => '#', 'class' => 'active')
		);

		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแก้ไขข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Question->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->data['csrf_field'] = insert_csrf_field(true);


				$this->setPreviewFormat($results);

				$this->data['data_id'] = $id;
				$this->data['users_user_delete_option_list'] = $this->Question->returnOptionList("users", "user_id", "user_fname");
				$this->data['users_user_add_option_list'] = $this->Question->returnOptionList("users", "user_id", "user_fname");
				$this->data['users_user_update_option_list'] = $this->Question->returnOptionList("users", "user_id", "user_fname");


				$this->render_view('questiondata/question/edit_view');
			}
		}
	}

	// ------------------------------------------------------------------------

	public function answer($encrypt_id = '')
	{
		$this->breadcrumb_data['breadcrumb'] = array(
			array('title' => 'ปรึกษานักโภชนการ', 'url' => site_url('questiondata/question')),
			array('title' => 'ปรึกษานักโภชนการ', 'url' => '#', 'class' => 'active')
		);

		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแก้ไขข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Question->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->data['csrf_field'] = insert_csrf_field(true);


				$this->setPreviewFormat($results);

				$this->data['data_id'] = $id;
				$this->data['users_user_delete_option_list'] = $this->Question->returnOptionList("users", "user_id", "user_fname");
				$this->data['users_user_add_option_list'] = $this->Question->returnOptionList("users", "user_id", "user_fname");
				$this->data['users_user_update_option_list'] = $this->Question->returnOptionList("users", "user_id", "user_fname");


				$this->render_view('questiondata/question/answer_view');
			}
		}
	}

	// ------------------------------------------------------------------------
	public function checkRecordKey($data)
	{
		$error = '';
		$question_id = ci_decrypt($data['encrypt_question_id']);
		if ($question_id == '') {
			$error .= '- รหัส question_id';
		}
		return $error;
	}

	/**
	 * Update Record
	 */

	/*
	public function __destruct() {
		$this->db->query('UNLOCK TABLES');
		$this->db->close();
	}
	*/

	public function update()
	{
		$message = '';
		$message .= $this->formValidateUpdate();
		//$edit_remark = $this->input->post('edit_remark', TRUE);
		//if ($edit_remark == '') {
		//	$message .= 'ระบุเหตุผล';
		//}

		$post = $this->input->post(NULL, TRUE);
		$error_pk_id = $this->checkRecordKey($post);
		if ($error_pk_id != '') {
			$message .= "รหัสอ้างอิงที่ใช้สำหรับอัพเดตข้อมูลไม่ถูกต้อง";
		}
		if ($message != '') {
			$json = json_encode(array(
				'is_successful' => FALSE,
				'message' => $message
			));
			echo $json;
		} else {

			$result = $this->Question->update($post);
			if ($result == false) {
				$message = $this->Question->error_message;
				$ok = FALSE;
			} else {
				$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>' . $this->Question->error_message;
				$ok = TRUE;
			}
			$json = json_encode(array(
				'is_successful' => $ok,
				'message' => $message
			));

			echo $json;
		}
	}


	public function update_answer()
	{
		$message = '';
		$message .= $this->formValidateUpdate_Answer();

		$post = $this->input->post(NULL, TRUE);
		$error_pk_id = $this->checkRecordKey($post);
		if ($error_pk_id != '') {
			$message .= "รหัสอ้างอิงที่ใช้สำหรับอัพเดตข้อมูลไม่ถูกต้อง";
		}
		if ($message != '') {
			$json = json_encode(array(
				'is_successful' => FALSE,
				'message' => $message
			));
			echo $json;
		} else {

			$result = $this->Question->update_answer($post);
			if ($result == false) {
				$message = $this->Question->error_message;
				$ok = FALSE;
			} else {
				$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>' . $this->Question->error_message;
				$ok = TRUE;
			}
			$json = json_encode(array(
				'is_successful' => $ok,
				'message' => $message
			));

			echo $json;
		}
	}

	public function save_message()
	{

		$message = '';
		$message .= $this->formValidateMessage();
		if ($message != '') {
			$json = json_encode(array(
				'is_successful' => FALSE,
				'message' => $message
			));
			echo $json;
		} else {

			$post = $this->input->post(NULL, TRUE);

			$encrypt_id = '';
			$id = $this->Question_Message->create($post);
			if ($id != '') {
				$success = TRUE;
				$encrypt_id = encrypt($id);
				$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>';
			} else {
				$success = FALSE;
				$message = 'Error : ' . $this->Question->error_message;
			}

			$json = json_encode(array(
				'is_successful' => $success,
				'encrypt_id' =>  $encrypt_id,
				'message' => $message,
				'id' => $id
			));
			echo $json;
		}
	}

	/**
	 * Delete Record
	 */
	public function del()
	{
		/*
		$delete_remark = $this->input->post('delete_remark', TRUE);
			$message = '';
		if ($delete_remark == '') {
			$message .= 'ระบุเหตุผล';
		}
		*/
		$message = '';
		$post = $this->input->post(NULL, TRUE);
		$error_pk_id = $this->checkRecordKey($post);
		if ($error_pk_id != '') {
			$message .= "รหัสอ้างอิงที่ใช้สำหรับลบข้อมูลไม่ถูกต้อง";
		}
		if ($message != '') {
			$json = json_encode(array(
				'is_successful' => FALSE,
				'message' => $message
			));
			echo $json;
		} else {
			$result = $this->Question->delete($post);
			if ($result == false) {
				$message = $this->Question->error_message;
				$ok = FALSE;
			} else {
				$message = '<strong>ลบข้อมูลเรียบร้อย</strong>';
				$ok = TRUE;

				// $this->load->model('common_model');
				// $this->common_model->update("question_images",
				// 	array('user_delete'=>get_session('user_id'),'datetime_delete'=>date("Y-m-d H:i:s"),'fag_allow'=>'delete'),
				// 	array('question_id'=>checkEncryptData($post['encrypt_question_id'])));
				// $rows = $this->common_model->custom_query("select * from question_images where question_id=".checkEncryptData($post['encrypt_question_id']));

				// foreach ($rows as $key => $value) {
				// 	//$year = (substr($value['datetime_add'],0,4)+543);
				// 	$this->removeFile($value['encrypt_name']);
				// }
			}
			$json = json_encode(array(
				'is_successful' => $ok,
				'message' => $message
			));
			echo $json;
		}
	}


	/**
	 * SET array data list
	 */
	private function setDataListFormat($lists_data, $start_row = 0)
	{
		$data = $lists_data;
		$count = count($lists_data);
		for ($i = 0; $i < $count; $i++) {
			$start_row++;
			$data[$i]['record_number'] = $start_row;
			$pk1 = $data[$i]['question_id'];
			$data[$i]['url_encrypt_id'] = urlencode(encrypt($pk1));

			if ($pk1 != '') {
				$pk1 = encrypt($pk1);
			}
			$data[$i]['encrypt_question_id'] = $pk1;
			$data[$i]['preview_fag_allow'] = $this->setFagAllowSubject($data[$i]['fag_allow']);
			@$data[$i]['preview_question_status'] = $this->setFagAllowSubject($data[$i]['question_status']);
			@$data[$i]['date_public'] = setThaiDate($data[$i]['date_public']);
			@$data[$i]['datetime_delete'] = setThaiDate($data[$i]['datetime_delete']);
			$data[$i]['datetime_add'] = setThaiDate($data[$i]['datetime_add']);
			$data[$i]['datetime_update'] = setThaiDate($data[$i]['datetime_update']);
		}
		return $data;
	}

	/**
	 * SET choice subject
	 */
	private function setFagAllowSubject($value)
	{
		$subject = '';
		switch ($value) {
			case 'allow':
				$subject = 'เผยแพร่';
				break;
			case 'block':
				$subject = 'ไม่เผยแพร่';
				break;
			case 'delete':
				$subject = 'ลบ';
				break;
			case 'responded':
				$subject = 'ตอบแล้ว';
				break;
			case 'not_responded':
				$subject = 'ยังไม่ตอบ';
				break;
		}
		return $subject;
	}

	/**
	 * SET array data list
	 */
	private function setPreviewFormat($row_data)
	{
		$data = $row_data;

		$pk1 = $data['question_id'];
		$this->data['recode_url_encrypt_id'] = urlencode(encrypt($pk1));

		if ($pk1 != '') {
			$pk1 = encrypt($pk1);
		}
		$this->data['encrypt_question_id'] = $pk1;


		$userDeleteUserFname = $this->Question->getValueOf('users', 'user_fname', "user_id = '$data[user_delete]'");
		$this->data['userDeleteUserFname'] = $userDeleteUserFname;


		$userAddUserFname = $this->Question->getValueOf('users', 'user_fname', "user_id = '$data[user_add]'");
		$this->data['userAddUserFname'] = $userAddUserFname;


		$userUpdateUserFname = $this->Question->getValueOf('users', 'user_fname', "user_id = '$data[user_update]'");
		$this->data['userUpdateUserFname'] = $userUpdateUserFname;

		$this->data['record_question_id'] = $data['question_id'];
		$this->data['record_date_public'] = $data['date_public'];
		$this->data['record_question_name'] = $data['question_name'];
		$this->data['record_question_detail'] = $data['question_detail'];
		$this->data['record_answer_question'] = $data['answer_question'];

		$this->data['record_user_delete'] = $data['user_delete'];
		$this->data['record_datetime_delete'] = $data['datetime_delete'];
		$this->data['record_user_add'] = $data['user_add'];
		$this->data['record_datetime_add'] = $data['datetime_add'];
		$this->data['record_user_update'] = $data['user_update'];
		$this->data['record_datetime_update'] = $data['datetime_update'];
		$this->data['preview_question_status'] = $this->setFagAllowSubject($data['question_status']);
		$this->data['record_question_status'] = $data['question_status'];

		$this->data['preview_fag_allow'] = $this->setFagAllowSubject($data['fag_allow']);
		$this->data['record_fag_allow'] = $data['fag_allow'];


		$this->data['record_date_public'] = setThaiDate($data['date_public']);
		$this->data['record_datetime_delete'] = setThaiDate($data['datetime_delete']);
		$this->data['record_datetime_add'] = setThaiDate($data['datetime_add']);
		$this->data['record_datetime_update'] = setThaiDate($data['datetime_update']);
	}
}
/*---------------------------- END Controller Class --------------------------------*/
