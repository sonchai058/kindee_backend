<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Pro.php ]
 */
class Pro extends CRUD_Controller
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
		$this->load->model('prodata/Pro_model', 'Pro');
		$this->data['page_url'] = site_url('prodata/pro');
		$this->data['page_title'] = 'จัดการข้อมูลบัตรเครดิต';
		$js_url = 'assets/js_modules/prodata/pro.js?ft=' . filemtime('assets/js_modules/prodata/pro.js');
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
		$this->session->unset_userdata($this->Pro->session_name . '_search_field');
		$this->session->unset_userdata($this->Pro->session_name . '_value');

		$this->search();
	}

	// ------------------------------------------------------------------------

	/**
	 * Search data
	 */
	public function search()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
			array('title' => 'จัดการข้อมูลบัตรเครดิต', 'class' => 'active', 'url' => '#'),
		);
		if (isset($_POST['submit'])) {
			$search_field =  $this->input->post('search_field', TRUE);
			$value = $this->input->post('txtSearch', TRUE);
			switch ($value) {
				case 'บัตรเครดิต':
					$value = 'credit_cart';
					break;
				case 'เครือข่ายโทรศัพท์':
					$value = 'mobile_chanel';
					break;
			}
			$arr = array($this->Pro->session_name . '_search_field' => $search_field, $this->Pro->session_name . '_value' => $value);
			$this->session->set_userdata($arr);
		} else {
			$search_field = $this->session->userdata($this->Pro->session_name . '_search_field');
			$value = $this->session->userdata($this->Pro->session_name . '_value');
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
			$this->Pro->order_field = $field;
			$this->Pro->order_sort = $sort;
		}
		$results = $this->Pro->read($start_row, $per_page);
		$total_row = $results['total_row'];
		$search_row = $results['search_row'];
		$list_data = $this->setDataListFormat($results['list_data'], $start_row);


		$page_url = site_url('prodata/pro');
		$pagination = $this->create_pagination($page_url . '/search', $search_row);
		$end_row = $start_row + $per_page;
		if ($search_row < $per_page) {
			$end_row = $search_row;
		}

		if ($end_row > $search_row) {
			$end_row = $search_row;
		}

		//die(print_r($list_data));

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
		$this->render_view('prodata/pro/list_view');
	}

	// ------------------------------------------------------------------------

	/**
	 * Preview Data
	 * @param String encrypt id
	 */
	public function preview($encrypt_id = "")
	{
		$this->breadcrumb_data['breadcrumb'] = array(
			array('title' => 'ข่าว/บทความ', 'url' => site_url('prodata/pro')),
			array('title' => 'แสดงข้อมูลรายละเอียด', 'url' => '#', 'class' => 'active')
		);
		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแสดงข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Pro->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->setPreviewFormat($results);
				$this->render_view('prodata/pro/preview_view');
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
			array('title' => 'จัดการข้อมูลบัตรเครดิต', 'url' => site_url('prodata/pro')),
			array('title' => 'เพิ่มข้อมูล', 'url' => '#', 'class' => 'active')
		);
		$this->data['count_image'] = 1;
		$this->data['data_id'] = 0;
		$this->data['users_user_delete_option_list'] = $this->Pro->returnOptionList("users", "user_id", "user_fname");
		$this->data['users_user_add_option_list'] = $this->Pro->returnOptionList("users", "user_id", "user_fname");
		$this->data['users_user_update_option_list'] = $this->Pro->returnOptionList("users", "user_id", "user_fname");
		$this->render_view('prodata/pro/add_view');
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

		$frm->set_rules('pro_name', 'ชื่อบัตรเครดิต', 'trim|required');
		$frm->set_rules('pro_type', 'ประเภทบัตรเครดิต', 'trim|required');
		$frm->set_rules('fag_allow', 'สถานะ', 'trim');

		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('pro_name');
			$message .= form_error('pro_type');
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
		$frm->set_rules('blog_name', 'หัวข้อ', 'trim|required');
		$frm->set_rules('blog_detail', 'รายละเอียด', 'trim|required');
		$frm->set_rules('fag_allow', 'สถานะ', 'trim');

		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('date_public');
			$message .= form_error('blog_name');
			$message .= form_error('blog_detail');
			$message .= form_error('fag_allow');
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

			$id = $this->Pro->create($post);
			if ($id != '') {
				$success = TRUE;
				$encrypt_id = encrypt($id);
				$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>';
			} else {
				$success = FALSE;
				$message = 'Error : ' . $this->Pro->error_message;
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
			array('title' => 'ข่าว/บทความ', 'url' => site_url('prodata/pro')),
			array('title' => 'แก้ไขข้อมูล', 'url' => '#', 'class' => 'active')
		);

		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแก้ไขข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Pro->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->data['csrf_field'] = insert_csrf_field(true);


				$this->setPreviewFormat($results);

				$this->data['data_id'] = $id;
				$this->data['users_user_delete_option_list'] = $this->Pro->returnOptionList("users", "user_id", "user_fname");
				$this->data['users_user_add_option_list'] = $this->Pro->returnOptionList("users", "user_id", "user_fname");
				$this->data['users_user_update_option_list'] = $this->Pro->returnOptionList("users", "user_id", "user_fname");


				$this->load->model('common_model');
				$rows = $this->common_model->custom_query("select * from blog_images where pro_id=" . $id . " and fag_allow!='delete'");
				$this->data['count_image'] = count($rows);
				$blog_images = "";
				foreach ($rows as $key => $value) {
					//$year = (substr($value['datetime_add'],0,4)+543);
					$blog_images =  $blog_images . '<div class="preview-image preview-show-' . ($key + 1) . '">' .
						'<div data-image_id="' . $value['image_id'] . '" class="image-cancel" data-no="' . ($key + 1) . '">x</div>' . '<div class="image-zone"><img style="width:320px; height: 320px;" id="pro-img-' . ($key + 1) . '" src="' . base_url() . $value['encrypt_name'] . '"></div>' .
						'</div>';
				}
				$this->data['blog_images'] = $blog_images;


				$this->render_view('prodata/pro/edit_view');
			}
		}
	}

	// ------------------------------------------------------------------------
	public function checkRecordKey($data)
	{
		$error = '';
		$pro_id = ci_decrypt($data['encrypt_pro_id']);
		if ($pro_id == '') {
			$error .= '- รหัส pro_id';
		}
		return $error;
	}

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

			$result = $this->Pro->update($post);
			if ($result == false) {
				$message = $this->Pro->error_message;
				$ok = FALSE;
			} else {
				$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>' . $this->Pro->error_message;
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
			$result = $this->Pro->delete($post);
			if ($result == false) {
				$message = $this->Pro->error_message;
				$ok = FALSE;
			} else {
				$message = '<strong>ลบข้อมูลเรียบร้อย</strong>';
				$ok = TRUE;

				$this->load->model('common_model');
				$this->common_model->update(
					"blog_images",
					array('user_delete' => get_session('user_id'), 'datetime_delete' => date("Y-m-d H:i:s"), 'fag_allow' => 'delete'),
					array('pro_id' => checkEncryptData($post['encrypt_pro_id']))
				);
				$rows = $this->common_model->custom_query("select * from blog_images where pro_id=" . checkEncryptData($post['encrypt_pro_id']));

				foreach ($rows as $key => $value) {
					//$year = (substr($value['datetime_add'],0,4)+543);
					$this->removeFile($value['encrypt_name']);
				}
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
			$pk1 = $data[$i]['pro_id'];
			$data[$i]['url_encrypt_id'] = urlencode(encrypt($pk1));

			if ($pk1 != '') {
				$pk1 = encrypt($pk1);
			}
			$data[$i]['encrypt_pro_id'] = $pk1;
			$data[$i]['preview_fag_allow'] = $this->setFagAllowSubject($data[$i]['fag_allow']);
			$data[$i]['preview_pro_type'] = $this->setProTypeSubject($data[$i]['pro_type']);
			$data[$i]['datetime_delete'] = setThaiDate($data[$i]['datetime_delete']);
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
		}
		return $subject;
	}

	private function setProTypeSubject($value)
	{
		$subject = '';
		switch ($value) {
			case 'credit_cart':
				$subject = 'บัตรเครดิต';
				break;
			case 'mobile_chanel':
				$subject = 'เครือข่ายโทรศัพท์';
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

		$pk1 = $data['pro_id'];
		$this->data['recode_url_encrypt_id'] = urlencode(encrypt($pk1));

		if ($pk1 != '') {
			$pk1 = encrypt($pk1);
		}
		$this->data['encrypt_pro_id'] = $pk1;


		$userDeleteUserFname = $this->Pro->getValueOf('users', 'user_fname', "user_id = '$data[user_delete]'");
		$this->data['userDeleteUserFname'] = $userDeleteUserFname;


		$userAddUserFname = $this->Pro->getValueOf('users', 'user_fname', "user_id = '$data[user_add]'");
		$this->data['userAddUserFname'] = $userAddUserFname;


		$userUpdateUserFname = $this->Pro->getValueOf('users', 'user_fname', "user_id = '$data[user_update]'");
		$this->data['userUpdateUserFname'] = $userUpdateUserFname;

		$this->data['record_pro_id'] = $data['pro_id'];
		$this->data['record_date_public'] = $data['date_public'];
		$this->data['record_blog_name'] = $data['blog_name'];
		$this->data['record_blog_detail'] = $data['blog_detail'];
		$this->data['record_user_delete'] = $data['user_delete'];
		$this->data['record_datetime_delete'] = $data['datetime_delete'];
		$this->data['record_user_add'] = $data['user_add'];
		$this->data['record_datetime_add'] = $data['datetime_add'];
		$this->data['record_user_update'] = $data['user_update'];
		$this->data['record_datetime_update'] = $data['datetime_update'];
		$this->data['preview_fag_allow'] = $this->setFagAllowSubject($data['fag_allow']);
		$this->data['record_fag_allow'] = $data['fag_allow'];

		$this->data['record_date_public'] = setThaiDate($data['date_public']);
		$this->data['record_datetime_delete'] = setThaiDate($data['datetime_delete']);
		$this->data['record_datetime_add'] = setThaiDate($data['datetime_add']);
		$this->data['record_datetime_update'] = setThaiDate($data['datetime_update']);
	}
}
/*---------------------------- END Controller Class --------------------------------*/
