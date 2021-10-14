<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Nutritionist.php ]
 */

/**
 * Debug
 * *echo "<pre>"; print_r($arr); echo "</pre>"; exit();
 */
class Nutritionist extends CRUD_Controller
{

	private $per_page;
	private $another_js;
	private $another_css;
	private $upload_store_path;
	private $file_allow;
	private $file_allow_type;
	private $file_allow_mime;
	private $file_check_name;

	public function __construct()
	{
		parent::__construct();

		chkUserPerm();

		$this->per_page = 30;
		$this->num_links = 6;
		$this->uri_segment = 4;
		$this->load->model('setting/Nutritionist_model', 'Nutritionist');
		$this->load->model('FileUpload_model', 'FileUpload');
		$this->data['page_url'] = site_url('setting/nutritionist');

		$this->data['page_title'] = 'จัดการผู้ใช้งาน';
		$this->upload_store_path = './assets/uploads/nutritionist/';
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
		$js_url = 'assets/js_modules/setting/nutritionist.js?ft=' . filemtime('assets/js_modules/setting/nutritionist.js');
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
		$this->session->unset_userdata($this->Nutritionist->session_name . '_search_field');
		$this->session->unset_userdata($this->Nutritionist->session_name . '_value');

		$this->search();
	}

	// ------------------------------------------------------------------------

	/**
	 * Search data
	 */
	public function search()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
			array('title' => 'จัดการสมาชิกนักโภชนาการ', 'class' => 'active', 'url' => '#'),
		);
		if (isset($_POST['submit'])) {
			$search_field =  $this->input->post('search_field', TRUE);
			$value = $this->input->post('txtSearch', TRUE);
			$arr = array($this->Nutritionist->session_name . '_search_field' => $search_field, $this->Nutritionist->session_name . '_value' => $value);
			$this->session->set_userdata($arr);
		} else {
			$search_field = $this->session->userdata($this->Nutritionist->session_name . '_search_field');
			$value = $this->session->userdata($this->Nutritionist->session_name . '_value');
		}
		// die(print_r($value));


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
			$this->Nutritionist->order_field = $field;
			$this->Nutritionist->order_sort = $sort;
		}
		$results = $this->Nutritionist->read($start_row, $per_page);

		$total_row = $results['total_row'];

		$search_row = $results['search_row'];
		// print_r($total_row);
		// print_r($search_row);
		// die();

		$list_data = $this->setDataListFormat($results['list_data'], $start_row);


		$page_url = site_url('setting/nutritionist');
		$pagination = $this->create_pagination($page_url . '/search', $search_row);
		$end_row = $start_row + $per_page;
		if ($search_row < $per_page) {
			$end_row = $search_row;
		}

		if ($end_row > $search_row) {
			$end_row = $search_row;
		}

		$data = array();
		$this->load->model('common_model');

		foreach ($list_data as $key => $v) {
			$data[$key] = array();
			$rows = $this->common_model->custom_query("select users.* FROM users");
			foreach ($v as $column => $value_status) {
				$data[$key][$column] = $value_status;
				// foreach ($rows as $key => $value) {
				// 	$data[$key]['user_nutri_val'] =  $value['user_nutri'];
				// }
			}
			$data[$key]['test'] =  $data[$key]['user_nutri'];
			// echo'<pre>';
			// print_r($rows);
			// echo'</pre>';
			// die();


		}


		$this->data['data_list']	= $list_data;
		// $this->data['data_list']	= $data;

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

		$this->render_view('setting/nutritionist/list_view');
	}

	// ------------------------------------------------------------------------

	/**
	 * Preview Data
	 * @param String encrypt id
	 */
	public function preview($encrypt_id = "")
	{
		$this->breadcrumb_data['breadcrumb'] = array(
			array('title' => 'จัดการข้อมูลส่วนตัว', 'url' => site_url('setting/users')),
			array('title' => 'แสดงข้อมูลรายละเอียด', 'url' => '#', 'class' => 'active')
		);
		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแสดงข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Nutritionist->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->setPreviewFormat($results);
				$this->render_view('setting/users/preview_view');
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
			array('title' => 'จัดการข้อมูลส่วนตัว', 'url' => site_url('setting/users')),
			array('title' => 'เพิ่มข้อมูล', 'url' => '#', 'class' => 'active')
		);


		$this->data['data_id'] = 0;

		$rows = array(
			'limit_allmeat' => array('No', 'เนื้อสัตว์ทุกชนิด'),
			'limit_pig' => array('No', 'หมู'),
			'limit_meat' => array('No', 'เนื้อ'),
			'limit_animal' => array('No', 'ผลิตภัณฑ์จากสัตว์ เช่นไข่และนม'),
			'limit_seafood' => array('No', 'อาหารทะเล'),
			'limit_additives' => array('No', 'สารเติมแต่ง เช่น ผงชูรส'),
		);
		$tmp_data = '<div class="form-row justify-content-start">';
		foreach ($rows as $key => $value) {
			$selected = '';
			//if($value[0]=='Yes')continue;
			if ($value[0] == 'Yes') {
				$selected = 'checked';
			}
			// $tmp_data = $tmp_data."<div onclick=\"if($('.{$key}:checked').length==0)".'{'."$('.{$key}').prop('checked',true);".'}'."else ".'{'."$('.{$key}').prop('checked',false);".'}'."\" class='col-sm-12 col-md-4'><label class='col-sm-12 control-label chk' for=''>&nbsp;&nbsp;&nbsp;{$value[1]}</label><input style='margin-top: -40px;' type='checkbox' class='form-control {$key}' name='limit[{$key}]' value='{$value[0]}' {$selected}></div>";
			$tmp_data = $tmp_data . "<div onclick=\"if($('.{$key}:checked').length==0)" . '{' . "$('.{$key}').prop('checked',true);" . '}' . "else " . '{' . "$('.{$key}').prop('checked',false);" . '}' . "\" class='form-group col-md-4'><div class='form-check'><label class='form-check-label'><input class='form-check-input {$key}' name='limit[{$key}]' value='{$value[0]}' {$selected} type='checkbox'> {$value[1]} <span class='form-check-sign'><span class='check'></span></span></label></div></div>";
		}
		$this->data['limit'] = $tmp_data . '</div>';

		$this->data['promotions1'] = "";
		$this->data['promotions2'] = "";
		$this->load->model("common_model");

		//$rows1 = $this->common_model->custom_query("select * from users_promotions as b where b.fag_allow='allow' and b.user_id={$this->session->userdata('user_id')}");
		$setSelect = array();
		if (isset($rows1)) {
			foreach ($rows1 as $key => $value) {
				$setSelect[$value['pro_id']] = 'Yes';
			}
		}

		$rows = $this->common_model->custom_query("select * from promotions as a where a.fag_allow='allow' and pro_type='credit_cart' order by a.pro_name");
		$tmp_data = '<div class="form-row justify-content-start">';
		foreach ($rows as $key => $value) {
			$selected = '';
			//if($value['b_fag_allow']=='delete')continue;
			$pro_discount = 0;
			if (isset($setSelect[$value['pro_id']])) {
				$selected = 'checked';
			}
			// $tmp_data = $tmp_data."<div onclick=\"if($('.pro_id{$value['pro_id']}:checked').length==0)".'{'."$('.pro_id{$value['pro_id']}').prop('checked',true);".'}'."else ".'{'."$('.pro_id{$value['pro_id']}').prop('checked',false);".'}'."\" class='col-sm-12 col-md-4'><label class='chk col-sm-12 control-label' for=''>&nbsp;&nbsp;&nbsp;{$value['pro_name']}</label><input style='margin-top: -40px;'  type='checkbox' class='form-control pro_id{$value['pro_id']}' name='pro_id[{$value['pro_id']}]' value='{$value['pro_id']}' {$selected}></div>";
			$tmp_data = $tmp_data . "<div onclick=\"if($('.pro_id{$value['pro_id']}:checked').length==0)" . '{' . "$('.pro_id{$value['pro_id']}').prop('checked',true);" . '}' . "else " . '{' . "$('.pro_id{$value['pro_id']}').prop('checked',false);" . '}' . "\"  class='form-group col-md-4'><div class='form-check'><label class='form-check-label'><input class='form-check-input {$value['pro_id']}' name='pro_id[{$value['pro_id']}]' value='{$value['pro_id']}' {$selected} type='checkbox'> {$value['pro_name']} <span class='form-check-sign'><span class='check'></span></span></label></div></div>";
		}
		$tmp_data .= "</div>";
		$this->data['promotions1'] = $tmp_data;

		$rows = $this->common_model->custom_query("select * from promotions as a where a.fag_allow='allow' and pro_type='mobile_chanel' order by a.pro_name");

		$tmp_data = '<div class="form-row justify-content-start">';
		foreach ($rows as $key => $value) {
			$selected = '';
			//if($value['b_fag_allow']=='delete')continue;
			$pro_discount = 0;
			if (isset($setSelect[$value['pro_id']])) {
				$selected = 'checked';
			}
			// $tmp_data = $tmp_data."<div onclick=\"if($('.pro_id{$value['pro_id']}:checked').length==0)".'{'."$('.pro_id{$value['pro_id']}').prop('checked',true);".'}'."else ".'{'."$('.pro_id{$value['pro_id']}').prop('checked',false);".'}'."\" class='col-sm-12 col-md-4'><label class='chk col-sm-12 control-label' for=''>&nbsp;&nbsp;&nbsp;{$value['pro_name']}</label><input style='margin-top: -40px;'  type='checkbox' class='form-control pro_id{$value['pro_id']}' name='pro_id[{$value['pro_id']}]' value='{$value['pro_id']}' {$selected}></div>";
			$tmp_data = $tmp_data . "<div onclick=\"if($('.pro_id{$value['pro_id']}:checked').length==0)" . '{' . "$('.pro_id{$value['pro_id']}').prop('checked',true);" . '}' . "else " . '{' . "$('.pro_id{$value['pro_id']}').prop('checked',false);" . '}' . "\"  class='form-group col-md-4'><div class='form-check'><label class='form-check-label'><input class='form-check-input {$value['pro_id']}' name='pro_id[{$value['pro_id']}]' value='{$value['pro_id']}' {$selected} type='checkbox'> {$value['pro_name']} <span class='form-check-sign'><span class='check'></span></span></label></div></div>";
		}
		$tmp_data .= "</div>";
		$this->data['promotions2'] = $tmp_data;

		$this->data['users_user_delete_option_list'] = $this->Nutritionist->returnOptionList("users", "user_id", "user_fname");
		$this->data['users_user_add_option_list'] = $this->Nutritionist->returnOptionList("users", "user_id", "user_fname");
		$this->data['users_user_update_option_list'] = $this->Nutritionist->returnOptionList("users", "user_id", "user_fname");
		$this->data['organizations_org_id_option_list'] = $this->Nutritionist->returnOptionList("organizations", "org_id", "org_name");
		$this->data['preview_user_photo'] = '<div id="div_preview_user_photo" class="py-3 div_file_preview" style="clear:both"><img id="user_photo_preview" height="200" width="100%"/></div>';
		$this->data['record_user_photo_label'] = '';
		$this->render_view('setting/users/add_view');
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

		$frm->set_rules('title_name', 'คำนำหน้าชื่อ', 'trim|required');
		//file upload
		$check_file = FALSE;
		if ($this->input->post('user_photo_label') == '') {
			$check_file = TRUE;
		}
		if ($check_file == TRUE) {
			if (empty($_FILES['user_photo']['name'])) {
				$frm->set_rules('user_photo', 'รูป', 'trim|required');
			}
		}
		$frm->set_rules('user_fname', 'ชื่อ', 'trim|required');
		$frm->set_rules('user_lname', 'นามสกุล', 'trim|required');
		$frm->set_rules('date_of_birth', 'วันเกิด', 'trim|required');
		$frm->set_rules('mobile_no', 'มือถือ', 'trim|required');
		$frm->set_rules('email_addr', 'อีเมล', 'trim|required');
		$frm->set_rules('cus_passwd', 'รหัสผ่าน', 'trim|required');
		$frm->set_rules('addr', 'ที่อยู่', 'trim|required');
		$frm->set_rules('fag_allow', 'สถานะ', 'trim');
		$frm->set_rules('user_sex', 'เพศ [ชาย=ชาย,หญิง=หญิง,ไม่ระบุ=ไม่ระบุ]', 'trim|required');
		$frm->set_rules('user_height', 'ส่วนสูง CM', 'trim|required|callback_float_check');
		$frm->set_rules('goal_reduce_weight', 'เป้าหมายในการลดน้ำหนัก (น้ำหนัก)', 'trim|callback_float_check');
		$frm->set_rules('reduce_date_start', 'เป้าหมายในการลดน้ำหนัก (ภายในวันที่) เริ่มต้น', 'trim');
		$frm->set_rules('reduce_date_end', 'เป้าหมายในการลดน้ำหนัก (ภายในวันที่) สิ้นสุด', 'trim');
		$frm->set_rules('goal_increase_weight', 'เป้าหมายในการเพิ่มน้ำหนัก (น้ำหนัก)', 'trim|callback_float_check');
		$frm->set_rules('increase_date_start', 'เป้าหมายในการเพิ่มน้ำหนัก (ภายในวันที่) เริ่มต้น', 'trim');
		$frm->set_rules('increase_date_end', 'เป้าหมายในการเพิ่มน้ำหนัก (ภายในวันที่) สิ้นสุด', 'trim');

		if ($this->session->userdata('user_level') == 'admin') {
			$frm->set_rules('user_level', 'ระดับผู้ใช้งาน', 'trim|required');
			$frm->set_rules('org_id', 'รหัสองค์กรที่สังกัด', 'trim|required|is_natural');
		} else {
			$frm->set_rules('user_level', 'ระดับผู้ใช้งาน', 'trim');
			$frm->set_rules('org_id', 'รหัสองค์กรที่สังกัด', 'trim');
		}

		$frm->set_rules('food_intol_exam', 'เคยตรวจ Food Intolerance หรือไม่ Yes | No [Yes=ใช่,No=ไม่ใช่]', 'trim');
		/*
		$frm->set_rules('limit_allmeat', 'ข้อจำกัดการบริโภค (เนื้อสัตว์ทุกชนิด) [Yes=ใช่,No=ไม่ใช่]', 'trim|required');
		$frm->set_rules('limit_pig', 'ข้อจำกัดการบริโภค (หมู) [Yes=ใช่,No=ไม่ใช่]', 'trim|required');
		$frm->set_rules('limit_meat', 'ข้อจำกัดการบริโภค (เนื้อ) [Yes=ใช่,No=ไม่ใช่]', 'trim|required');
		$frm->set_rules('limit_animal', 'ข้อจำกัดการบริโภค (ผลิตภัณฑ์จากสัตว์ เช่นไข่และนม) [Yes=ใช่,No=ไม่ใช่]', 'trim|required');
		$frm->set_rules('limit_seafood', 'ข้อจำกัดการบริโภค (อาหารทะเล) [Yes=ใช่,No=ไม่ใช่]', 'trim|required');
		$frm->set_rules('limit_additives', 'ข้อจำกัดการบริโภค (สารเติมแต่ง เช่น ผงชูรส) [Yes=ใช่,No=ไม่ใช่]', 'trim|required');
		*/
		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');
		$frm->set_message('callback_float_check', '- %s ต้องระบุตัวเลขทศนิยม');
		$frm->set_message('decimal', '- %s ต้องระบุตัวเลขทศนิยม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('title_name');
			$message .= form_error('user_photo');
			$message .= form_error('user_fname');
			$message .= form_error('user_lname');
			$message .= form_error('date_of_birth');
			$message .= form_error('mobile_no');
			$message .= form_error('email_addr');
			$message .= form_error('cus_passwd');
			$message .= form_error('addr');
			$message .= form_error('fag_allow');
			$message .= form_error('org_id');
			$message .= form_error('user_sex');
			$message .= form_error('user_height');
			$message .= form_error('goal_reduce_weight');
			$message .= form_error('reduce_date_start');
			$message .= form_error('reduce_date_end');
			$message .= form_error('goal_increase_weight');
			$message .= form_error('increase_date_start');
			$message .= form_error('increase_date_end');
			$message .= form_error('user_level');
			$message .= form_error('food_intol_exam');
			/*
			$message .= form_error('limit_allmeat');
			$message .= form_error('limit_pig');
			$message .= form_error('limit_meat');
			$message .= form_error('limit_animal');
			$message .= form_error('limit_seafood');
			$message .= form_error('limit_additives');
			*/
			return $message;
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * Default Validation for Update
	 * see also https://www.codeigniter.com/userguide3/libraries/form_validation.html
	 */
	public function float_check($val)
	{
		return TRUE;
		/*
    	die($val);
        if ( !is_int($val) || !is_float($val) ) {
            $this->form_validation->set_message('float_check', '- %s ต้องระบุตัวเลขทศนิยม');
            return FALSE;
        } else {
            return TRUE;
        }
        */
	}

	public function formValidateUpdate()
	{
		$this->load->library('form_validation');
		$frm = $this->form_validation;

		$frm->set_rules('title_name', 'คำนำหน้าชื่อ', 'trim|required');
		//file upload
		$check_file = FALSE;
		if ($this->input->post('user_photo_label') == '') {
			$check_file = TRUE;
		}
		if ($check_file == TRUE) {
			if (empty($_FILES['user_photo']['name'])) {
				$frm->set_rules('user_photo', 'รูป', 'trim|required');
			}
		}
		$frm->set_rules('user_fname', 'ชื่อ', 'trim|required');
		$frm->set_rules('user_lname', 'นามสกุล', 'trim|required');
		$frm->set_rules('date_of_birth', 'วันเกิด', 'trim|required');
		$frm->set_rules('mobile_no', 'มือถือ', 'trim|required');
		$frm->set_rules('email_addr', 'อีเมล', 'trim|required');
		$frm->set_rules('cus_passwd', 'รหัสผ่าน', 'trim|required');
		$frm->set_rules('addr', 'ที่อยู่', 'trim|required');
		$frm->set_rules('fag_allow', 'สถานะ', 'trim');

		$frm->set_rules('user_sex', 'เพศ [ชาย=ชาย,หญิง=หญิง,ไม่ระบุ=ไม่ระบุ]', 'trim|required');
		$frm->set_rules('user_height', 'ส่วนสูง CM', 'trim|required|callback_float_check');
		$frm->set_rules('goal_reduce_weight', 'เป้าหมายในการลดน้ำหนัก (น้ำหนัก)', 'trim|callback_float_check');
		$frm->set_rules('reduce_date_start', 'เป้าหมายในการลดน้ำหนัก (ภายในวันที่) เริ่มต้น', 'trim');
		$frm->set_rules('reduce_date_end', 'เป้าหมายในการลดน้ำหนัก (ภายในวันที่) สิ้นสุด', 'trim');
		$frm->set_rules('goal_increase_weight', 'เป้าหมายในการเพิ่มน้ำหนัก (น้ำหนัก)', 'trim|callback_float_check');
		$frm->set_rules('increase_date_start', 'เป้าหมายในการเพิ่มน้ำหนัก (ภายในวันที่) เริ่มต้น', 'trim');
		$frm->set_rules('increase_date_end', 'เป้าหมายในการเพิ่มน้ำหนัก (ภายในวันที่) สิ้นสุด', 'trim');
		if ($this->session->userdata('user_level') == 'admin') {
			$frm->set_rules('user_level', 'ระดับผู้ใช้งาน', 'trim|required');
			$frm->set_rules('org_id', 'รหัสองค์กรที่สังกัด', 'trim|required|is_natural');
		} else {
			$frm->set_rules('user_level', 'ระดับผู้ใช้งาน', 'trim');
			$frm->set_rules('org_id', 'รหัสองค์กรที่สังกัด', 'trim');
		}
		$frm->set_rules('food_intol_exam', 'เคยตรวจ Food Intolerance หรือไม่ Yes | No [Yes=ใช่,No=ไม่ใช่]', 'trim');
		/*
		$frm->set_rules('limit_allmeat', 'ข้อจำกัดการบริโภค (เนื้อสัตว์ทุกชนิด) [Yes=ใช่,No=ไม่ใช่]', 'trim|required');
		$frm->set_rules('limit_pig', 'ข้อจำกัดการบริโภค (หมู) [Yes=ใช่,No=ไม่ใช่]', 'trim|required');
		$frm->set_rules('limit_meat', 'ข้อจำกัดการบริโภค (เนื้อ) [Yes=ใช่,No=ไม่ใช่]', 'trim|required');
		$frm->set_rules('limit_animal', 'ข้อจำกัดการบริโภค (ผลิตภัณฑ์จากสัตว์ เช่นไข่และนม) [Yes=ใช่,No=ไม่ใช่]', 'trim|required');
		$frm->set_rules('limit_seafood', 'ข้อจำกัดการบริโภค (อาหารทะเล) [Yes=ใช่,No=ไม่ใช่]', 'trim|required');
		$frm->set_rules('limit_additives', 'ข้อจำกัดการบริโภค (สารเติมแต่ง เช่น ผงชูรส) [Yes=ใช่,No=ไม่ใช่]', 'trim|required');
		*/
		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');
		$frm->set_message('callback_float_check', '- %s ต้องระบุตัวเลขทศนิยม');
		$frm->set_message('decimal', '- %s ต้องระบุตัวเลขทศนิยม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('title_name');
			$message .= form_error('user_photo');
			$message .= form_error('user_fname');
			$message .= form_error('user_lname');
			$message .= form_error('date_of_birth');
			$message .= form_error('mobile_no');
			$message .= form_error('email_addr');
			$message .= form_error('cus_passwd');
			$message .= form_error('addr');
			$message .= form_error('fag_allow');
			$message .= form_error('org_id');
			$message .= form_error('user_sex');
			$message .= form_error('user_height');
			$message .= form_error('goal_reduce_weight');
			$message .= form_error('reduce_date_start');
			$message .= form_error('reduce_date_end');
			$message .= form_error('goal_increase_weight');
			$message .= form_error('increase_date_start');
			$message .= form_error('increase_date_end');
			$message .= form_error('user_level');
			$message .= form_error('food_intol_exam');
			/*
			$message .= form_error('limit_allmeat');
			$message .= form_error('limit_pig');
			$message .= form_error('limit_meat');
			$message .= form_error('limit_animal');
			$message .= form_error('limit_seafood');
			$message .= form_error('limit_additives');
			*/
			return $message;
		}
	}

	// ------------------------------------------------------------------------

	public function formValidateWithFile()
	{
		$this->load->library('form_validation');
		$frm = $this->form_validation;
		$message = '';
		if (!empty($_FILES['user_photo']['name'])) {
			$this->file_check_name = 'user_photo';
			$frm->set_rules('user_photo', 'รูป', 'callback_file_check');
			if ($frm->run() == FALSE) {
				$message .= form_error('user_photo');
			}
		}
		return $message;
	}
	public function file_check()
	{
		$allowed_mime_type_arr = $this->file_allow_mime;
		$mime = get_mime_by_extension($_FILES[$this->file_check_name]['name']);
		if (isset($_FILES[$this->file_check_name]['name']) && $_FILES[$this->file_check_name]['name'] != '') {
			if (in_array($mime, $allowed_mime_type_arr)) {
				return true;
			} else {
				$this->form_validation->set_message('file_check', '- กรุณาเลือกประเภทไฟล์  ' . implode(" | ", $this->file_allow_type) . ' เท่านั้นครับ');
				return false;
			}
		} else {
			$this->form_validation->set_message('file_check', '- กรุณาเลือกไฟล์ %s');
			return false;
		}
	}
	private function uploadFile($file_name, $dir = '')
	{
		if ($dir != '' && substr($dir, 0, 1) != '/') {
			$dir = '/' . $dir;
		}
		$path = $this->upload_store_path . $dir;
		//เปิดคอนฟิก Auto ชื่อไฟล์ใหม่ด้วย
		$config['upload_path']          = $path;
		$config['allowed_types']        = $this->file_allow_type;
		$config['encrypt_name']		= TRUE;
		$this->load->library('upload', $config);
		if ($this->upload->do_upload($file_name)) {
			$encrypt_name = $this->upload->file_name;
			$orig_name = $this->upload->orig_name;
			$this->FileUpload->create($encrypt_name, $orig_name);
			$file_path = $path . '/' . $encrypt_name; //ไม่ต้องใช้ Path เต็ม
			$data = array(
				'result' => TRUE,
				'file_path' => $file_path,
				'error' => ''
			);
		} else {
			$data = array(
				'result' => FALSE,
				'error' => $this->upload->display_errors()
			);
		}
		return $data;
	}
	private function removeFile($file_path)
	{
		if ($file_path != '') {
			if (file_exists($file_path)) {
				unlink($file_path);
			}
		}
	}
	/**
	 * Create new record
	 */
	public function save()
	{

		$message = '';
		$message .= $this->formValidateWithFile();
		$message .= $this->formValidate();
		if ($message != '') {
			$json = json_encode(array(
				'is_successful' => FALSE,
				'message' => $message
			));
			echo $json;
		} else {

			$post = $this->input->post(NULL, TRUE);

			$upload_error = 0;
			$upload_error_msg = '';
			$arr = $this->uploadFile('user_photo');
			if ($arr['result'] == TRUE) {
				$post['user_photo'] = $arr['file_path'];
			} else {
				$upload_error++;
				$upload_error_msg .= '<br/>' . print_r($arr['error'], TRUE);
			}
			$encrypt_id = '';
			if ($upload_error == 0) {
				$success = TRUE;

				$rows = array(
					'limit_allmeat' => array('No', 'เนื้อสัตว์ทุกชนิด'),
					'limit_pig' => array('No', 'หมู'),
					'limit_meat' => array('No', 'เนื้อ'),
					'limit_animal' => array('No', 'ผลิตภัณฑ์จากสัตว์ เช่นไข่และนม'),
					'limit_seafood' => array('No', 'อาหารทะเล'),
					'limit_additives' => array('No', 'สารเติมแต่ง เช่น ผงชูรส'),
				);
				foreach ($rows as $key => $value) {
					if (isset($post['limit'][$key])) {
						$post[$key] = 'Yes';
					} else {
						$post[$key] = 'No';
					}
				}
				unset($post['limit']);

				$post1['pro_id'] = $post['pro_id'];
				unset($post['pro_id']);

				$id = $this->Nutritionist->create($post);

				if (count($post1['pro_id'])) {
					$this->load->model("common_model");
					//$this->common_model->update("users_promotions",array('fag_allow'=>'delete',"user_delete"=>get_session("user_id"),'datetime_delete'=>date('Y-m-d H:i:s')),array('user_id'=>$this->session->userdata('shop_id')));
					foreach ($post1['pro_id'] as $key => $value) {
						$this->common_model->insert('users_promotions', array('user_add' => $this->session->userdata('user_id'), 'datetime_add' => date('Y-m-d H:i:s'), 'pro_id' => $value, 'user_id' => $id));
					}
					//$this->common_model->update("shops",array("user_update"=>get_session("user_id"),'datetime_update'=>date('Y-m-d H:i:s')),array('shop_id'=>$this->session->userdata('shop_id')));

				}

				$encrypt_id = encrypt($id);
				$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>';
			} else {
				$success = FALSE;
				$message = $upload_error_msg;
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
			array('title' => 'จัดการข้อมูลส่วนตัว', 'url' => site_url('setting/users')),
			array('title' => 'แก้ไขข้อมูล', 'url' => '#', 'class' => 'active')
		);

		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);

		$this->data['data_id'] = $id;

		$this->load->model("common_model");

		$rows1 = $this->common_model->custom_query("select * from users_exam_hip where fag_allow='allow'  and user_id={$id} order by date_exam");
		$this->data['users_exam_hip'] = "<tr><td>-</td><td>-</td></tr>";
		if (count($rows1)) {
			$this->data['users_exam_hip'] = "";
		}
		foreach ($rows1 as $key => $value) {
			$this->data['users_exam_hip'] .= '<tr><td align="center">' . $value['user_hib'] . '</td><td align="center">' . substr($value['date_exam'], 8, 2) . '/' . substr($value['date_exam'], 5, 2) . '/' . (substr($value['date_exam'], 0, 4) + 543) . '</td></tr>';
		}

		$rows1 = $this->common_model->custom_query("select * from users_exam_weight where fag_allow='allow' and user_id={$id} order by date_exam");
		$this->data['users_exam_weight'] = "<tr><td>-</td><td>-</td></tr>";
		if (count($rows1)) {
			$this->data['users_exam_weight'] = "";
		}
		foreach ($rows1 as $key => $value) {
			$this->data['users_exam_weight'] .= '<tr><td align="center">' . $value['user_weight'] . '</td><td align="center">' . substr($value['date_exam'], 8, 2) . '/' . substr($value['date_exam'], 5, 2) . '/' . (substr($value['date_exam'], 0, 4) + 543) . '</td></tr>';
		}

		$rows1 = $this->common_model->custom_query("select * from users_exam_waistline where fag_allow='allow' and user_id={$id} order by date_exam");
		$this->data['users_exam_waistline'] = "<tr><td>-</td><td>-</td></tr>";
		if (count($rows1)) {
			$this->data['users_exam_waistline'] = "";
		}
		foreach ($rows1 as $key => $value) {
			$this->data['users_exam_waistline'] .= '<tr><td align="center">' . $value['user_waist'] . '</td><td align="center">' . substr($value['date_exam'], 8, 2) . '/' . substr($value['date_exam'], 5, 2) . '/' . (substr($value['date_exam'], 0, 4) + 543) . '</td></tr>';
		}


		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแก้ไขข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Nutritionist->load($id);
			//die(print_r($results));
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->data['csrf_field'] = insert_csrf_field(true);

				$rows = array(
					'limit_allmeat' => array($results['limit_allmeat'], 'เนื้อสัตว์ทุกชนิด'),
					'limit_pig' => array($results['limit_pig'], 'หมู'),
					'limit_meat' => array($results['limit_meat'], 'เนื้อ'),
					'limit_animal' => array($results['limit_animal'], 'ผลิตภัณฑ์จากสัตว์ เช่นไข่และนม'),
					'limit_seafood' => array($results['limit_seafood'], 'อาหารทะเล'),
					'limit_additives' => array($results['limit_additives'], 'สารเติมแต่ง เช่น ผงชูรส'),
				);
				$tmp_data = '<div class="form-row justify-content-start">';
				foreach ($rows as $key => $value) {
					$selected = '';
					//if($value[0]=='Yes')continue;
					if ($value[0] == 'Yes') {
						$selected = 'checked';
					}
					// $tmp_data = $tmp_data."<div onclick=\"if($('.{$key}:checked').length==0)".'{'."$('.{$key}').prop('checked',true);".'}'."else ".'{'."$('.{$key}').prop('checked',false);".'}'."\" class='col-sm-12 col-md-4'><label class='chk col-sm-12 control-label' for=''>&nbsp;&nbsp;&nbsp;{$value[1]}</label><input style='margin-top: -40px;' type='checkbox' class='form-control {$key}' name='limit[{$key}]' value='{$value[0]}' {$selected}></div>";
					$tmp_data = $tmp_data . "<div onclick=\"if($('.{$key}:checked').length==0)" . '{' . "$('.{$key}').prop('checked',true);" . '}' . "else " . '{' . "$('.{$key}').prop('checked',false);" . '}' . "\" class='form-group col-md-4'><div class='form-check'><label class='form-check-label'><input class='form-check-input {$key}' name='limit[{$key}]' value='{$value[0]}' {$selected} type='checkbox'> {$value[1]} <span class='form-check-sign'><span class='check'></span></span></label></div></div>";
				}
				$this->data['limit'] = $tmp_data . '</div>';

				$this->data['display'] = ($results['user_level'] == 'shop' ? 'style="display: none"' : '');

				$this->data['promotions1'] = "";
				$this->data['promotions2'] = "";

				$rows1 = $this->common_model->custom_query("select * from users_promotions as b where b.fag_allow='allow' and b.user_id={$id}");
				$setSelect = array();
				if (isset($rows1)) {
					foreach ($rows1 as $key => $value) {
						$setSelect[$value['pro_id']] = 'Yes';
					}
				}

				$rows = $this->common_model->custom_query("select * from promotions as a where a.fag_allow='allow' and pro_type='credit_cart' order by a.pro_name");
				$tmp_data = '<div class="form-row justify-content-start">';
				foreach ($rows as $key => $value) {
					$selected = '';
					//if($value['b_fag_allow']=='delete')continue;
					$pro_discount = 0;
					if (isset($setSelect[$value['pro_id']])) {
						$selected = 'checked';
					}
					// $tmp_data = $tmp_data."<div onclick=\"if($('.pro_id{$value['pro_id']}:checked').length==0)".'{'."$('.pro_id{$value['pro_id']}').prop('checked',true);".'}'."else ".'{'."$('.pro_id{$value['pro_id']}').prop('checked',false);".'}'."\" class='col-sm-12 col-md-4'><label class='chk col-sm-12 control-label' for=''>&nbsp;&nbsp;&nbsp;{$value['pro_name']}</label><input style='margin-top: -40px;'  type='checkbox' class='form-control pro_id{$value['pro_id']}' name='pro_id[{$value['pro_id']}]' value='{$value['pro_id']}' {$selected}></div>";
					$tmp_data = $tmp_data . "<div onclick=\"if($('.pro_id{$value['pro_id']}:checked').length==0)" . '{' . "$('.pro_id{$value['pro_id']}').prop('checked',true);" . '}' . "else " . '{' . "$('.pro_id{$value['pro_id']}').prop('checked',false);" . '}' . "\"  class='form-group col-md-4'><div class='form-check'><label class='form-check-label'><input class='form-check-input {$value['pro_id']}' name='pro_id[{$value['pro_id']}]' value='{$value['pro_id']}' {$selected} type='checkbox'> {$value['pro_name']} <span class='form-check-sign'><span class='check'></span></span></label></div></div>";
				}
				$tmp_data .= "</div>";
				$this->data['promotions1'] = $tmp_data;

				$rows = $this->common_model->custom_query("select * from promotions as a where a.fag_allow='allow' and pro_type='mobile_chanel' order by a.pro_name");

				$tmp_data = '<div class="form-row justify-content-start">';
				foreach ($rows as $key => $value) {
					$selected = '';
					//if($value['b_fag_allow']=='delete')continue;
					$pro_discount = 0;
					if (isset($setSelect[$value['pro_id']])) {
						$selected = 'checked';
					}
					// $tmp_data = $tmp_data."<div onclick=\"if($('.pro_id{$value['pro_id']}:checked').length==0)".'{'."$('.pro_id{$value['pro_id']}').prop('checked',true);".'}'."else ".'{'."$('.pro_id{$value['pro_id']}').prop('checked',false);".'}'."\" class='col-sm-12 col-md-4'><label class='chk col-sm-12 control-label' for=''>&nbsp;&nbsp;&nbsp;{$value['pro_name']}</label><input style='margin-top: -40px;'  type='checkbox' class='form-control pro_id{$value['pro_id']}' name='pro_id[{$value['pro_id']}]' value='{$value['pro_id']}' {$selected}></div>";
					$tmp_data = $tmp_data . "<div onclick=\"if($('.pro_id{$value['pro_id']}:checked').length==0)" . '{' . "$('.pro_id{$value['pro_id']}').prop('checked',true);" . '}' . "else " . '{' . "$('.pro_id{$value['pro_id']}').prop('checked',false);" . '}' . "\"  class='form-group col-md-4'><div class='form-check'><label class='form-check-label'><input class='form-check-input {$value['pro_id']}' name='pro_id[{$value['pro_id']}]' value='{$value['pro_id']}' {$selected} type='checkbox'> {$value['pro_name']} <span class='form-check-sign'><span class='check'></span></span></label></div></div>";
				}
				$tmp_data .= "</div>";
				$this->data['promotions2'] = $tmp_data;

				$this->setPreviewFormat($results);
				$this->data['user_sexชาย'] =  ($results['user_sex'] == 'ชาย') ? 'checked' : '';
				$this->data['user_sexหญิง'] =  ($results['user_sex'] == 'หญิง') ? 'checked' : '';
				$this->data['user_sexไม่ระบุ'] =  ($results['user_sex'] == 'ไม่ระบุ') ? 'checked' : '';
				$this->data['users_user_delete_option_list'] = $this->Nutritionist->returnOptionList("users", "user_id", "user_fname");
				$this->data['users_user_add_option_list'] = $this->Nutritionist->returnOptionList("users", "user_id", "user_fname");
				$this->data['users_user_update_option_list'] = $this->Nutritionist->returnOptionList("users", "user_id", "user_fname");
				$this->data['organizations_org_id_option_list'] = $this->Nutritionist->returnOptionList("organizations", "org_id", "org_name");

				$this->render_view('setting/users/edit_view');
			}
		}
	}

	// ------------------------------------------------------------------------
	public function checkRecordKey($data)
	{
		$error = '';
		$user_id = ci_decrypt($data['encrypt_user_id']);
		if ($user_id == '') {
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
		$message .= $this->formValidateWithFile();
		$message .= $this->formValidateUpdate();
		/*
		$edit_remark = $this->input->post('edit_remark', TRUE);
		if ($edit_remark == '') {
			$message .= 'ระบุเหตุผล';
		}
		*/

		$post = $this->input->post(NULL, TRUE);
		// echo "<pre>"; print_r($post); echo "</pre>"; exit();
		$error_pk_id = $this->checkRecordKey($post);

		$encrypt_id = urldecode($post['encrypt_user_id']);
		$id = decrypt($encrypt_id);

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

			$upload_error = 0;
			$upload_error_msg = '';
			if (!empty($_FILES['user_photo']['name'])) {
				$arr = $this->uploadFile('user_photo');
				if ($arr['result'] == TRUE) {
					$post['user_photo'] = $arr['file_path'];
					$this->removeFile($post['user_photo_old_path']);
					$arr = explode('/', $post['user_photo_old_path']);
					$encrypt_name = end($arr);
					$this->FileUpload->delete($encrypt_name);
				} else {
					$upload_error++;
					$upload_error_msg .= '<br/>' . print_r($arr['error'], TRUE);
				}
			}

			if ($upload_error == 0) {

				$rows = array(
					'limit_allmeat' => array('No', 'เนื้อสัตว์ทุกชนิด'),
					'limit_pig' => array('No', 'หมู'),
					'limit_meat' => array('No', 'เนื้อ'),
					'limit_animal' => array('No', 'ผลิตภัณฑ์จากสัตว์ เช่นไข่และนม'),
					'limit_seafood' => array('No', 'อาหารทะเล'),
					'limit_additives' => array('No', 'สารเติมแต่ง เช่น ผงชูรส'),
				);
				foreach ($rows as $key => $value) {
					if (isset($post['limit'][$key])) {
						$post[$key] = 'Yes';
					} else {
						$post[$key] = 'No';
					}
				}
				unset($post['limit']);

				if (count(@$post['pro_id'])) {
					$this->load->model("common_model");

					$this->common_model->update("users_promotions", array('fag_allow' => 'delete', "user_delete" => get_session("user_id"), 'datetime_delete' => date('Y-m-d H:i:s')), array('user_id' => $id));
					foreach ($post['pro_id'] as $key => $value) {
						$this->common_model->insert('users_promotions', array('user_add' => $this->session->userdata('user_id'), 'datetime_add' => date('Y-m-d H:i:s'), 'pro_id' => $value, 'user_id' => $id));
					}

					//$this->common_model->update("users",array("user_update"=>get_session("user_id"),'datetime_update'=>date('Y-m-d H:i:s')),array('user_id'=>$id));

				}
				unset($post['pro_id']);

				$result = $this->Nutritionist->update($post);
				if ($result == false) {
					$message = $this->Nutritionist->error_message;
					$ok = FALSE;
				} else {
					$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>' . $this->Nutritionist->error_message;
					$ok = TRUE;
				}
			} else {
				$ok = FALSE;
				$message = $upload_error_msg;
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
			$result = $this->Nutritionist->delete($post);
			if ($result == false) {
				$message = $this->Nutritionist->error_message;
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
			$pk1 = $data[$i]['user_id'];
			$data[$i]['url_encrypt_id'] = urlencode(encrypt($pk1));

			if ($pk1 != '') {
				$pk1 = encrypt($pk1);
			}
			$data[$i]['encrypt_user_id'] = $pk1;
			$data[$i]['preview_fag_allow'] = $this->setFagAllowSubject($data[$i]['fag_allow']);
			$data[$i]['preview_user_sex'] = $this->setUserSexSubject($data[$i]['user_sex']);
			$data[$i]['preview_user_level'] = $this->setUserLevelSubject($data[$i]['user_level']);
			$data[$i]['preview_food_intol_exam'] = $this->setFoodIntolExamSubject($data[$i]['food_intol_exam']);
			$data[$i]['preview_limit_allmeat'] = $this->setLimitAllmeatSubject($data[$i]['limit_allmeat']);
			$data[$i]['preview_limit_pig'] = $this->setLimitPigSubject($data[$i]['limit_pig']);
			$data[$i]['preview_limit_meat'] = $this->setLimitMeatSubject($data[$i]['limit_meat']);
			$data[$i]['preview_limit_animal'] = $this->setLimitAnimalSubject($data[$i]['limit_animal']);
			$data[$i]['preview_limit_seafood'] = $this->setLimitSeafoodSubject($data[$i]['limit_seafood']);
			$data[$i]['preview_limit_additives'] = $this->setLimitAdditivesSubject($data[$i]['limit_additives']);
			$data[$i]['date_of_birth'] = setThaiDate($data[$i]['date_of_birth']);
			$data[$i]['datetime_delete'] = setThaiDate($data[$i]['datetime_delete']);
			$data[$i]['datetime_add'] = setThaiDate($data[$i]['datetime_add']);
			$data[$i]['datetime_update'] = setThaiDate($data[$i]['datetime_update']);
			$data[$i]['user_height'] = number_format($data[$i]['user_height'], 2);
			$data[$i]['goal_reduce_weight'] = number_format($data[$i]['goal_reduce_weight'], 2);
			$data[$i]['reduce_date_start'] = setThaiDate($data[$i]['reduce_date_start']);
			$data[$i]['reduce_date_end'] = setThaiDate($data[$i]['reduce_date_end']);
			$data[$i]['goal_increase_weight'] = number_format($data[$i]['goal_increase_weight'], 2);
			$data[$i]['increase_date_start'] = setThaiDate($data[$i]['increase_date_start']);
			$data[$i]['increase_date_end'] = setThaiDate($data[$i]['increase_date_end']);
			$arr = explode('/', $data[$i]['user_photo']);
			$encrypt_file_name = end($arr);
			$filename = $this->Nutritionist->getValueOf('tb_uploads_filename', 'filename', "encrypt_name = '$encrypt_file_name'", $this->db);
			$data[$i]['preview_user_photo'] = setAttachLink('user_photo', $data[$i]['user_photo'], $filename);
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

	/**
	 * SET choice subject
	 */
	private function setUserSexSubject($value)
	{
		$subject = '';
		switch ($value) {
			case 'ชาย':
				$subject = 'ชาย';
				break;
			case 'หญิง':
				$subject = 'หญิง';
				break;
			case 'ไม่ระบุ':
				$subject = 'ไม่ระบุ';
				break;
		}
		return $subject;
	}

	/**
	 * SET choice subject
	 */
	private function setUserLevelSubject($value)
	{
		$subject = '';
		switch ($value) {
			case 'admin':
				$subject = 'ผู้ดูแลระบบ';
				break;
			case 'super_user':
				$subject = 'Super User';
				break;
			case 'user':
				$subject = 'สมาชิก';
				break;
			case 'shop':
				$subject = 'ร้านค้า';
				break;
			case 'nutritionist':
				$subject = 'นักโภชนาการ';
				break;
		}
		return $subject;
	}

	/**
	 * SET choice subject
	 */
	private function setFoodIntolExamSubject($value)
	{
		$subject = '';
		switch ($value) {
			case 'Yes':
				$subject = 'ใช่';
				break;
			case 'No':
				$subject = 'ไม่ใช่';
				break;
		}
		return $subject;
	}

	/**
	 * SET choice subject
	 */
	private function setLimitAllmeatSubject($value)
	{
		$subject = '';
		switch ($value) {
			case 'Yes':
				$subject = 'ใช่';
				break;
			case 'No':
				$subject = 'ไม่ใช่';
				break;
		}
		return $subject;
	}

	/**
	 * SET choice subject
	 */
	private function setLimitPigSubject($value)
	{
		$subject = '';
		switch ($value) {
			case 'Yes':
				$subject = 'ใช่';
				break;
			case 'No':
				$subject = 'ไม่ใช่';
				break;
		}
		return $subject;
	}

	/**
	 * SET choice subject
	 */
	private function setLimitMeatSubject($value)
	{
		$subject = '';
		switch ($value) {
			case 'Yes':
				$subject = 'ใช่';
				break;
			case 'No':
				$subject = 'ไม่ใช่';
				break;
		}
		return $subject;
	}

	/**
	 * SET choice subject
	 */
	private function setLimitAnimalSubject($value)
	{
		$subject = '';
		switch ($value) {
			case 'Yes':
				$subject = 'ใช่';
				break;
			case 'No':
				$subject = 'ไม่ใช่';
				break;
		}
		return $subject;
	}

	/**
	 * SET choice subject
	 */
	private function setLimitSeafoodSubject($value)
	{
		$subject = '';
		switch ($value) {
			case 'Yes':
				$subject = 'ใช่';
				break;
			case 'No':
				$subject = 'ไม่ใช่';
				break;
		}
		return $subject;
	}

	/**
	 * SET choice subject
	 */
	private function setLimitAdditivesSubject($value)
	{
		$subject = '';
		switch ($value) {
			case 'Yes':
				$subject = 'ใช่';
				break;
			case 'No':
				$subject = 'ไม่ใช่';
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

		if ($pk1 != '') {
			$pk1 = encrypt($pk1);
		}
		$this->data['encrypt_user_id'] = $pk1;


		$userDeleteUserFname = $this->Nutritionist->getValueOf('users', 'user_fname', "user_id = '$data[user_delete]'");
		$this->data['userDeleteUserFname'] = $userDeleteUserFname;


		$userAddUserFname = $this->Nutritionist->getValueOf('users', 'user_fname', "user_id = '$data[user_add]'");
		$this->data['userAddUserFname'] = $userAddUserFname;


		$userUpdateUserFname = $this->Nutritionist->getValueOf('users', 'user_fname', "user_id = '$data[user_update]'");
		$this->data['userUpdateUserFname'] = $userUpdateUserFname;


		$orgIdOrgName = $this->Nutritionist->getValueOf('organizations', 'org_name', "org_id = '$data[org_id]'");
		$this->data['orgIdOrgName'] = $orgIdOrgName;

		$this->data['record_user_id'] = $data['user_id'];
		$this->data['record_title_name'] = $data['title_name'];
		$this->data['record_user_photo'] = $data['user_photo'];

		$arr = explode('/', $data['user_photo']);
		$encrypt_name = end($arr);
		$filename = $this->Nutritionist->getValueOf('tb_uploads_filename', 'filename', "encrypt_name = '$encrypt_name'", $this->db);
		$this->data['record_user_photo_label'] = $filename;
		$this->data['record_user_status'] = $data['user_status'];
		$this->data['preview_user_photo'] = setAttachPreview('user_photo', $data['user_photo'], $filename);
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
		$this->data['preview_fag_allow'] = $this->setFagAllowSubject($data['fag_allow']);
		$this->data['record_fag_allow'] = $data['fag_allow'];
		$this->data['record_org_id'] = $data['org_id'];
		$this->data['preview_user_sex'] = $this->setUserSexSubject($data['user_sex']);
		$this->data['record_user_sex'] = $data['user_sex'];
		$this->data['record_user_height'] = $data['user_height'];
		$this->data['record_goal_reduce_weight'] = $data['goal_reduce_weight'];
		$this->data['record_reduce_date_start'] = $data['reduce_date_start'];
		$this->data['record_reduce_date_end'] = $data['reduce_date_end'];
		$this->data['record_goal_increase_weight'] = $data['goal_increase_weight'];
		$this->data['record_increase_date_start'] = $data['increase_date_start'];
		$this->data['record_increase_date_end'] = $data['increase_date_end'];
		$this->data['preview_user_level'] = $this->setUserLevelSubject($data['user_level']);
		$this->data['record_user_level'] = $data['user_level'];
		$this->data['record_user_status'] = $data['user_status'];
		$this->data['preview_food_intol_exam'] = $this->setFoodIntolExamSubject($data['food_intol_exam']);
		$this->data['record_food_intol_exam'] = $data['food_intol_exam'];
		$this->data['preview_limit_allmeat'] = $this->setLimitAllmeatSubject($data['limit_allmeat']);
		$this->data['record_limit_allmeat'] = $data['limit_allmeat'];
		$this->data['preview_limit_pig'] = $this->setLimitPigSubject($data['limit_pig']);
		$this->data['record_limit_pig'] = $data['limit_pig'];
		$this->data['preview_limit_meat'] = $this->setLimitMeatSubject($data['limit_meat']);
		$this->data['record_limit_meat'] = $data['limit_meat'];
		$this->data['preview_limit_animal'] = $this->setLimitAnimalSubject($data['limit_animal']);
		$this->data['record_limit_animal'] = $data['limit_animal'];
		$this->data['preview_limit_seafood'] = $this->setLimitSeafoodSubject($data['limit_seafood']);
		$this->data['record_limit_seafood'] = $data['limit_seafood'];
		$this->data['preview_limit_additives'] = $this->setLimitAdditivesSubject($data['limit_additives']);
		$this->data['record_limit_additives'] = $data['limit_additives'];

		$this->data['record_date_of_birth'] = setThaiDate($data['date_of_birth']);
		$this->data['record_datetime_delete'] = setThaiDate($data['datetime_delete']);
		$this->data['record_datetime_add'] = setThaiDate($data['datetime_add']);
		$this->data['record_datetime_update'] = setThaiDate($data['datetime_update']);
		$this->data['record_user_height'] = number_format($data['user_height'], 2);
		$this->data['record_goal_reduce_weight'] = number_format($data['goal_reduce_weight'], 2);
		$this->data['record_reduce_date_start'] = setThaiDate($data['reduce_date_start']);
		$this->data['record_reduce_date_end'] = setThaiDate($data['reduce_date_end']);
		$this->data['record_goal_increase_weight'] = number_format($data['goal_increase_weight'], 2);
		$this->data['record_increase_date_start'] = setThaiDate($data['increase_date_start']);
		$this->data['record_increase_date_end'] = setThaiDate($data['increase_date_end']);
	}
}
/*---------------------------- END Controller Class --------------------------------*/
