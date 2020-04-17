<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Shops.php ]
 */
class Shops extends CRUD_Controller
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
		$this->load->model('shopdata/Shops_model', 'Shops');
		$this->load->model('FileUpload_model', 'FileUpload');
		$this->data['page_url'] = site_url('shopdata/shops');

		$this->data['page_title'] = 'จัดการร้านอาหาร';
		$this->upload_store_path = './assets/uploads/shops/';
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
		$js_url = 'assets/js_modules/shopdata/shops.js?ft='. filemtime('assets/js_modules/shopdata/shops.js');
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
		$this->session->unset_userdata($this->Shops->session_name . '_search_field');
		$this->session->unset_userdata($this->Shops->session_name . '_value');

		$this->search();
	}

	// ------------------------------------------------------------------------

	/**
	 * Search data
	 */
	public function search()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Shops', 'class' => 'active', 'url' => '#'),
		);
		if (isset($_POST['submit'])) {
			$search_field =  $this->input->post('search_field', TRUE);
			$value = $this->input->post('txtSearch', TRUE);
			$arr = array($this->Shops->session_name . '_search_field' => $search_field, $this->Shops->session_name . '_value' => $value );
			$this->session->set_userdata($arr);
		} else {
			$search_field = $this->session->userdata($this->Shops->session_name . '_search_field');
			$value = $this->session->userdata($this->Shops->session_name . '_value');
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
			$this->Shops->order_field = $field;
			$this->Shops->order_sort = $sort;
		}
		$results = $this->Shops->read($start_row, $per_page);
		$total_row = $results['total_row'];
		$search_row = $results['search_row'];
		$list_data = $this->setDataListFormat($results['list_data'], $start_row);


		$page_url = site_url('shopdata/shops');
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

		$this->render_view('shopdata/shops/list_view');
	}

	// ------------------------------------------------------------------------

	/**
	 * Preview Data
	 * @param String encrypt id
	 */
	public function preview($encrypt_id = "")
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'Shops', 'url' => site_url('shopdata/shops')),
						array('title' => 'แสดงข้อมูลรายละเอียด', 'url' => '#', 'class' => 'active')
		);
		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแสดงข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Shops->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->setPreviewFormat($results);
				$this->render_view('shopdata/shops/preview_view');
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
						array('title' => 'Shops', 'url' => site_url('shopdata/shops')),
						array('title' => 'เพิ่มข้อมูล', 'url' => '#', 'class' => 'active')
		);

		$this->data['count_image'] = 1;
		$this->data['data_id'] = 0;

		$this->data['category_cate_id_option_list'] = $this->Shops->returnOptionList("category", "cate_id", "cate_name");
		$this->data['users_shop_user_option_list'] = $this->Shops->returnOptionList("users", "user_id", "user_fname",array('where'=>'user_level="shop" and shop_id=0'));
		$this->data['users_user_delete_option_list'] = $this->Shops->returnOptionList("users", "user_id", "user_fname");
		$this->data['users_user_add_option_list'] = $this->Shops->returnOptionList("users", "user_id", "user_fname");
		$this->data['users_user_update_option_list'] = $this->Shops->returnOptionList("users", "user_id", "user_fname");
		$this->data['preview_shop_photo'] = '<div id="div_preview_shop_photo" class="py-3 div_file_preview" style="clear:both"><img id="shop_photo_preview" height="300"width="350"/></div>';
		$this->data['record_shop_photo_label'] = '';
		$this->data['preview_shop_cover'] = '<div id="div_preview_shop_cover" class="py-3 div_file_preview" style="clear:both"><img id="shop_cover_preview" height="300"width="350"/></div>';
		$this->data['record_shop_cover_label'] = '';
		$this->render_view('shopdata/shops/add_view');
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

		$frm->set_rules('cate_id', 'รหัสประเภทร้าน', 'trim|required|is_natural');
		//file upload
		$check_file = FALSE;
		if($this->input->post('shop_photo_label') == ''){
			$check_file = TRUE;
		}
		if($check_file == TRUE){
			if(empty($_FILES['shop_photo']['name'])){
				$frm->set_rules('shop_photo', 'รูปโปรไฟล์', 'trim|required');
			}
		}
		//file upload
		$check_file = FALSE;
		if($this->input->post('shop_cover_label') == ''){
			$check_file = TRUE;
		}
		if($check_file == TRUE){
			if(empty($_FILES['shop_cover']['name'])){
				$frm->set_rules('shop_cover', 'รูปปก', 'trim|required');
			}
		}
		$frm->set_rules('shop_name_th', 'ชื่อไทย', 'trim|required');
		$frm->set_rules('shop_name_en', 'ชื่ออังกฤษ', 'trim|required');
		$frm->set_rules('mobile_no', 'มือถือ', 'trim|required');
		$frm->set_rules('email_addr', 'อีเมล', 'trim|required');
		$frm->set_rules('cus_passwd', 'รหัสผ่าน', 'trim|required');
		$frm->set_rules('shop_user', 'รหัสผู้ดูแล', 'trim');
		$frm->set_rules('addr', 'เลขที่ ที่อยู่', 'trim|required');
		$frm->set_rules('fag_allow', 'สถานะ', 'trim');
		$frm->set_rules('point_lat', 'พิกัด ละติจูด', 'trim|required');
		$frm->set_rules('point_long', 'พิกัด ลองจิจูด', 'trim|required');

		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('cate_id');
			$message .= form_error('shop_photo');
			$message .= form_error('shop_cover');
			$message .= form_error('shop_name_th');
			$message .= form_error('shop_name_en');
			$message .= form_error('mobile_no');
			$message .= form_error('email_addr');
			$message .= form_error('cus_passwd');
			$message .= form_error('shop_user');
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
	public function formValidateUpdate()
	{
		$this->load->library('form_validation');
		$frm = $this->form_validation;

		$frm->set_rules('cate_id', 'รหัสประเภทร้าน', 'trim|required|is_natural');
		//file upload
		$check_file = FALSE;
		if($this->input->post('shop_photo_label') == ''){
			$check_file = TRUE;
		}
		if($check_file == TRUE){
			if(empty($_FILES['shop_photo']['name'])){
				$frm->set_rules('shop_photo', 'รูปโปรไฟล์', 'trim|required');
			}
		}
		//file upload
		$check_file = FALSE;
		if($this->input->post('shop_cover_label') == ''){
			$check_file = TRUE;
		}
		if($check_file == TRUE){
			if(empty($_FILES['shop_cover']['name'])){
				$frm->set_rules('shop_cover', 'รูปปก', 'trim|required');
			}
		}
		$frm->set_rules('shop_name_th', 'ชื่อไทย', 'trim|required');
		$frm->set_rules('shop_name_en', 'ชื่ออังกฤษ', 'trim|required');
		$frm->set_rules('mobile_no', 'มือถือ', 'trim|required');
		$frm->set_rules('email_addr', 'อีเมล', 'trim|required');
		$frm->set_rules('cus_passwd', 'รหัสผ่าน', 'trim|required');
		$frm->set_rules('shop_user', 'รหัสผู้ดูแล', 'trim');
		$frm->set_rules('addr', 'เลขที่ ที่อยู่', 'trim|required');
		$frm->set_rules('fag_allow', 'สถานะ', 'trim');
		$frm->set_rules('point_lat', 'พิกัด ละติจูด', 'trim|required');
		$frm->set_rules('point_long', 'พิกัด ลองจิจูด', 'trim|required');

		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('cate_id');
			$message .= form_error('shop_photo');
			$message .= form_error('shop_cover');
			$message .= form_error('shop_name_th');
			$message .= form_error('shop_name_en');
			$message .= form_error('mobile_no');
			$message .= form_error('email_addr');
			$message .= form_error('cus_passwd');
			$message .= form_error('shop_user');
			$message .= form_error('addr');
			$message .= form_error('fag_allow');
			$message .= form_error('point_lat');
			$message .= form_error('point_long');
			return $message;
		}
	}

	// ------------------------------------------------------------------------

	public function formValidateWithFile()
	{
		$this->load->library('form_validation');
		$frm = $this->form_validation;
		$message = '';
		if(!empty($_FILES['shop_photo']['name'])){
			$this->file_check_name = 'shop_photo';
			$frm->set_rules('shop_photo', 'รูปโปรไฟล์', 'callback_file_check');
			if ($frm->run() == FALSE) {
				$message .= form_error('shop_photo');
			}
		}
		if(!empty($_FILES['shop_cover']['name'])){
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
		if(isset($_FILES[$this->file_check_name]['name']) && $_FILES[$this->file_check_name]['name']!=''){
			if(in_array($mime, $allowed_mime_type_arr)){
				return true;
			}else{
				$this->form_validation->set_message('file_check', '- กรุณาเลือกประเภทไฟล์  '. implode(" | ", $this->file_allow_type) .' เท่านั้นครับ');
				return false;
			}
		}else{
			$this->form_validation->set_message('file_check', '- กรุณาเลือกไฟล์ %s');
			return false;
		}
	}
	private function uploadFile($file_name, $dir='')
	{
		if($dir != '' && substr($dir, 0, 1) != '/'){
			$dir = '/'.$dir;
		}
		$path = $this->upload_store_path . $dir;
		//เปิดคอนฟิก Auto ชื่อไฟล์ใหม่ด้วย
		$config['upload_path']          = $path;
		$config['allowed_types']        = $this->file_allow_type;
		$config['encrypt_name']		= TRUE;
		$this->load->library('upload', $config);
		if ($this->upload->do_upload($file_name) ){
			$encrypt_name = $this->upload->file_name;
			$orig_name = $this->upload->orig_name;
			$this->FileUpload->create($encrypt_name, $orig_name);
			$file_path = $path . '/' . $encrypt_name;//ไม่ต้องใช้ Path เต็ม
			$data = array(
						'result' => TRUE,
						'file_path' => $file_path,
						'error' => ''
			);
		}else{
			$data = array(
						'result' => FALSE,
						'error' => $this->upload->display_errors()
			);
		}
		return $data;
	}
	private function removeFile($file_path)
	{
		if($file_path != ''){
			if(file_exists($file_path)){
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
			if($arr['result'] == TRUE){
				$post['shop_photo'] = $arr['file_path'];
			}else{
				$upload_error++;
				$upload_error_msg .= '<br/>'. print_r($arr['error'],TRUE);
			}
			$arr = $this->uploadFile('shop_cover');
			if($arr['result'] == TRUE){
				$post['shop_cover'] = $arr['file_path'];
			}else{
				$upload_error++;
				$upload_error_msg .= '<br/>'. print_r($arr['error'],TRUE);
			}
			$encrypt_id = '';
			if($upload_error == 0){
				$success = TRUE;
				$id = $this->Shops->create($post);

				$this->load->model("common_model");
				$shop_user = $this->common_model->insert('users',
					array(
						'user_add'=>$this->session->userdata('user_id'),
						'datetime_add'=>date("Y-m-d H:i:s"),
						'fag_allow'=>'allow',
						'shop_id'=>$id,
						'user_fname'=>$post['shop_name_th'],
						'email_addr'=>$post['email_addr'],
						'cus_passwd'=>$post['cus_passwd'],
						'mobile_no'=>$post['mobile_no'],
						'user_level'=>'shop')
				);

				$shop_user = $this->common_model->update('shops',array('shop_user'=>$shop_user),array('shop_id'=>$id));

				$encrypt_id = encrypt($id);
				$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>';
			}else{
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
						array('title' => 'Shops', 'url' => site_url('shopdata/shops')),
						array('title' => 'แก้ไขข้อมูล', 'url' => '#', 'class' => 'active')
		);

		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแก้ไขข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Shops->load($id);
			if (empty($results)) {
			$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->data['csrf_field'] = insert_csrf_field(true);


				$this->setPreviewFormat($results);

				$this->data['data_id'] = $id;

				$this->data['category_cate_id_option_list'] = $this->Shops->returnOptionList("category", "cate_id", "cate_name");
				$this->data['users_shop_user_option_list'] = $this->Shops->returnOptionList("users", "user_id", "user_fname",array('where'=>'user_level="shop"'));
				$this->data['users_user_delete_option_list'] = $this->Shops->returnOptionList("users", "user_id", "user_fname");
				$this->data['users_user_add_option_list'] = $this->Shops->returnOptionList("users", "user_id", "user_fname");
				$this->data['users_user_update_option_list'] = $this->Shops->returnOptionList("users", "user_id", "user_fname");

				$this->load->model('common_model');
				$rows = $this->common_model->custom_query("select * from shop_images where shop_id=".$id." and fag_allow!='delete'");
				$this->data['count_image'] = count($rows);
				$shop_images = "";
				foreach ($rows as $key => $value) {
					//$year = (substr($value['datetime_add'],0,4)+543);
                	$shop_images =  $shop_images.'<div class="preview-image preview-show-'.($key+1).'">' .
                            '<div data-image_id="'.$value['image_id'].'" class="image-cancel" data-no="'.($key+1).'">x</div>'.'<div class="image-zone"><img id="pro-img-'.($key+1).'" src="'.base_url().$value['encrypt_name'].'"></div>'.
                            '</div>';
				}
				$this->data['shop_images'] = $shop_images;

				$this->render_view('shopdata/shops/edit_view');
			}
		}
	}

	// ------------------------------------------------------------------------
	public function checkRecordKey($data)
	{
		$error = '';
		$shop_id = ci_decrypt($data['encrypt_shop_id']);
		if($shop_id==''){
			$error .= '- รหัส shop_id';
		}
		return $error;
	}

	public function setShopImages() {
		$post = $this->input->post(NULL, TRUE);
		$message = '<strong>ตั้งค่า shop image สำเร็จ</strong>';
		$upload_error = 0;
		$upload_error_msg = '';
		$success = TRUE;
		//$encrypt_id = '';
		$encrypt_name = '';
		$id= '';
		$data = array();

		if(isset($post['data'])) {
			$arr = json_decode($post['data']);
			foreach($arr as $key=>$value) {
		    $this->load->model('common_model');
			    $id = $this->common_model->update('shop_images',
			    	array('user_update'=>get_session('user_id'),
			    		'datetime_update'=>date("Y-m-d H:i:s"),
			    		'shop_id'=>$post['shop_id']
			    	),
			    	array('image_id'=>$value)
			    );
			}
		}else {
			$success = FALSE;
			$message = '<strong>ตั้งค่า shop image ล้มเหลว</strong>';
		}
		$json = json_encode(array(
			'is_successful' => $success,
			//'encrypt_id' =>  $encrypt_id,
			'message' => $message,
			'id'=>$id,
			'data'=>$data,
		));
		echo $json;
	}

	public function uploadfile1() {
		$message = '<strong>อัปโหลดสำเร็จ</strong>';
		$upload_error = 0;
		$upload_error_msg = '';
		$success = TRUE;
		//$encrypt_id = '';
		$encrypt_name = '';
		$id= '';

		$post = $this->input->post(NULL, TRUE);
		$filename = $post['filename'];


		//$path = $this->upload_store_path .(date('Y')+543);
		$path = $this->upload_store_path;

		$blob = $post['blob'];

		$blob = str_replace("[removed]",'data:image/png;base64,',$blob);
		$blob = str_replace("\\",'',$blob);
		$blob = str_replace(" ",'+',$blob);

		$arr = explode('.',$post['filename']);
		$encrypt_name = uniqid().'.'.$arr[count($arr)-1];

	    $file = @fopen($path.'/'.$encrypt_name, "wb");
	    if($file) {
		    $data = explode(',', $blob);
		    fwrite($file, base64_decode($data[1]));
		    fclose($file);

		    $this->load->model('common_model');
		    $id = $this->common_model->insert('shop_images',
		    	array('user_add'=>get_session('user_id'),
		    		'datetime_add'=>date("Y-m-d H:i:s"),
		    		'encrypt_name'=>$path.$encrypt_name,
		    		'filename'=>$filename,
		    		'shop_id'=>$post['shop_id']
		    	)
		    );
		}else {
			$success = FALSE;
			$message = "File Path Error!";
		}

		$json = json_encode(array(
			'is_successful' => $success,
			//'encrypt_id' =>  $encrypt_id,
			'message' => $message,
			'id'=>$id,
			'path'=>$path,
			'encrypt_name'=>$encrypt_name,
			'filename'=>$filename
		));
		echo $json;
	}
	public function deleteShopImage() {
		$post = $this->input->post(NULL, TRUE);
		$message = '<strong>ลบ shop image สำเร็จ</strong>';
		$upload_error = 0;
		$upload_error_msg = '';
		$success = TRUE;
		//$encrypt_id = '';
		$encrypt_name = '';
		$id= $post['image_id'];
		$data = array();

		if($id!='') {
			$this->load->model('common_model');
			$row = rowArray($this->common_model->custom_query("select * from shop_images where image_id='".$id."'"));
			if(isset($row['datetime_add'])) {
				//$year = substr($row['datetime_add'],0,4);
				$this->removeFile1($row['encrypt_name']);
				$this->common_model->update('shop_images',array('user_delete'=>get_session('user_id'),'datetime_delete'=>date("Y-m-d H:i:s"),'fag_allow'=>'delete'),array('image_id'=>$id));
			}
		}else {
			$success = FALSE;
			$message = '<strong>ลบ shop image ล้มเหลว</strong>';
		}

		$json = json_encode(array(
			'is_successful' => $success,
			//'encrypt_id' =>  $encrypt_id,
			'message' => $message,
			'id'=>$id,
			'data'=>$data,
		));
		echo $json;
	}

	/*
	public function __destruct() {
		$this->db->query('UNLOCK TABLES');
		$this->db->close();
	}
	*/

	private function removeFile1($file_path)
	{
		if($file_path != ''){
			if(file_exists($file_path)){
				unlink($file_path);
			}
		}
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
			if(!empty($_FILES['shop_photo']['name'])){
				$arr = $this->uploadFile('shop_photo');
				if($arr['result'] == TRUE){
					$post['shop_photo'] = $arr['file_path'];
					$this->removeFile($post['shop_photo_old_path']);
					$arr = explode('/', $post['shop_photo_old_path']);
					$encrypt_name = end($arr);
					$this->FileUpload->delete($encrypt_name);
				}else{
					$upload_error++;
					$upload_error_msg .= '<br/>'. print_r($arr['error'],TRUE);
				}
			}
			if(!empty($_FILES['shop_cover']['name'])){
				$arr = $this->uploadFile('shop_cover');
				if($arr['result'] == TRUE){
					$post['shop_cover'] = $arr['file_path'];
					$this->removeFile($post['shop_cover_old_path']);
					$arr = explode('/', $post['shop_cover_old_path']);
					$encrypt_name = end($arr);
					$this->FileUpload->delete($encrypt_name);
				}else{
					$upload_error++;
					$upload_error_msg .= '<br/>'. print_r($arr['error'],TRUE);
				}
			}

			$this->load->model("common_model"); ////****
			$shop_user = $this->common_model->update('users',
				array(
					'user_update'=>$this->session->userdata('user_id'),
					'datetime_update'=>date("Y-m-d H:i:s"),
					'email_addr'=>$post['email_addr'],
					'cus_passwd'=>$post['cus_passwd']
				),
				array('user_id'=>ci_decrypt($post['encrypt_shop_id'])));

			/*
			$shop_user = $this->common_model->update('shop',array('shop_user'=>ci_decrypt($post['encrypt_shop_id'])),array('shop_id'=>ci_decrypt($post['encrypt_shop_id'])));	*/


			if($upload_error == 0){
				$result = $this->Shops->update($post);
				if($result == false){
					$message = $this->Shops->error_message;
					$ok = FALSE;
				}else{
					$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>' . $this->Shops->error_message;
					$ok = TRUE;
				}
			}else{
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
		}else{
			$result = $this->Shops->delete($post);
			if($result == false){
				$message = $this->Shops->error_message;
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
			$pk1 = $data[$i]['shop_id'];
			$data[$i]['url_encrypt_id'] = urlencode(encrypt($pk1));

			if($pk1 != ''){
				$pk1 = encrypt($pk1);
			}
			$data[$i]['encrypt_shop_id'] = $pk1;
			$data[$i]['preview_fag_allow'] = $this->setFagAllowSubject($data[$i]['fag_allow']);
			$data[$i]['datetime_delete'] = setThaiDate($data[$i]['datetime_delete']);
			$data[$i]['datetime_add'] = setThaiDate($data[$i]['datetime_add']);
			$data[$i]['datetime_update'] = setThaiDate($data[$i]['datetime_update']);
			$arr = explode('/', $data[$i]['shop_photo']);
			$encrypt_file_name = end($arr);
			$filename = $this->Shops->getValueOf('tb_uploads_filename', 'filename', "encrypt_name = '$encrypt_file_name'", $this->db);
			$data[$i]['preview_shop_photo'] = setAttachLink('shop_photo', $data[$i]['shop_photo'], $filename);
			$arr = explode('/', $data[$i]['shop_cover']);
			$encrypt_file_name = end($arr);
			$filename = $this->Shops->getValueOf('tb_uploads_filename', 'filename', "encrypt_name = '$encrypt_file_name'", $this->db);
			$data[$i]['preview_shop_cover'] = setAttachLink('shop_cover', $data[$i]['shop_cover'], $filename);
		}
		return $data;
	}

	/**
	 * SET choice subject
	 */
	private function setFagAllowSubject($value)
	{
		$subject = '';
		switch($value){
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
	 * SET array data list
	 */
	private function setPreviewFormat($row_data)
	{
		$data = $row_data;

		$pk1 = $data['shop_id'];
		$this->data['recode_url_encrypt_id'] = urlencode(encrypt($pk1));

		if($pk1 != ''){
			$pk1 = encrypt($pk1);
		}
		$this->data['encrypt_shop_id'] = $pk1;


		$cateIdCateName = $this->Shops->getValueOf('category', 'cate_name', "cate_id = '$data[cate_id]'");
		$this->data['cateIdCateName'] = $cateIdCateName;


		$shopUserUserFname = $this->Shops->getValueOf('users', 'user_fname', "user_id = '$data[shop_user]'");
		$this->data['shopUserUserFname'] = $shopUserUserFname;


		$userDeleteUserFname = $this->Shops->getValueOf('users', 'user_fname', "user_id = '$data[user_delete]'");
		$this->data['userDeleteUserFname'] = $userDeleteUserFname;


		$userAddUserFname = $this->Shops->getValueOf('users', 'user_fname', "user_id = '$data[user_add]'");
		$this->data['userAddUserFname'] = $userAddUserFname;


		$userUpdateUserFname = $this->Shops->getValueOf('users', 'user_fname', "user_id = '$data[user_update]'");
		$this->data['userUpdateUserFname'] = $userUpdateUserFname;

		$this->data['record_shop_id'] = $data['shop_id'];
		$this->data['record_cate_id'] = $data['cate_id'];
		$this->data['record_shop_photo'] = $data['shop_photo'];

		$arr = explode('/', $data['shop_photo']);
		$encrypt_name = end($arr);
		$filename = $this->Shops->getValueOf('tb_uploads_filename', 'filename', "encrypt_name = '$encrypt_name'", $this->db);
		$this->data['record_shop_photo_label'] = $filename;

		$this->data['preview_shop_photo'] = setAttachPreview('shop_photo', $data['shop_photo'], $filename);
		$this->data['record_shop_cover'] = $data['shop_cover'];

		$arr = explode('/', $data['shop_cover']);
		$encrypt_name = end($arr);
		$filename = $this->Shops->getValueOf('tb_uploads_filename', 'filename', "encrypt_name = '$encrypt_name'", $this->db);
		$this->data['record_shop_cover_label'] = $filename;

		$this->data['preview_shop_cover'] = setAttachPreview('shop_cover', $data['shop_cover'], $filename);
		$this->data['record_shop_name_th'] = $data['shop_name_th'];
		$this->data['record_shop_name_en'] = $data['shop_name_en'];
		$this->data['record_mobile_no'] = $data['mobile_no'];
		$this->data['record_email_addr'] = $data['email_addr'];
		$this->data['record_cus_passwd'] = $data['cus_passwd'];
		$this->data['record_shop_user'] = $data['shop_user'];
		$this->data['record_addr'] = $data['addr'];
		$this->data['record_user_delete'] = $data['user_delete'];
		$this->data['record_datetime_delete'] = $data['datetime_delete'];
		$this->data['record_user_add'] = $data['user_add'];
		$this->data['record_datetime_add'] = $data['datetime_add'];
		$this->data['record_user_update'] = $data['user_update'];
		$this->data['record_datetime_update'] = $data['datetime_update'];
		$this->data['preview_fag_allow'] = $this->setFagAllowSubject($data['fag_allow']);
		$this->data['record_fag_allow'] = $data['fag_allow'];
		$this->data['record_point_lat'] = $data['point_lat'];
		$this->data['record_point_long'] = $data['point_long'];

		$this->data['record_datetime_delete'] = setThaiDate($data['datetime_delete']);
		$this->data['record_datetime_add'] = setThaiDate($data['datetime_add']);
		$this->data['record_datetime_update'] = setThaiDate($data['datetime_update']);

	}
}
/*---------------------------- END Controller Class --------------------------------*/
