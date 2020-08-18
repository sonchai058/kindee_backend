<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Users.php ]
 */

/**
 * Debug
 * *echo "<pre>"; print_r($arr); echo "</pre>"; exit();
 */
class Register extends CRUD_Controller
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

		$this->per_page = 30;
		$this->num_links = 6;
		$this->uri_segment = 4;
		$this->load->model('register/Register_model', 'Users');
		$this->load->model('FileUpload_model', 'FileUpload');
		$this->upload_store_path = './assets/uploads/users/';
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
		$js_url = 'assets/js_modules/register/user_register.js?ft=' . filemtime('assets/js_modules/register/user_register.js');
		$this->another_js = '<script src="' . base_url($js_url) . '"></script>';
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
		$this->parser->parse('template/majestic/register_view', $this->data);
	}

	/**
	 * Add form
	 */
	public function user_add()
	{
		$this->data['data_id'] = 0;
		$this->data['promotions1'] = "";
		$this->data['promotions2'] = "";
		$this->load->model("common_model");

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
			$pro_discount = 0;
			if (isset($setSelect[$value['pro_id']])) {
				$selected = 'checked';
			}
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


		$tmp_data = "<div class='form-group has-success'>";
		$tmp_data = $tmp_data . "<input type='number' class='form-control ' id='user_weight' name='user_weight' value='' />";
		$tmp_data .= "</div>";
		$this->data['weight'] = $tmp_data;

		$tmp_data = "<div class='form-group has-success'>";
		$tmp_data = $tmp_data . "<input type='number' class='form-control ' id='user_waist' name='user_waist' value='' />";
		$tmp_data .= "</div>";
		$this->data['waist'] = $tmp_data;

		$tmp_data = "<div class='form-group has-success'>";
		$tmp_data = $tmp_data . "<input type='number' class='form-control ' id='user_hib' name='user_hib' value='' />";
		$tmp_data .= "</div>";
		$this->data['hib'] = $tmp_data;


		$this->data['users_user_delete_option_list'] = $this->Users->returnOptionList("users", "user_id", "user_fname");
		$this->data['users_user_add_option_list'] = $this->Users->returnOptionList("users", "user_id", "user_fname");
		$this->data['users_user_update_option_list'] = $this->Users->returnOptionList("users", "user_id", "user_fname");
		$this->data['organizations_org_id_option_list'] = $this->Users->returnOptionList("organizations", "org_id", "org_name");
		$this->data['preview_user_photo'] = '<div id="div_preview_user_photo" class="py-3 div_file_preview" style="clear:both"><img id="user_photo_preview" height="200" width="100%"/></div>';
		$this->data['record_user_photo_label'] = '';
		$this->render_view('register/users/add_view_users');
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
		$frm->set_rules('user_sex', 'เพศ', 'trim|required');
		$frm->set_rules('user_height', 'ส่วนสูง CM', 'trim|required|callback_float_check');
		$frm->set_rules('user_weight', 'น้ำหนัก KG', 'trim|required|callback_float_check');
		$frm->set_rules('user_waist', 'รอบเอว INCH', 'trim|required|callback_float_check');
		$frm->set_rules('user_hib', 'รอบสะโพก INCH', 'trim|required|callback_float_check');

		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('callback_float_check', '- %s ต้องระบุตัวเลขทศนิยม');

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
			$message .= form_error('user_sex');
			$message .= form_error('user_height');
			$message .= form_error('user_weight');
			$message .= form_error('user_waist');
			$message .= form_error('user_hib');

			return $message;
		}
	}

	/**
	 * Default Validation for Update
	 * see also https://www.codeigniter.com/userguide3/libraries/form_validation.html
	 */
	public function float_check($val)
	{
		return TRUE;
	}


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

				$post2['user_weight'] = $post['user_weight'];
				unset($post['user_weight']);

				@$post1['pro_id'] = $post['pro_id'];
				unset($post['pro_id']);

				$post3['user_waist'] = $post['user_waist'];
				unset($post['user_waist']);

				$post4['user_hib'] = $post['user_hib'];
				unset($post['user_hib']);

				$id = $this->Users->create($post);

				if (count($post2['user_weight'])) {
					$this->load->model("common_model");
					$this->common_model->insert('users_exam_weight', array('user_add' => '0', 'date_exam' => date('Y-m-d H:i:s'), 'datetime_add' => date('Y-m-d H:i:s'), 'user_weight' => str_replace(",", "", $post2['user_weight']), 'user_id' => $id));
				}
				if (count($post1['pro_id'])) {
					$this->load->model("common_model");
					foreach ($post1['pro_id'] as $key => $value) {
						$this->common_model->insert('users_promotions', array('user_add' => '0', 'datetime_add' => date('Y-m-d H:i:s'), 'pro_id' => $value, 'user_id' => $id));
					}
				}
				if (count($post3['user_waist'])) {
					$this->load->model("common_model");
					$this->common_model->insert('users_exam_waistline', array('user_add' => '0', 'date_exam' => date('Y-m-d H:i:s'), 'datetime_add' => date('Y-m-d H:i:s'), 'user_waist' => str_replace(",", "", $post3['user_waist']), 'user_id' => $id));
				}
				if (count($post4['user_hib'])) {
					$this->load->model("common_model");
					$this->common_model->insert('users_exam_hip', array('user_add' => '0', 'date_exam' => date('Y-m-d H:i:s'), 'datetime_add' => date('Y-m-d H:i:s'), 'user_hib' => str_replace(",", "", $post4['user_hib']), 'user_id' => $id));
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
}
/*---------------------------- END Controller Class --------------------------------*/
