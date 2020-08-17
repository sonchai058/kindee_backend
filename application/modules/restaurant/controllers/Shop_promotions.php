<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Shop_promotions.php ]
 */
class Shop_promotions extends CRUD_Controller
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
		$this->load->model('restaurant/Shop_promotions_model', 'Shop_promotions');
		$this->load->model('FileUpload_model', 'FileUpload');
		$this->data['page_url'] = site_url('restaurant/shop_promotions');

		$this->data['page_title'] = 'โปรโมชั่น';
		$this->upload_store_path = './assets/uploads/shop_promotions/';
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
		$js_url = 'assets/js_modules/restaurant/shop_promotions.js?ft=' . filemtime('assets/js_modules/restaurant/shop_promotions.js');
		$this->another_js = '<script src="' . base_url($js_url) . '"></script>';
	}

	// ------------------------------------------------------------------------

	/**
	 * Index of controller
	 */

	public function editpro_save()
	{
		$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>';
		$success = TRUE;

		$post = $this->input->post(NULL, TRUE);
		$get_valur = $post['other'];


		if (count(@$post['pro_id'])) {
			$this->load->model("common_model");

			$this->common_model->update("shop_promotions", array('fag_allow' => 'delete', "user_delete" => get_session("user_id"), 'datetime_delete' => date('Y-m-d H:i:s')), array('shop_id' => $this->session->userdata('shop_id')));
			foreach ($post['pro_id'] as $key => $value) {
				$this->common_model->insert('shop_promotions', array('pro_discount' => ($post['pro_discount'][$value] != '' ? $post['pro_discount'][$value] : 0), 'other' => $post['other'], 'user_add' => $this->session->userdata('user_id'), 'datetime_add' => date('Y-m-d H:i:s'), 'pro_id' => $value, 'shop_id' => $this->session->userdata('shop_id')));
			}

			$this->common_model->update("shops", array("user_update" => get_session("user_id"), 'datetime_update' => date('Y-m-d H:i:s')), array('shop_id' => $this->session->userdata('shop_id')));
		} else {
			$success = FALSE;
			$message = "ไม่พบข้อมูลบันทึก!";
		}

		$json = json_encode(array(
			'is_successful' => $success,
			//'encrypt_id' =>  $encrypt_id,
			'message' => $message
		));
		echo $json;
	}
	public function editpro()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
			array('title' => 'ข้อมูลโปรโมชั่น', 'url' => site_url('restaurant/shop_promotions/editpro')),
			array('title' => 'จัดการข้อมูลโปรโมชั่น', 'url' => '#', 'class' => 'active')
		);

		$id = $this->session->userdata('user_id');

		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแก้ไขข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$this->load->model("common_model");

			$rows1 = $this->common_model->custom_query("select * from shop_promotions as b where b.fag_allow='allow' and b.shop_id={$this->session->userdata('shop_id')}");
			$setSelect = array();
			foreach ($rows1 as $key => $value) {
				$setSelect[$value['pro_id']] = $value['pro_discount'];
			}

			$rows = $this->common_model->custom_query("select * from promotions as a where a.fag_allow='allow' and pro_type='credit_cart' order by a.pro_name");
			$tmp_data = '<div class="form-row justify-content-start">' . "<div class='col-sm-12 col-md-6' style='padding: 0px 15px 0px 15px'><div class='row'><div  class='col-6' style='color:#868787'>บัตรเครดิต</div><div class='col-6' style='color:#868787'>ส่วนลด</div></div></br>";

			foreach ($rows as $key => $value) {
				$selected = '';
				//if($value['b_fag_allow']=='delete')continue;
				$pro_discount = 0;
				if (isset($setSelect[$value['pro_id']])) {
					$selected = 'checked';
					$pro_discount = $setSelect[$value['pro_id']];
				}
				$tmp_data = $tmp_data . "<div class='row'><div onclick=\"if($('.pro_id{$value['pro_id']}:checked').length==0)" . '{' . "$('.pro_id{$value['pro_id']}').prop('checked',true);" . '}' . "else " . '{' . "$('.pro_id{$value['pro_id']}').prop('checked',false);" . '}' . "\" class='col-6' style='height: 30px'><div class='form-check'><label class='form-check-label'><input class='form-check-input pro_id{$value['pro_id']}' name='pro_id[{$value['pro_id']}]'  value='{$value['pro_id']}' {$selected} type='checkbox'> {$value['pro_name']} <span class='form-check-sign'><span class='check'></span></span></label></div></div>";
				$tmp_data = $tmp_data . "<div class='col-6'><div class='has-warning'><input type='text' class='form-control' value='{$pro_discount}' onkeypress=\"$('.pro_id{$value['pro_id']}').prop('checked',true);\" name='pro_discount[{$value['pro_id']}]'></div></div></div>";

				//$tmp_data = $tmp_data."<div class='row'><div onclick=\"if($('.pro_id{$value['pro_id']}:checked').length==0)".'{'."$('.pro_id{$value['pro_id']}').prop('checked',true);".'}'."else ".'{'."$('.pro_id{$value['pro_id']}').prop('checked',false);".'}'."\" class='col-6'><label class='chk col-sm-12 control-label' for=''>&nbsp;&nbsp;&nbsp;{$value['pro_name']}</label><input style='margin-top: -40px;'  type='checkbox' class='form-control pro_id{$value['pro_id']}' name='pro_id[{$value['pro_id']}]' value='{$value['pro_id']}' {$selected}></div>";
				// $tmp_data = $tmp_data."<div  class='col-6'><input type='number' step='0.01' value='{$pro_discount}' onkeypress=\"$('.pro_id{$value['pro_id']}').prop('checked',true);\" name='pro_discount[{$value['pro_id']}]'></div></div>";

			}

			$tmp_data .= "</div><div class='col-sm-12 col-md-6' style='padding: 0px 15px 0px 15px'><div class='row'><div  class='col-6' style='color:#868787'>เครือข่ายมือถือ</div><div  class='col-6' style='color:#868787'>ส่วนลด</div></div></br>";

			$rows = $this->common_model->custom_query("select * from promotions as a where a.fag_allow='allow' and pro_type='mobile_chanel' order by a.pro_name");

			foreach ($rows as $key => $value) {
				$selected = '';
				//if($value['b_fag_allow']=='delete')continue;
				$pro_discount = 0;
				if (isset($setSelect[$value['pro_id']])) {
					$selected = 'checked';
					$pro_discount = $setSelect[$value['pro_id']];
				}
				$tmp_data = $tmp_data . "<div class='row'><div onclick=\"if($('.pro_id{$value['pro_id']}:checked').length==0)" . '{' . "$('.pro_id{$value['pro_id']}').prop('checked',true);" . '}' . "else " . '{' . "$('.pro_id{$value['pro_id']}').prop('checked',false);" . '}' . "\" class='col-6' style='height: 30px'><div class='form-check'><label class='form-check-label'><input class='form-check-input pro_id{$value['pro_id']}' name='pro_id[{$value['pro_id']}]'  value='{$value['pro_id']}' {$selected} type='checkbox'> {$value['pro_name']} <span class='form-check-sign'><span class='check'></span></span></label></div></div>";
				$tmp_data = $tmp_data . "<div class='col-6'><div class='has-warning'><input type='text' class='form-control' value='{$pro_discount}' onkeypress=\"$('.pro_id{$value['pro_id']}').prop('checked',true);\" name='pro_discount[{$value['pro_id']}]'></div></div></div>";
			}

			$resultOther = $this->common_model->custom_query("select other from shop_promotions  where shop_id = {$this->session->userdata('shop_id')} and fag_allow = 'allow'");
			foreach ($resultOther as $key => $value) {
				$other_data = $value['other'];
			}

			$this->data['rows'] = json_encode($rows);
			$this->data['results'] = $tmp_data . "</div></div>";
			@$this->data['other'] = $other_data;
			$this->data['csrf_field'] = insert_csrf_field(true);
			$this->render_view('restaurant/shop_promotions/promotions');
		}
	}

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
		$this->session->unset_userdata($this->Shop_promotions->session_name . '_search_field');
		$this->session->unset_userdata($this->Shop_promotions->session_name . '_value');

		$this->search();
	}

	// ------------------------------------------------------------------------

	/**
	 * Search data
	 */
	public function search()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
			array('title' => 'ข้อมูลโปรโมชั่น', 'class' => 'active', 'url' => '#'),
		);
		if (isset($_POST['submit'])) {
			$search_field =  $this->input->post('search_field', TRUE);
			$value = $this->input->post('txtSearch', TRUE);
			$arr = array($this->Shop_promotions->session_name . '_search_field' => $search_field, $this->Shop_promotions->session_name . '_value' => $value);
			$this->session->set_userdata($arr);
		} else {
			$search_field = $this->session->userdata($this->Shop_promotions->session_name . '_search_field');
			$value = $this->session->userdata($this->Shop_promotions->session_name . '_value');
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
			$this->Shop_promotions->order_field = $field;
			$this->Shop_promotions->order_sort = $sort;
		}
		$results = $this->Shop_promotions->read($start_row, $per_page);
		$total_row = $results['total_row'];
		$search_row = $results['search_row'];
		$list_data = $this->setDataListFormat($results['list_data'], $start_row);


		$page_url = site_url('restaurant/shop_promotions');
		$pagination = $this->create_pagination($page_url . '/search', $search_row);
		$end_row = $start_row + $per_page;
		if ($search_row < $per_page) {
			$end_row = $search_row;
		}

		if ($end_row > $search_row) {
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

		$this->render_view('restaurant/shop_promotions/list_view');
	}

	// ------------------------------------------------------------------------

	/**
	 * Preview Data
	 * @param String encrypt id
	 */
	public function preview($encrypt_id = "")
	{
		$this->breadcrumb_data['breadcrumb'] = array(
			array('title' => 'ข้อมูลโปรโมชั่น', 'url' => site_url('restaurant/shop_promotions')),
			array('title' => 'แสดงข้อมูลรายละเอียด', 'url' => '#', 'class' => 'active')
		);
		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแสดงข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Shop_promotions->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->setPreviewFormat($results);
				$this->render_view('restaurant/shop_promotions/preview_view');
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
			array('title' => 'ข้อมูลโปรโมชั่น', 'url' => site_url('restaurant/shop_promotions')),
			array('title' => 'เพิ่มข้อมูล', 'url' => '#', 'class' => 'active')
		);
		$this->data['users_user_update_option_list'] = $this->Shop_promotions->returnOptionList("users", "user_id", "user_fname");
		$this->data['preview_shop_photo'] = '<div id="div_preview_shop_photo" class="py-3 div_file_preview" style="clear:both"><img id="shop_photo_preview" height="300"/></div>';
		$this->data['record_shop_photo_label'] = '';
		$this->render_view('restaurant/shop_promotions/add_view');
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

		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('user_update');
			$message .= form_error('datetime_update');
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

		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('user_update');
			$message .= form_error('datetime_update');
			return $message;
		}
	}

	// ------------------------------------------------------------------------

	public function formValidateWithFile()
	{
		$this->load->library('form_validation');
		$frm = $this->form_validation;
		$message = '';
		if (!empty($_FILES['shop_photo']['name'])) {
			$this->file_check_name = 'shop_photo';
			$frm->set_rules('shop_photo', 'รูปโปรไฟล์', 'callback_file_check');
			if ($frm->run() == FALSE) {
				$message .= form_error('shop_photo');
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
		$path = $this->upload_store_path . (date('Y') + 543) . $dir;
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
			$arr = $this->uploadFile('shop_photo');
			if ($arr['result'] == TRUE) {
				$post['shop_photo'] = $arr['file_path'];
			} else {
				$upload_error++;
				$upload_error_msg .= '<br/>' . print_r($arr['error'], TRUE);
			}
			$encrypt_id = '';
			if ($upload_error == 0) {
				$success = TRUE;
				$id = $this->Shop_promotions->create($post);
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
			array('title' => 'ข้อมูลโปรโมชั่น', 'url' => site_url('restaurant/shop_promotions')),
			array('title' => 'แก้ไขข้อมูล', 'url' => '#', 'class' => 'active')
		);

		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแก้ไขข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Shop_promotions->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->data['csrf_field'] = insert_csrf_field(true);


				$this->setPreviewFormat($results);
				$this->data['users_user_update_option_list'] = $this->Shop_promotions->returnOptionList("users", "user_id", "user_fname");
				$this->render_view('restaurant/shop_promotions/edit_view');
			}
		}
	}

	// ------------------------------------------------------------------------
	public function checkRecordKey($data)
	{
		$error = '';
		$shop_id = ci_decrypt($data['encrypt_shop_id']);
		if ($shop_id == '') {
			$error .= '- รหัส shop_id';
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

			$upload_error = 0;
			$upload_error_msg = '';
			if (!empty($_FILES['shop_photo']['name'])) {
				$arr = $this->uploadFile('shop_photo');
				if ($arr['result'] == TRUE) {
					$post['shop_photo'] = $arr['file_path'];
					$this->removeFile($post['shop_photo_old_path']);
					$arr = explode('/', $post['shop_photo_old_path']);
					$encrypt_name = end($arr);
					$this->FileUpload->delete($encrypt_name);
				} else {
					$upload_error++;
					$upload_error_msg .= '<br/>' . print_r($arr['error'], TRUE);
				}
			}

			if ($upload_error == 0) {
				$result = $this->Shop_promotions->update($post);
				if ($result == false) {
					$message = $this->Shop_promotions->error_message;
					$ok = FALSE;
				} else {
					$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>' . $this->Shop_promotions->error_message;
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
			$result = $this->Shop_promotions->delete($post);
			if ($result == false) {
				$message = $this->Shop_promotions->error_message;
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
			$pk1 = $data[$i]['shop_id'];
			$data[$i]['url_encrypt_id'] = urlencode(encrypt($pk1));

			if ($pk1 != '') {
				$pk1 = encrypt($pk1);
			}
			$data[$i]['encrypt_shop_id'] = $pk1;
			$data[$i]['datetime_delete'] = setThaiDate($data[$i]['datetime_delete']);
			$data[$i]['datetime_add'] = setThaiDate($data[$i]['datetime_add']);
			$data[$i]['datetime_update'] = setThaiDate($data[$i]['datetime_update']);
			$arr = explode('/', $data[$i]['shop_photo']);
			$encrypt_file_name = end($arr);
			$filename = $this->Shop_promotions->getValueOf('tb_uploads_filename', 'filename', "encrypt_name = '$encrypt_file_name'", $this->db);
			$data[$i]['preview_shop_photo'] = setAttachLink('shop_photo', $data[$i]['shop_photo'], $filename);
		}
		return $data;
	}

	/**
	 * SET array data list
	 */
	private function setPreviewFormat($row_data)
	{
		$data = $row_data;

		$pk1 = $data['shop_id'];
		$this->data['recode_url_encrypt_id'] = urlencode(encrypt($pk1));

		if ($pk1 != '') {
			$pk1 = encrypt($pk1);
		}
		$this->data['encrypt_shop_id'] = $pk1;


		$userUpdateUserFname = $this->Shop_promotions->getValueOf('users', 'user_fname', "user_id = '$data[user_update]'");
		$this->data['userUpdateUserFname'] = $userUpdateUserFname;

		$this->data['record_shop_id'] = $data['shop_id'];
		$this->data['record_cate_id'] = $data['cate_id'];
		$this->data['record_shop_photo'] = $data['shop_photo'];

		$arr = explode('/', $data['shop_photo']);
		$encrypt_name = end($arr);
		$filename = $this->Shop_promotions->getValueOf('tb_uploads_filename', 'filename', "encrypt_name = '$encrypt_name'", $this->db);
		$this->data['record_shop_photo_label'] = $filename;

		$this->data['preview_shop_photo'] = setAttachPreview('shop_photo', $data['shop_photo'], $filename);
		$this->data['record_shop_cover'] = $data['shop_cover'];
		$this->data['record_shop_name_th'] = $data['shop_name_th'];
		$this->data['record_shop_name_en'] = $data['shop_name_en'];
		$this->data['record_mobile_no'] = $data['mobile_no'];
		$this->data['record_email_addr'] = $data['email_addr'];
		$this->data['record_shop_user'] = $data['shop_user'];
		$this->data['record_addr'] = $data['addr'];
		$this->data['record_user_delete'] = $data['user_delete'];
		$this->data['record_datetime_delete'] = $data['datetime_delete'];
		$this->data['record_user_add'] = $data['user_add'];
		$this->data['record_datetime_add'] = $data['datetime_add'];
		$this->data['record_user_update'] = $data['user_update'];
		$this->data['record_datetime_update'] = $data['datetime_update'];
		$this->data['record_fag_allow'] = $data['fag_allow'];
		$this->data['record_point_lat'] = $data['point_lat'];
		$this->data['record_point_long'] = $data['point_long'];

		$this->data['record_datetime_delete'] = setThaiDate($data['datetime_delete']);
		$this->data['record_datetime_add'] = setThaiDate($data['datetime_add']);
		$this->data['record_datetime_update'] = setThaiDate($data['datetime_update']);
	}
}
/*---------------------------- END Controller Class --------------------------------*/
