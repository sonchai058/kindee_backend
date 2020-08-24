<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Users_food_time.php ]
 */
class Users_food_time extends CRUD_Controller
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
		$this->load->model('foodeat/Users_food_time_model', 'Users_food_time');
		$this->load->model('api/User_api_model', 'user');
		$this->load->model('api/Food_api_model', 'food');
		$this->data['page_url'] = site_url('foodeat/users_food_time');

		$this->data['page_title'] = 'ข้อมูลการรับประทานอาหาร';
		$js_url = 'assets/js_modules/foodeat/users_food_time.js?ft=' . filemtime('assets/js_modules/foodeat/users_food_time.js');
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
		$this->session->unset_userdata($this->Users_food_time->session_name . '_search_field');
		$this->session->unset_userdata($this->Users_food_time->session_name . '_value');

		$this->search();
	}

	// ------------------------------------------------------------------------

	/**
	 * Search data
	 */
	public function search()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
			array('title' => 'ข้อมูลการรับประทานอาหาร', 'class' => 'active', 'url' => '#'),
		);
		if (isset($_POST['submit'])) {
			$search_field =  $this->input->post('search_field', TRUE);
			$value = $this->input->post('txtSearch', TRUE);
			$arr = array($this->Users_food_time->session_name . '_search_field' => $search_field, $this->Users_food_time->session_name . '_value' => $value);
			$this->session->set_userdata($arr);
		} else {
			$search_field = $this->session->userdata($this->Users_food_time->session_name . '_search_field');
			$value = $this->session->userdata($this->Users_food_time->session_name . '_value');
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
			$this->Users_food_time->order_field = $field;
			$this->Users_food_time->order_sort = $sort;
		}
		$results = $this->Users_food_time->read($start_row, $per_page);
		$total_row = $results['total_row'];
		$search_row = $results['search_row'];
		$list_data = $this->setDataListFormat($results['list_data'], $start_row);


		$page_url = site_url('foodeat/users_food_time');
		$pagination = $this->create_pagination($page_url . '/search', $search_row);
		$end_row = $start_row + $per_page;
		if ($search_row < $per_page) {
			$end_row = $search_row;
		}

		if ($end_row > $search_row) {
			$end_row = $search_row;
		}

		$date = '';
		if($date != ''){
			$sub_month = substr($date, 4, 2);
			$sub_day = substr($date, 6, 2);
			$sub_year = substr($date, 0, 4);
			$date = $sub_year."-".$sub_month."-".$sub_day;
		}else{
			$date = date('Y-m-d');
		}
		$res = $this->user->getBMI($_SESSION['email_addr'], $date);
		$res_food = $this->food->getFood($_SESSION['email_addr'], $date);
		$this->data['sum_food_energy']	= $res['sum_food_energy'];
		$this->data['sum_carboh_val']	= $res['sum_carboh_val'];
		$this->data['sum_protein_val']	= $res['sum_protein_val'];
		$this->data['sum_fat_val']	= $res['sum_fat_val'];
		$this->data['sum_sodium_val']	= $res['sum_sodium_val'];
		$this->data['user_bmr']	= $res_food['user_bmi'];
		@$user_bmi	= str_replace(',','',$res_food['user_bmi']);
		@$user_bmr_carboh	= (str_replace(',','',$res_food['user_bmi'])*0.6);
		@$user_bmr_protein	= (str_replace(',','',$res_food['user_bmi'])*0.25);
		@$user_bmr_fat	= (str_replace(',','',$res_food['user_bmi'])*0.15);
		@$user_bmr_sodium	= 2300;
		$this->data['user_bmr_carboh']	= number_format($user_bmr_carboh,2);
		$this->data['user_bmr_protein']	= number_format($user_bmr_protein,2);
		$this->data['user_bmr_fat']	= number_format($user_bmr_fat,2);
		$this->data['user_bmr_sodium']	= number_format($user_bmr_sodium,2);
		$this->data['balance_energy']	= number_format(($user_bmi-str_replace(',','',$res['sum_food_energy'])),2);
		$this->data['balance_carboh']	= number_format(($user_bmr_carboh-str_replace(',','',$res['sum_carboh_val'])),2);
		$this->data['balance_protein'] =	number_format(($user_bmr_protein-str_replace(',','',$res['sum_protein_val'])),2);
		$this->data['balance_fat'] = number_format(($user_bmr_fat-str_replace(',','',$res['sum_fat_val'])),2);
		$this->data['balance_sodium'] = number_format(($user_bmr_sodium-str_replace(',','',$res['sum_sodium_val'])),2);
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

		$this->render_view('foodeat/users_food_time/list_view');
	}

	// ------------------------------------------------------------------------

	/**
	 * Preview Data
	 * @param String encrypt id
	 */
	public function preview($encrypt_id = "")
	{
		$this->breadcrumb_data['breadcrumb'] = array(
			array('title' => 'ข้อมูลการรับประทานอาหาร', 'url' => site_url('foodeat/users_food_time')),
			array('title' => 'แสดงข้อมูลรายละเอียด', 'url' => '#', 'class' => 'active')
		);
		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแสดงข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Users_food_time->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->setPreviewFormat($results);
				$this->render_view('foodeat/users_food_time/preview_view');
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
			array('title' => 'ข้อมูลการรับประทานอาหาร', 'url' => site_url('foodeat/users_food_time')),
			array('title' => 'เพิ่มข้อมูล', 'url' => '#', 'class' => 'active')
		);
		$this->data['users_user_id_option_list'] = $this->Users_food_time->returnOptionList("users", "user_id", "user_fname");
		$this->data['self_food_menu_food_id_option_list'] = $this->Users_food_time->returnOptionList("self_food_menu", "self_food_id", "CONCAT_WS(' - พลังงาน ', self_food_name,TRUNCATE(energy_amt,2))");
		$this->render_view('foodeat/users_food_time/add_view');
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
		$frm->set_rules('food_source', 'แหล่งอาหาร [เมนูจากระบบ=เมนูจากระบบ,เมนูปรุงเอง=เมนูปรุงเอง,ร้านอาหาร=ร้านอาหาร]', 'trim|required');
		$frm->set_rules('eat_time', 'มื้ออาหาร [เช้า=เช้า,กลางวัน=กลางวัน,เย็น=เย็น]', 'trim|required');
		$frm->set_rules('date_eat', 'วันที่', 'trim|required');
		$frm->set_rules('food_id', 'เมนูอาหาร', 'trim|required|is_natural');
		$frm->set_rules('food_energy', 'พลังงาน', 'trim|required');
		$frm->set_rules('fag_allow', 'สถานะ', 'trim');

		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');
		$frm->set_message('decimal', '- %s ต้องระบุตัวเลขทศนิยม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('user_id');
			$message .= form_error('food_source');
			$message .= form_error('eat_time');
			$message .= form_error('date_eat');
			$message .= form_error('food_id');
			$message .= form_error('food_energy');
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

		$frm->set_rules('user_id', 'รหัสสมาชิก', 'trim');
		$frm->set_rules('food_source', 'แหล่งอาหาร [เมนูจากระบบ=เมนูจากระบบ,เมนูปรุงเอง=เมนูปรุงเอง,ร้านอาหาร=ร้านอาหาร]', 'trim|required');
		$frm->set_rules('eat_time', 'มื้ออาหาร [เช้า=เช้า,กลางวัน=กลางวัน,เย็น=เย็น]', 'trim|required');
		$frm->set_rules('date_eat', 'วันที่', 'trim|required');
		$frm->set_rules('food_id', 'เมนูอาหาร', 'trim|required|is_natural');
		$frm->set_rules('food_energy', 'พลังงาน', 'trim|required');
		$frm->set_rules('fag_allow', 'สถานะ', 'trim');

		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');
		$frm->set_message('decimal', '- %s ต้องระบุตัวเลขทศนิยม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('user_id');
			$message .= form_error('food_source');
			$message .= form_error('eat_time');
			$message .= form_error('date_eat');
			$message .= form_error('food_id');
			$message .= form_error('food_energy');
			$message .= form_error('fag_allow');
			return $message;
		}
	}

	public function allergy($food_id){
			$data = $this->Users_food_time->allergy($food_id);
			$json = json_encode(array(
				'is_successful' => FALSE,
				'message' => $data
			));
			echo $json;
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
			$post['user_id'] = get_session('user_id');
			$id = $this->Users_food_time->create($post);
			if ($id != '') {
				$success = TRUE;
				$encrypt_id = encrypt($id);
				$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>';
			} else {
				$success = FALSE;
				$message = 'Error : ' . $this->Users_food_time->error_message;
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
			array('title' => 'ข้อมูลการรับประทานอาหาร', 'url' => site_url('foodeat/users_food_time')),
			array('title' => 'แก้ไขข้อมูล', 'url' => '#', 'class' => 'active')
		);

		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแก้ไขข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Users_food_time->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->data['csrf_field'] = insert_csrf_field(true);


				$this->setPreviewFormat($results);
				$this->data['users_user_id_option_list'] = $this->Users_food_time->returnOptionList("users", "user_id", "user_fname");
				$this->data['self_food_menu_food_id_option_list'] = $this->Users_food_time->returnOptionList("self_food_menu", "self_food_id", "CONCAT_WS(' - พลังงาน ', self_food_name,TRUNCATE(energy_amt,2))");
				$this->render_view('foodeat/users_food_time/edit_view');
			}
		}
	}

	// ------------------------------------------------------------------------
	public function checkRecordKey($data)
	{
		$error = '';
		$foodt_id = ci_decrypt($data['encrypt_foodt_id']);
		if ($foodt_id == '') {
			$error .= '- รหัส foodt_id';
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
		/*
		$edit_remark = $this->input->post('edit_remark', TRUE);
		if ($edit_remark == '') {
			$message .= 'ระบุเหตุผล';
		}
		*/

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

			$result = $this->Users_food_time->update($post);
			if ($result == false) {
				$message = $this->Users_food_time->error_message;
				$ok = FALSE;
			} else {
				$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>' . $this->Users_food_time->error_message;
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
		//if ($delete_remark == '') {
		//	$message .= 'ระบุเหตุผล';
		//}

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
			$result = $this->Users_food_time->delete($post);
			if ($result == false) {
				$message = $this->Users_food_time->error_message;
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
			$pk1 = $data[$i]['foodt_id'];
			$data[$i]['url_encrypt_id'] = urlencode(encrypt($pk1));

			if ($pk1 != '') {
				$pk1 = encrypt($pk1);
			}
			$data[$i]['encrypt_foodt_id'] = $pk1;
			$data[$i]['preview_food_source'] = $this->setFoodSourceSubject($data[$i]['food_source']);
			$data[$i]['preview_eat_time'] = $this->setEatTimeSubject($data[$i]['eat_time']);
			$data[$i]['preview_fag_allow'] = $this->setFagAllowSubject($data[$i]['fag_allow']);
			$data[$i]['date_eat'] = setThaiDate($data[$i]['date_eat']);
			$data[$i]['food_energy'] = number_format(($data[$i]['food_energy']), 2);
			$data[$i]['sodium_val'] = number_format(($data[$i]['sodium_val']), 2);
			$data[$i]['datetime_delete'] = setThaiDate($data[$i]['datetime_delete']);
			$data[$i]['datetime_add'] = setThaiDate($data[$i]['datetime_add']);
			$data[$i]['datetime_update'] = setThaiDate($data[$i]['datetime_update']);
		}

		return $data;
	}

	/**
	 * SET choice subject
	 */
	private function setFoodSourceSubject($value)
	{
		$subject = '';
		switch ($value) {
			case 'เมนูจากระบบ':
				$subject = 'เมนูจากระบบ';
				break;
			case 'เมนูปรุงเอง':
				$subject = 'เมนูปรุงเอง';
				break;
		}
		return $subject;
	}

	/**
	 * SET choice subject
	 */
	private function setEatTimeSubject($value)
	{
		$subject = '';
		switch ($value) {
			case 'เช้า':
				$subject = 'เช้า';
				break;
			case 'กลางวัน':
				$subject = 'กลางวัน';
				break;
			case 'เย็น':
				$subject = 'เย็น';
				break;
		}
		return $subject;
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
		}
		return $subject;
	}

	/**
	 * SET array data list
	 */
	private function setPreviewFormat($row_data)
	{
		$data = $row_data;

		$pk1 = $data['foodt_id'];
		$this->data['recode_url_encrypt_id'] = urlencode(encrypt($pk1));

		if ($pk1 != '') {
			$pk1 = encrypt($pk1);
		}
		$this->data['encrypt_foodt_id'] = $pk1;


		$userIdUserFname = $this->Users_food_time->getValueOf('users', 'user_fname', "user_id = '$data[user_id]'");
		$this->data['userIdUserFname'] = $userIdUserFname;


		$titleRow = $this->Users_food_time->getRowOf('self_food_menu', 'self_food_name, energy_amt', "self_food_id = '$data[food_id]'", $this->db);
		$sodium_val = $this->Users_food_time->getRowOf(
			'self_food_menu  as a LEFT JOIN self_food_menu_composition AS b ON a.self_food_id = b.self_food_id
			LEFT JOIN raw_material AS c ON b.rmat_id = c.rmat_id',
			'a.energy_amt As energy_amt,b.self_food_id AS self_food_id,sum(c.sodium_val*b.amount)/100 AS sodium_val',
			"a.self_food_id = '$data[food_id]' and b.fag_allow='allow'", $this->db
		);

		$foodIdSelfFoodName = $titleRow['self_food_name'];
		$foodIdEnergyAmt = $titleRow['energy_amt'];
		$foodSodium = number_format($sodium_val['sodium_val'],2);

		$this->data['foodIdSelfFoodName'] = $foodIdSelfFoodName;
		$this->data['foodIdEnergyAmt'] = $foodIdEnergyAmt;

		$this->data['record_sodium_val'] = $foodSodium;

		$this->data['record_foodt_id'] = $data['foodt_id'];
		$this->data['record_user_id'] = $data['user_id'];
		$this->data['preview_food_source'] = $this->setFoodSourceSubject($data['food_source']);
		$this->data['record_food_source'] = $data['food_source'];
		$this->data['preview_eat_time'] = $this->setEatTimeSubject($data['eat_time']);
		$this->data['record_eat_time'] = $data['eat_time'];
		$this->data['record_date_eat'] = $data['date_eat'];
		$this->data['record_food_id'] = $data['food_id'];
		$this->data['record_food_energy'] = ($data['food_energy']);
		$this->data['record_user_delete'] = $data['user_delete'];
		$this->data['record_datetime_delete'] = $data['datetime_delete'];
		$this->data['record_user_add'] = $data['user_add'];
		$this->data['record_datetime_add'] = $data['datetime_add'];
		$this->data['record_user_update'] = $data['user_update'];
		$this->data['record_datetime_update'] = $data['datetime_update'];
		$this->data['preview_fag_allow'] = $this->setFagAllowSubject($data['fag_allow']);
		$this->data['record_fag_allow'] = $data['fag_allow'];

		$this->data['record_date_eat'] = setThaiDate($data['date_eat']);
		$this->data['record_food_energy'] = number_format(($data['food_energy']), 2);
		$this->data['record_datetime_delete'] = setThaiDate($data['datetime_delete']);
		$this->data['record_datetime_add'] = setThaiDate($data['datetime_add']);
		$this->data['record_datetime_update'] = setThaiDate($data['datetime_update']);
	}
}
/*---------------------------- END Controller Class --------------------------------*/
