<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Users_result_exam_food_allergy.php ]
 */
class Users_result_exam_food_allergy extends CRUD_Controller
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
		$this->load->model('exam/Users_result_exam_food_allergy_model', 'Users_result_exam_food_allergy');
		$this->data['page_url'] = site_url('exam/users_result_exam_food_allergy');

		$this->data['page_title'] = 'ผลตรวจการแพ้อาหาร';
		$js_url = 'assets/js_modules/exam/users_result_exam_food_allergy.js?ft=' . filemtime('assets/js_modules/exam/users_result_exam_food_allergy.js');
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
		$this->session->unset_userdata($this->Users_result_exam_food_allergy->session_name . '_search_field');
		$this->session->unset_userdata($this->Users_result_exam_food_allergy->session_name . '_value');

		$this->search();
	}

	// ------------------------------------------------------------------------

	/**
	 * Search data
	 */
	public function search()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
			array('title' => 'ผลตรวจการแพ้อาหาร', 'class' => 'majestic', 'url' => '#'),
		);
		if (isset($_POST['submit'])) {
			$search_field =  $this->input->post('search_field', TRUE);
			$value = $this->input->post('txtSearch', TRUE);
			$arr = array($this->Users_result_exam_food_allergy->session_name . '_search_field' => $search_field, $this->Users_result_exam_food_allergy->session_name . '_value' => $value);
			$this->session->set_userdata($arr);
		} else {
			$search_field = $this->session->userdata($this->Users_result_exam_food_allergy->session_name . '_search_field');
			$value = $this->session->userdata($this->Users_result_exam_food_allergy->session_name . '_value');
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
			$this->Users_result_exam_food_allergy->order_field = $field;
			$this->Users_result_exam_food_allergy->order_sort = $sort;
		}
		$results = $this->Users_result_exam_food_allergy->read($start_row, $per_page);
		$total_row = $results['total_row'];
		$search_row = $results['search_row'];
		$list_data = $this->setDataListFormat($results['list_data'], $start_row);


		$page_url = site_url('exam/users_result_exam_food_allergy');
		$pagination = $this->create_pagination($page_url . '/search', $search_row);
		$end_row = $start_row + $per_page;
		if ($search_row < $per_page) {
			$end_row = $search_row;
		}

		if ($end_row > $search_row) {
			$end_row = $search_row;
		}
		// echo '<pre>';
		// print_r($list_data);
		// echo '</pre>';
		// die();

		$this->data['data_list']	= $list_data;
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

		$this->render_view('exam/users_result_exam_food_allergy/list_view');
	}

	// ------------------------------------------------------------------------

	/**
	 * Preview Data
	 * @param String encrypt id
	 */
	public function preview($encrypt_id = "")
	{
		$this->breadcrumb_data['breadcrumb'] = array(
			array('title' => 'ผลตรวจการแพ้อาหาร', 'url' => site_url('exam/users_result_exam_food_allergy')),
			array('title' => 'แสดงข้อมูลรายละเอียด', 'url' => '#', 'class' => 'majestic')
		);
		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแสดงข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Users_result_exam_food_allergy->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->setPreviewFormat($results);
				$this->render_view('exam/users_result_exam_food_allergy/preview_view');
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
			array('title' => 'ผลตรวจการแพ้อาหาร', 'url' => site_url('exam/users_result_exam_food_allergy')),
			array('title' => 'เพิ่มข้อมูล', 'url' => '#', 'class' => 'majestic')
		);
		$this->data['users_user_id_option_list'] = $this->Users_result_exam_food_allergy->returnOptionList("users", "user_id", "user_fname");
		$this->data['food_allergy_alg_id_option_list'] = $this->Users_result_exam_food_allergy->returnOptionList("food_allergy", "alg_id", "alg_name");
		$this->data['users_user_delete_option_list'] = $this->Users_result_exam_food_allergy->returnOptionList("users", "user_id", "user_fname");
		$this->data['users_user_add_option_list'] = $this->Users_result_exam_food_allergy->returnOptionList("users", "user_id", "user_fname");
		$this->data['users_user_update_option_list'] = $this->Users_result_exam_food_allergy->returnOptionList("users", "user_id", "user_fname");
		$this->render_view('exam/users_result_exam_food_allergy/add_view');
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

		$frm->set_rules('user_id', 'รหัสสมาชิก', 'trim');
		$frm->set_rules('alg_id', 'รหัสอาหารที่แพ้', 'trim|required|is_natural');
		$frm->set_rules('fag_allow', 'สถานะ', 'trim');
		$frm->set_rules('food_type', 'ประเภท', 'trim');
		$frm->set_rules('food_alg_val', 'ค่า', 'trim|required');

		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');
		$frm->set_message('decimal', '- %s ต้องระบุตัวเลขทศนิยม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('user_id');
			$message .= form_error('alg_id');
			$message .= form_error('fag_allow');
			$message .= form_error('food_type');
			$message .= form_error('food_alg_val');
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

		$frm->set_rules('user_id', 'รหัสสมาชิก', 'trim');
		$frm->set_rules('alg_id', 'รหัสอาหารที่แพ้', 'trim|required|is_natural');
		$frm->set_rules('fag_allow', 'สถานะ', 'trim');
		$frm->set_rules('food_type', 'ประเภท', 'trim');
		$frm->set_rules('food_alg_val', 'ค่า', 'trim|required');

		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');
		$frm->set_message('decimal', '- %s ต้องระบุตัวเลขทศนิยม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('user_id');
			$message .= form_error('alg_id');
			$message .= form_error('fag_allow');
			$message .= form_error('food_type');
			$message .= form_error('food_alg_val');
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
			$post['user_id'] = $this->session->userdata("user_id");
			$id = $this->Users_result_exam_food_allergy->create($post);
			if ($id != '') {
				$success = TRUE;
				$encrypt_id = encrypt($id);
				$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>';
			} else {
				$success = FALSE;
				$message = 'Error : ' . $this->Users_result_exam_food_allergy->error_message;
			}

			$json = json_encode(array(
				'is_successful' => $success,
				'encrypt_id' =>  $encrypt_id,
				'message' => $message
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
			array('title' => 'ผลตรวจการแพ้อาหาร', 'url' => site_url('exam/users_result_exam_food_allergy')),
			array('title' => 'แก้ไขข้อมูล', 'url' => '#', 'class' => 'majestic')
		);

		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแก้ไขข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Users_result_exam_food_allergy->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->data['csrf_field'] = insert_csrf_field(true);


				$this->setPreviewFormat($results);
				$this->data['users_user_id_option_list'] = $this->Users_result_exam_food_allergy->returnOptionList("users", "user_id", "user_fname");
				$this->data['food_allergy_alg_id_option_list'] = $this->Users_result_exam_food_allergy->returnOptionList("food_allergy", "alg_id", "alg_name");
				$this->data['users_user_delete_option_list'] = $this->Users_result_exam_food_allergy->returnOptionList("users", "user_id", "user_fname");
				$this->data['users_user_add_option_list'] = $this->Users_result_exam_food_allergy->returnOptionList("users", "user_id", "user_fname");
				$this->data['users_user_update_option_list'] = $this->Users_result_exam_food_allergy->returnOptionList("users", "user_id", "user_fname");
				$this->render_view('exam/users_result_exam_food_allergy/edit_view');
			}
		}
	}

	// ------------------------------------------------------------------------
	public function checkRecordKey($data)
	{
		$error = '';
		$exam_id = ci_decrypt($data['encrypt_exam_id']);
		if ($exam_id == '') {
			$error .= '- รหัส exam_id';
		}
		return $error;
	}

	/**
	 * Update Record
	 */
	public function update()
	{
		$message = '';
		$message .= $this->formValidateUpdate();

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
			// unset($post['user_id']);
			$post['user_id'] = $this->session->userdata("user_id");
			$result = $this->Users_result_exam_food_allergy->update($post);
			if($result == false){
				$message = $this->Users_result_exam_food_allergy->error_message;
				$ok = FALSE;
			}else{
				$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>' . $this->Users_result_exam_food_allergy->error_message;
				$ok = TRUE;
			}
			$json = json_encode(array(
				'is_successful' => $ok,
				'message' => $message
			));

			echo $json;
		}
	}

	/**
	 * Delete Record
	 */
	public function del()
	{
		//$delete_remark = $this->input->post('delete_remark', TRUE);
		$message = '';
		/*
		if ($delete_remark == '') {
			$message .= 'ระบุเหตุผล';
		}
		*/

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
			$result = $this->Users_result_exam_food_allergy->delete($post);
			if ($result == false) {
				$message = $this->Users_result_exam_food_allergy->error_message;
				$ok = FALSE;
			} else {
				$message = '<strong>ลบข้อมูลเรียบร้อย</strong>';
				$ok = TRUE;
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
			$pk1 = $data[$i]['exam_id'];
			$data[$i]['url_encrypt_id'] = urlencode(encrypt($pk1));

			if ($pk1 != '') {
				$pk1 = encrypt($pk1);
			}
			$data[$i]['encrypt_exam_id'] = $pk1;
			$data[$i]['preview_fag_allow'] = $this->setFagAllowSubject($data[$i]['fag_allow']);
			$data[$i]['preview_food_type'] = $this->setFagAllowSubject($data[$i]['food_type']);

			$data[$i]['datetime_delete'] = setThaiDate($data[$i]['datetime_delete']);
			$data[$i]['datetime_add'] = setThaiDate($data[$i]['datetime_add']);
			$data[$i]['datetime_update'] = setThaiDate($data[$i]['datetime_update']);
			$data[$i]['food_alg_val'] = number_format($data[$i]['food_alg_val'], 2);
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
				$subject = 'ปกติ';
				break;
			case 'block':
				$subject = 'ระงับ';
				break;
			case 'delete':
				$subject = 'ลบ';
				break;
			case 'food_allergy':
				$subject = 'Food Allergy';
				break;
			case 'food_intolerance':
				$subject = 'Food Intolerance';
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

		$pk1 = $data['exam_id'];
		$this->data['recode_url_encrypt_id'] = urlencode(encrypt($pk1));

		if ($pk1 != '') {
			$pk1 = encrypt($pk1);
		}
		$this->data['encrypt_exam_id'] = $pk1;


		$userIdUserFname = $this->Users_result_exam_food_allergy->getValueOf('users', 'user_fname', "user_id = '$data[user_id]'");
		$this->data['userIdUserFname'] = $userIdUserFname;


		$algIdAlgName = $this->Users_result_exam_food_allergy->getValueOf('food_allergy', 'alg_name', "alg_id = '$data[alg_id]'");
		$this->data['algIdAlgName'] = $algIdAlgName;


		$userDeleteUserFname = $this->Users_result_exam_food_allergy->getValueOf('users', 'user_fname', "user_id = '$data[user_delete]'");
		$this->data['userDeleteUserFname'] = $userDeleteUserFname;


		$userAddUserFname = $this->Users_result_exam_food_allergy->getValueOf('users', 'user_fname', "user_id = '$data[user_add]'");
		$this->data['userAddUserFname'] = $userAddUserFname;


		$userUpdateUserFname = $this->Users_result_exam_food_allergy->getValueOf('users', 'user_fname', "user_id = '$data[user_update]'");
		$this->data['userUpdateUserFname'] = $userUpdateUserFname;

		$this->data['record_exam_id'] = $data['exam_id'];
		$this->data['record_user_id'] = $data['user_id'];
		$this->data['record_alg_id'] = $data['alg_id'];
		$this->data['record_user_delete'] = $data['user_delete'];
		$this->data['record_datetime_delete'] = $data['datetime_delete'];
		$this->data['record_user_add'] = $data['user_add'];
		$this->data['record_datetime_add'] = $data['datetime_add'];
		$this->data['record_user_update'] = $data['user_update'];
		$this->data['record_datetime_update'] = $data['datetime_update'];
		$this->data['preview_fag_allow'] = $this->setFagAllowSubject($data['fag_allow']);
		$this->data['record_fag_allow'] = $data['fag_allow'];
		$this->data['preview_food_type'] = $this->setFagAllowSubject($data['food_type']);
		$this->data['record_food_type'] = $data['food_type'];
		$this->data['record_food_alg_val'] = $data['food_alg_val'];

		$this->data['record_datetime_delete'] = setThaiDate($data['datetime_delete']);
		$this->data['record_datetime_add'] = setThaiDate($data['datetime_add']);
		$this->data['record_datetime_update'] = setThaiDate($data['datetime_update']);
		$this->data['record_food_alg_val'] = number_format($data['food_alg_val'], 2);
	}
}
/*---------------------------- END Controller Class --------------------------------*/
