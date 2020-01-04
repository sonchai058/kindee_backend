<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : User_novisit.php ]
 */
class User_novisit extends CRUD_Controller
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
		$this->load->model('foodallergy/User_novisit_model', 'User_novisit');
		$this->data['page_url'] = site_url('foodallergy/user_novisit');
		
		$this->data['page_title'] = 'ข้อมูลอาหารที่ท่านแพ้ (ไม่เคยตรวจ)';
		$js_url = 'assets/js_modules/foodallergy/user_novisit.js?ft='. filemtime('assets/js_modules/foodallergy/user_novisit.js');
		$this->another_js = '<script src="'. base_url($js_url) .'"></script>';
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
	public function create_pagination($page_url, $total) {
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
	public function list_all() {
		$this->session->unset_userdata($this->User_novisit->session_name . '_search_field');
		$this->session->unset_userdata($this->User_novisit->session_name . '_value');

		$this->search();
	}

	// ------------------------------------------------------------------------

	/**
	 * Search data
	 */
	public function search()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'User_novisit', 'class' => 'active', 'url' => '#'),
		);
		if (isset($_POST['submit'])) {
			$search_field =  $this->input->post('search_field', TRUE);
			$value = $this->input->post('txtSearch', TRUE);
			$arr = array($this->User_novisit->session_name . '_search_field' => $search_field, $this->User_novisit->session_name . '_value' => $value );
			$this->session->set_userdata($arr);
		} else {
			$search_field = $this->session->userdata($this->User_novisit->session_name . '_search_field');
			$value = $this->session->userdata($this->User_novisit->session_name . '_value');
		}

		$start_row = $this->uri->segment($this->uri_segment ,'0');
		if(!is_numeric($start_row)){
			$start_row = 0;
		}
		$per_page = $this->per_page;
		$order_by =  $this->input->post('order_by', TRUE);
		if ($order_by != '') {
			$arr = explode('|', $order_by);
			$field = $arr[0];
			$sort = $arr[1];
			switch($sort){
				case 'asc':$sort = 'ASC';break;
				case 'desc':$sort = 'DESC';break;
			}
			$this->User_novisit->order_field = $field;
			$this->User_novisit->order_sort = $sort;
		}
		$results = $this->User_novisit->read($start_row, $per_page);
		$total_row = $results['total_row'];
		$search_row = $results['search_row'];
		$list_data = $this->setDataListFormat($results['list_data'], $start_row);


		$page_url = site_url('foodallergy/user_novisit');
		$pagination = $this->create_pagination($page_url.'/search', $search_row);
		$end_row = $start_row + $per_page;
		if($search_row < $per_page){
			$end_row = $search_row;
		}

		if($end_row > $search_row){
			$end_row = $search_row;
		}

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

		$this->render_view('foodallergy/user_novisit/list_view');
	}

	// ------------------------------------------------------------------------

	/**
	 * Preview Data
	 * @param String encrypt id
	 */
	public function preview($encrypt_id = "")
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'User_novisit', 'url' => site_url('foodallergy/user_novisit')),
						array('title' => 'แสดงข้อมูลรายละเอียด', 'url' => '#', 'class' => 'active')
		);
		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแสดงข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->User_novisit->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->setPreviewFormat($results);
				$this->render_view('foodallergy/user_novisit/preview_view');
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
						array('title' => 'User_novisit', 'url' => site_url('foodallergy/user_novisit')),
						array('title' => 'เพิ่มข้อมูล', 'url' => '#', 'class' => 'active')
		);
		$this->data['users_user_update_option_list'] = $this->User_novisit->returnOptionList("users", "user_id", "user_fname");
		$this->render_view('foodallergy/user_novisit/add_view'); 
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

		$frm->set_rules('user_update', 'ผู้อัปเดต', 'trim|required|is_natural');
		$frm->set_rules('datetime_update', 'วันเวลา ที่อัปเดต', 'trim|required');
		$frm->set_rules('food_intol_exam', 'เคยตรวจ Food Intolerance หรือไม่ [Yes=Yes,No=No]', 'trim|required');

		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');
		$frm->set_message('decimal', '- %s ต้องระบุตัวเลขทศนิยม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('user_update');
			$message .= form_error('datetime_update');
			$message .= form_error('food_intol_exam');
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

		$frm->set_rules('user_update', 'ผู้อัปเดต', 'trim|required|is_natural');
		$frm->set_rules('datetime_update', 'วันเวลา ที่อัปเดต', 'trim|required');
		$frm->set_rules('food_intol_exam', 'เคยตรวจ Food Intolerance หรือไม่ [Yes=Yes,No=No]', 'trim|required');

		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');
		$frm->set_message('decimal', '- %s ต้องระบุตัวเลขทศนิยม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('user_update');
			$message .= form_error('datetime_update');
			$message .= form_error('food_intol_exam');
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
			$id = $this->User_novisit->create($post);
			if($id != ''){
				$success = TRUE;
				$encrypt_id = encrypt($id);
				$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>';
			}else{
				$success = FALSE;
				$message = 'Error : ' . $this->User_novisit->error_message;
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
						array('title' => 'User_novisit', 'url' => site_url('foodallergy/user_novisit')),
						array('title' => 'แก้ไขข้อมูล', 'url' => '#', 'class' => 'active')
		);

		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแก้ไขข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->User_novisit->load($id);
			if (empty($results)) {
			$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->data['csrf_field'] = insert_csrf_field(true);


				$this->setPreviewFormat($results);
				$this->data['users_user_update_option_list'] = $this->User_novisit->returnOptionList("users", "user_id", "user_fname");
				$this->render_view('foodallergy/user_novisit/edit_view');
			}
		}
	}

	// ------------------------------------------------------------------------
	public function checkRecordKey($data)
	{
		$error = '';
		$user_id = ci_decrypt($data['encrypt_user_id']);
		if($user_id==''){
			$error .= '- รหัส user_id';
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

			$result = $this->User_novisit->update($post);
			if($result == false){
				$message = $this->User_novisit->error_message;
				$ok = FALSE;
			}else{
				$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>' . $this->User_novisit->error_message;
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
		}else{
			$result = $this->User_novisit->delete($post);
			if($result == false){
				$message = $this->User_novisit->error_message;
				$ok = FALSE;
			}else{
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
	private function setDataListFormat($lists_data, $start_row=0)
	{
		$data = $lists_data;
		$count = count($lists_data);
		for($i=0;$i<$count;$i++){
			$start_row++;
			$data[$i]['record_number'] = $start_row;
			$pk1 = $data[$i]['user_id'];
			$data[$i]['url_encrypt_id'] = urlencode(encrypt($pk1));

			if($pk1 != ''){
				$pk1 = encrypt($pk1);
			}
			$data[$i]['encrypt_user_id'] = $pk1;
			$data[$i]['preview_food_intol_exam'] = $this->setFoodIntolExamSubject($data[$i]['food_intol_exam']);
			$data[$i]['date_of_birth'] = setThaiDate($data[$i]['date_of_birth']);
			$data[$i]['datetime_delete'] = setThaiDate($data[$i]['datetime_delete']);
			$data[$i]['datetime_add'] = setThaiDate($data[$i]['datetime_add']);
			$data[$i]['datetime_update'] = setThaiDate($data[$i]['datetime_update']);
			$data[$i]['user_height'] = number_format($data[$i]['user_height'],2);
			$data[$i]['goal_reduce_weight'] = number_format($data[$i]['goal_reduce_weight'],2);
			$data[$i]['reduce_date_start'] = setThaiDate($data[$i]['reduce_date_start']);
			$data[$i]['reduce_date_end'] = setThaiDate($data[$i]['reduce_date_end']);
			$data[$i]['goal_increase_weight'] = number_format($data[$i]['goal_increase_weight'],2);
			$data[$i]['increase_date_start'] = setThaiDate($data[$i]['increase_date_start']);
			$data[$i]['increase_date_end'] = setThaiDate($data[$i]['increase_date_end']);
		}
		return $data;
	}

	/**
	 * SET choice subject
	 */
	private function setFoodIntolExamSubject($value)
	{
		$subject = '';
		switch($value){
			case 'Yes':
				$subject = 'Yes';
				break;
			case 'No':
				$subject = 'No';
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

		$pk1 = $data['user_id'];
		$this->data['recode_url_encrypt_id'] = urlencode(encrypt($pk1));

		if($pk1 != ''){
			$pk1 = encrypt($pk1);
		}
		$this->data['encrypt_user_id'] = $pk1;


		$userUpdateUserFname = $this->User_novisit->getValueOf('users', 'user_fname', "user_id = '$data[user_update]'");
		$this->data['userUpdateUserFname'] = $userUpdateUserFname;

		$this->data['record_user_id'] = $data['user_id'];
		$this->data['record_title_name'] = $data['title_name'];
		$this->data['record_user_photo'] = $data['user_photo'];
		$this->data['record_user_fname'] = $data['user_fname'];
		$this->data['record_user_lname'] = $data['user_lname'];
		$this->data['record_date_of_birth'] = $data['date_of_birth'];
		$this->data['record_mobile_no'] = $data['mobile_no'];
		$this->data['record_email_addr'] = $data['email_addr'];
		$this->data['record_cus_passwd'] = $data['cus_passwd'];
		$this->data['record_addr'] = $data['addr'];
		$this->data['record_user_delete'] = $data['user_delete'];
		$this->data['record_datetime_delete'] = $data['datetime_delete'];
		$this->data['record_user_add'] = $data['user_add'];
		$this->data['record_datetime_add'] = $data['datetime_add'];
		$this->data['record_user_update'] = $data['user_update'];
		$this->data['record_datetime_update'] = $data['datetime_update'];
		$this->data['record_fag_allow'] = $data['fag_allow'];
		$this->data['record_org_id'] = $data['org_id'];
		$this->data['record_user_sex'] = $data['user_sex'];
		$this->data['record_user_height'] = $data['user_height'];
		$this->data['record_goal_reduce_weight'] = $data['goal_reduce_weight'];
		$this->data['record_reduce_date_start'] = $data['reduce_date_start'];
		$this->data['record_reduce_date_end'] = $data['reduce_date_end'];
		$this->data['record_goal_increase_weight'] = $data['goal_increase_weight'];
		$this->data['record_increase_date_start'] = $data['increase_date_start'];
		$this->data['record_increase_date_end'] = $data['increase_date_end'];
		$this->data['record_user_level'] = $data['user_level'];
		$this->data['preview_food_intol_exam'] = $this->setFoodIntolExamSubject($data['food_intol_exam']);
		$this->data['record_food_intol_exam'] = $data['food_intol_exam'];
		$this->data['record_limit_allmeat'] = $data['limit_allmeat'];
		$this->data['record_limit_pig'] = $data['limit_pig'];
		$this->data['record_limit_meat'] = $data['limit_meat'];
		$this->data['record_limit_animal'] = $data['limit_animal'];
		$this->data['record_limit_seafood'] = $data['limit_seafood'];
		$this->data['record_limit_additives'] = $data['limit_additives'];

		$this->data['record_date_of_birth'] = setThaiDate($data['date_of_birth']);
		$this->data['record_datetime_delete'] = setThaiDate($data['datetime_delete']);
		$this->data['record_datetime_add'] = setThaiDate($data['datetime_add']);
		$this->data['record_datetime_update'] = setThaiDate($data['datetime_update']);
		$this->data['record_user_height'] = number_format($data['user_height'],2);
		$this->data['record_goal_reduce_weight'] = number_format($data['goal_reduce_weight'],2);
		$this->data['record_reduce_date_start'] = setThaiDate($data['reduce_date_start']);
		$this->data['record_reduce_date_end'] = setThaiDate($data['reduce_date_end']);
		$this->data['record_goal_increase_weight'] = number_format($data['goal_increase_weight'],2);
		$this->data['record_increase_date_start'] = setThaiDate($data['increase_date_start']);
		$this->data['record_increase_date_end'] = setThaiDate($data['increase_date_end']);

	}
}
/*---------------------------- END Controller Class --------------------------------*/
