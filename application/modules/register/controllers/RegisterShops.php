<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Users.php ]
 */

/**
 * Debug
 * *echo "<pre>"; print_r($arr); echo "</pre>"; exit();
 */
class RegisterShops extends CRUD_Controller
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
		$this->load->model('shopdata/Shops_model', 'Shops');
		$this->load->model('FileUpload_model', 'FileUpload');
		$this->data['page_url'] = site_url('shopdata/shops');
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
		$js_url = 'assets/js_modules/register/shop_register.js?ft=' . filemtime('assets/js_modules/register/shop_register.js');
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
	// ------------------------------------------------------------------------

	public function shop_add()
	{
		$this->data['data_id'] = 0;
		$this->data['category_cate_id_option_list'] = $this->Shops->returnOptionList("category", "cate_id", "cate_name");
		$this->data['users_user_delete_option_list'] = $this->Shops->returnOptionList("users", "user_id", "user_fname");
		$this->data['users_user_add_option_list'] = $this->Shops->returnOptionList("users", "user_id", "user_fname");
		$this->data['users_user_update_option_list'] = $this->Shops->returnOptionList("users", "user_id", "user_fname");
		$this->data['organizations_org_id_option_list'] = $this->Shops->returnOptionList("organizations", "org_id", "org_name");
		$this->data['preview_shop_photo'] = '<div id="div_preview_shop_photo" class="py-3 div_file_preview" style="clear:both"><img id="shop_photo_preview" height="300"width="350"/></div>';
		$this->data['record_shop_photo_label'] = '';
		$this->data['preview_shop_cover'] = '<div id="div_preview_shop_cover" class="py-3 div_file_preview" style="clear:both"><img id="shop_cover_preview" height="300"width="350"/></div>';
		$this->data['record_shop_cover_label'] = '';
		$this->render_view('register/shops/add_view_shops');
	}
	/**
	 * Default Validation
	 * see also https://www.codeigniter.com/userguide3/libraries/form_validation.html
	 */

	public function formValidate()
	{
		$this->load->library('form_validation');
		$frm = $this->form_validation;

		$frm->set_rules('cate_id', 'รหัสประเภทร้าน', 'trim|required|is_natural');
		//file upload
		$check_file = FALSE;
		if ($this->input->post('shop_photo_label') == '') {
			$check_file = TRUE;
		}
		if ($check_file == TRUE) {
			if (empty($_FILES['shop_photo']['name'])) {
				$frm->set_rules('shop_photo', 'รูปโปรไฟล์', 'trim|required');
			}
		}
		//file upload
		$check_file = FALSE;
		if ($this->input->post('shop_cover_label') == '') {
			$check_file = TRUE;
		}
		if ($check_file == TRUE) {
			if (empty($_FILES['shop_cover']['name'])) {
				$frm->set_rules('shop_cover', 'รูปปก', 'trim|required');
			}
		}
		$frm->set_rules('shop_name_th', 'ชื่อไทย', 'trim|required');
		$frm->set_rules('shop_name_en', 'ชื่ออังกฤษ', 'trim|required');
		$frm->set_rules('mobile_no', 'เบอร์โทร', 'trim|required');
		$frm->set_rules('email_addr', 'อีเมล', 'trim|required');
		$frm->set_rules('cus_passwd', 'รหัสผ่าน', 'trim|required');
		$frm->set_rules('addr', 'ที่อยู่', 'trim|required');
		$frm->set_rules('fag_allow', 'สถานะ', 'trim');
		$frm->set_rules('point_lat', 'พิกัด ละติจูด', 'trim|required');
		$frm->set_rules('point_long', 'พิกัด ลองจิจูด', 'trim|required');

		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('cate_id');
			$message .= form_error('shop_name_th');
			$message .= form_error('shop_name_en');
			$message .= form_error('shop_photo');
			$message .= form_error('shop_cover');
			$message .= form_error('mobile_no');
			$message .= form_error('email_addr');
			$message .= form_error('cus_passwd');
			$message .= form_error('addr');
			$message .= form_error('fag_allow');
			$message .= form_error('point_lat');
			$message .= form_error('point_long');
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
	}

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
		if (!empty($_FILES['shop_cover']['name'])) {
			$this->file_check_name = 'shop_cover';
			$frm->set_rules('shop_cover', 'รูปปก', 'callback_file_check');
			if ($frm->run() == FALSE) {
				$message .= form_error('shop_cover');
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
			$arr = $this->uploadFile('shop_photo');
			if ($arr['result'] == TRUE) {
				$post['shop_photo'] = $arr['file_path'];
			} else {
				$upload_error++;
				$upload_error_msg .= '<br/>' . print_r($arr['error'], TRUE);
			}
			$arr = $this->uploadFile('shop_cover');
			if ($arr['result'] == TRUE) {
				$post['shop_cover'] = $arr['file_path'];
			} else {
				$upload_error++;
				$upload_error_msg .= '<br/>' . print_r($arr['error'], TRUE);
			}
			$encrypt_id = '';
			if ($upload_error == 0) {
				$success = TRUE;
				$id = $this->Shops->create($post);

				$this->load->model("common_model");
				$user_add = 0;
				$shop_user = $this->common_model->insert(
					'users',
					array(
						'user_add' => $user_add,
						'datetime_add' => date("Y-m-d H:i:s"),
						'fag_allow' => 'allow',
						'shop_id' => $id,
						'user_fname' => $post['shop_name_th'],
						'email_addr' => $post['email_addr'],
						'cus_passwd' => $post['cus_passwd'],
						'mobile_no' => $post['mobile_no'],
						'user_level' => 'shop'
					)
				);

				$shop_user = $this->common_model->update('shops', array('shop_user' => $shop_user), array('shop_id' => $id));

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
