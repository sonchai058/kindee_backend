<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Shop_food_menu.php ]
 */
class Shop_food_menu extends CRUD_Controller
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
		$this->load->model('restaurant/Shop_food_menu_model', 'Shop_food_menu');
		$this->data['page_url'] = site_url('restaurant/shop_food_menu');

		$this->data['page_title'] = 'เมนูอาหาร';

		$this->upload_store_path = './assets/uploads/shop_food_menu/';
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

		$js_url = 'assets/js_modules/restaurant/shop_food_menu.js?ft='. filemtime('assets/js_modules/restaurant/shop_food_menu.js');
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
		$this->session->unset_userdata($this->Shop_food_menu->session_name . '_search_field');
		$this->session->unset_userdata($this->Shop_food_menu->session_name . '_value');

		$this->search();
	}

	// ------------------------------------------------------------------------

	/**
	 * Search data
	 */
	public function search()
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'เมนูอาหาร', 'class' => 'active', 'url' => '#'),
		);
		if (isset($_POST['submit'])) {
			$search_field =  $this->input->post('search_field', TRUE);
			$value = $this->input->post('txtSearch', TRUE);
			$arr = array($this->Shop_food_menu->session_name . '_search_field' => $search_field, $this->Shop_food_menu->session_name . '_value' => $value );
			$this->session->set_userdata($arr);
		} else {
			$search_field = $this->session->userdata($this->Shop_food_menu->session_name . '_search_field');
			$value = $this->session->userdata($this->Shop_food_menu->session_name . '_value');
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
			$this->Shop_food_menu->order_field = $field;
			$this->Shop_food_menu->order_sort = $sort;
		}
		$results = $this->Shop_food_menu->read($start_row, $per_page);
		$total_row = $results['total_row'];
		$search_row = $results['search_row'];
		$list_data = $this->setDataListFormat($results['list_data'], $start_row);


		$page_url = site_url('restaurant/shop_food_menu');
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

		$this->render_view('restaurant/shop_food_menu/list_view');
	}

	// ------------------------------------------------------------------------

	/**
	 * Preview Data
	 * @param String encrypt id
	 */
	public function preview($encrypt_id = "")
	{
		$this->breadcrumb_data['breadcrumb'] = array(
						array('title' => 'เมนูอาหาร', 'url' => site_url('restaurant/shop_food_menu')),
						array('title' => 'แสดงข้อมูลรายละเอียด', 'url' => '#', 'class' => 'active')
		);
		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแสดงข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Shop_food_menu->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->setPreviewFormat($results);
				$this->render_view('restaurant/shop_food_menu/preview_view');
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
						array('title' => 'เมนูอาหาร', 'url' => site_url('restaurant/shop_food_menu')),
						array('title' => 'เพิ่มข้อมูล', 'url' => '#', 'class' => 'active')
		);

		$this->load->model("common_model");
		$this->data['category_rmat_id_option_list'] = "";
		$rows = $this->common_model->custom_query("select * from raw_material where fag_allow='allow' and energy_val!=0.00 and rmat_name!=''");
		foreach ($rows as $key => $value) {
			$rmat_name = mb_substr($value['rmat_name'],0,40,'UTF-8');
			$this->data['category_rmat_id_option_list'] = $this->data['category_rmat_id_option_list']."<option data-energy_val='{$value['energy_val']}' value='{$value['rmat_id']}'>{$rmat_name} - {$value['energy_val']}/กรัม</option>";
		}

		$this->data['count_record'] = 1;
		$this->data['record_self_food_menu_composition'] = json_encode(array());

		$this->data['count_image'] = 1;
		$this->data['data_id'] = 0;

		$this->data['category_cate_id_option_list'] = $this->Shop_food_menu->returnOptionList("category", "cate_id", "cate_name");
		$this->data['category_type_id_option_list'] = $this->Shop_food_menu->returnOptionList("food_type", "type_id", "type_name");
		$this->data['users_user_delete_option_list'] = $this->Shop_food_menu->returnOptionList("users", "user_id", "user_fname");
		$this->data['users_user_add_option_list'] = $this->Shop_food_menu->returnOptionList("users", "user_id", "user_fname");
		$this->data['users_user_update_option_list'] = $this->Shop_food_menu->returnOptionList("users", "user_id", "user_fname");

		$this->render_view('restaurant/shop_food_menu/add_view');
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

		$frm->set_rules('self_food_name', 'ชื่อ', 'trim|required');
		$frm->set_rules('cate_id', 'ประเภทอาหาร', 'trim|required|is_natural');
		$frm->set_rules('price_amt', 'ราคา', 'trim|required|callback_float_check');
		$frm->set_rules('energy_amt', 'พลังงาน', 'trim|callback_float_check');
		$frm->set_rules('fag_allow', 'สถานะ', 'trim');

		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');
		$frm->set_message('decimal', '- %s ต้องระบุตัวเลขทศนิยม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('self_food_name');
			$message .= form_error('cate_id');
			$message .= form_error('price_amt');
			$message .= form_error('energy_amt');
			$message .= form_error('fag_allow');
			return $message;
		}
	}

	// ------------------------------------------------------------------------
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
	/**
	 * Default Validation for Update
	 * see also https://www.codeigniter.com/userguide3/libraries/form_validation.html
	 */
	public function formValidateUpdate()
	{
		$this->load->library('form_validation');
		$frm = $this->form_validation;

		$frm->set_rules('self_food_name', 'ชื่อ', 'trim|required');
		$frm->set_rules('cate_id', 'ประเภทอาหาร', 'trim|required|is_natural');
		$frm->set_rules('price_amt', 'ราคา', 'trim|required|callback_float_check');
		$frm->set_rules('energy_amt', 'พลังงาน', 'trim|callback_float_check');
		$frm->set_rules('fag_allow', 'สถานะ', 'trim');

		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');
		$frm->set_message('decimal', '- %s ต้องระบุตัวเลขทศนิยม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('self_food_name');
			$message .= form_error('cate_id');
			$message .= form_error('price_amt');
			$message .= form_error('energy_amt');
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
		$id_shop = array();
		if ($message != '') {
			$json = json_encode(array(
						'is_successful' => FALSE,
						'message' => $message
			));
			echo $json;
		} else {

			$post = $this->input->post(NULL, TRUE);

			$encrypt_id = '';
			$post['shop_id'] = $this->session->userdata('shop_id');
			$id = $this->Shop_food_menu->create($post);
			if($id != ''){

				$arr = $post['rmat_id'];
				$this->load->model("common_model");
				$energy_amt = 0;
				foreach ($arr as $key => $value) {
					if($key==0 || $post['rmat_id'][$key]=='') {
						continue;
					}else {
						$tmp = rowArray($this->common_model->custom_query("select energy_val from raw_material where fag_allow!='delete' and rmat_id='{$post['rmat_id'][$key]}' order by rmat_id desc limit 1"));
						$energy_amt_tmp = isset($tmp['energy_val'])?$tmp['energy_val']:0;
						$energy_amt+=($energy_amt_tmp*floatval($post['amount'][$key]));
						$id_new = $this->common_model->insert("self_food_menu_composition",
							array(
								'user_add'=>get_session('user_id'),
								'datetime_add'=>date("Y-m-d H:i:s"),
								'self_food_id'=>$id,
								'rmat_id'=>$post['rmat_id'][$key],
								'amount'=>$post['amount'][$key]
							)
						);
						$id_shop[] = $id_new;
					}
				}
				if($energy_amt!=0) {
					$this->common_model->update('self_food_menu',array('energy_amt'=>$energy_amt),array('self_food_id'=>$id));
				}

				$success = TRUE;
				$encrypt_id = encrypt($id);
				$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>';
			}else{
				$success = FALSE;
				$message = 'Error : ' . $this->Shop_food_menu->error_message;
			}

			$json = json_encode(array(
						'is_successful' => $success,
						'encrypt_id' =>  $encrypt_id,
						'message' => $message,
						'id_shop' => $id_shop,
						'id'=>$id
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
						array('title' => 'เมนูอาหาร', 'url' => site_url('restaurant/shop_food_menu')),
						array('title' => 'แก้ไขข้อมูล', 'url' => '#', 'class' => 'active')
		);

		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแก้ไขข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Shop_food_menu->load($id);
			if (empty($results)) {
			$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->data['csrf_field'] = insert_csrf_field(true);


				$this->setPreviewFormat($results);

				$this->load->model("common_model");
				$this->data['category_rmat_id_option_list'] = "";
				$rows = $this->common_model->custom_query("select * from raw_material where fag_allow='allow' and energy_val!=0.00 and rmat_name!=''");
				foreach ($rows as $key => $value) {
					$rmat_name = mb_substr($value['rmat_name'],0,40,'UTF-8');
					$this->data['category_rmat_id_option_list'] = $this->data['category_rmat_id_option_list']."<option data-energy_val='{$value['energy_val']}' value='{$value['rmat_id']}'>{$rmat_name} - {$value['energy_val']}/กรัม</option>";
				}

				$this->data['data_id'] = $id;
				$rows = $this->common_model->custom_query("select * from shop_food_menu_images where food_id=".$id." and fag_allow!='delete'");
				$this->data['count_image'] = count($rows);
				$shop_food_menu_images = "";
				foreach ($rows as $key => $value) {
					//$year = (substr($value['datetime_add'],0,4)+543);
                	$shop_food_menu_images =  $shop_food_menu_images.'<div class="preview-image preview-show-'.($key+1).'">' .
                            '<div data-image_id="'.$value['image_id'].'" class="image-cancel" data-no="'.($key+1).'">x</div>'.'<div class="image-zone"><img style="width:320px; height: 320px;" id="pro-img-'.($key+1).'" src="'.base_url().$value['encrypt_name'].'"></div>'.
                            '</div>';
				}
				$this->data['shop_food_menu_images'] = $shop_food_menu_images;


				$this->data['category_cate_id_option_list'] = $this->Shop_food_menu->returnOptionList("category", "cate_id", "cate_name");
				$this->data['category_type_id_option_list'] = $this->Shop_food_menu->returnOptionList("food_type", "type_id", "type_name");
				$this->data['users_user_delete_option_list'] = $this->Shop_food_menu->returnOptionList("users", "user_id", "user_fname");
				$this->data['users_user_add_option_list'] = $this->Shop_food_menu->returnOptionList("users", "user_id", "user_fname");
				$this->data['users_user_update_option_list'] = $this->Shop_food_menu->returnOptionList("users", "user_id", "user_fname");
				$this->render_view('restaurant/shop_food_menu/edit_view');
			}
		}
	}

	// ------------------------------------------------------------------------
	public function checkRecordKey($data)
	{
		$error = '';
		$self_food_id = ci_decrypt($data['encrypt_self_food_id']);
		if($self_food_id==''){
			$error .= '- รหัส self_food_id';
		}
		return $error;
	}

	public function setFoodImages() {
		$post = $this->input->post(NULL, TRUE);
		$message = '<strong>ตั้งค่า food image สำเร็จ</strong>';
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
			    $id = $this->common_model->update('shop_food_menu_images',
			    	array('user_update'=>get_session('user_id'),
			    		'datetime_update'=>date("Y-m-d H:i:s"),
			    		'food_id'=>$post['self_food_id']
			    	),
			    	array('image_id'=>$value)
			    );
			}
		}else {
			$success = FALSE;
			$message = '<strong>ตั้งค่า food image ล้มเหลว</strong>';
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

	public function uploadfile() {
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
		    $id = $this->common_model->insert('shop_food_menu_images',
		    	array('user_add'=>get_session('user_id'),
		    		'datetime_add'=>date("Y-m-d H:i:s"),
		    		'encrypt_name'=>$path.$encrypt_name,
		    		'filename'=>$filename,
		    		'food_id'=>$post['self_food_id'],
		    		'shop_id'=>$this->session->userdata('shop_id')
		    	)
		    );
		}else {
			$success = TRUE;
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
	public function deleteFoodImage() {
		$post = $this->input->post(NULL, TRUE);
		$message = '<strong>ลบ food image สำเร็จ</strong>';
		$upload_error = 0;
		$upload_error_msg = '';
		$success = TRUE;
		//$encrypt_id = '';
		$encrypt_name = '';
		$id= $post['image_id'];
		$data = array();

		if($id!='') {
			$this->load->model('common_model');
			$row = rowArray($this->common_model->custom_query("select * from shop_food_menu_images where image_id='".$id."'"));
			if(isset($row['datetime_add'])) {
				//$year = substr($row['datetime_add'],0,4);
				$this->removeFile($row['encrypt_name']);
				$this->common_model->update('shop_food_menu_images',array('user_delete'=>get_session('user_id'),'datetime_delete'=>date("Y-m-d H:i:s"),'fag_allow'=>'delete'),array('image_id'=>$id));
			}
		}else {
			$success = FALSE;
			$message = '<strong>ลบ food image ล้มเหลว</strong>';
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

	private function removeFile($file_path)
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
		$message .= $this->formValidateUpdate();
		/*
		$edit_remark = $this->input->post('edit_remark', TRUE);
		if ($edit_remark == '') {
			$message .= 'ระบุเหตุผล';
		}
		*/

		$post = $this->input->post(NULL, TRUE);
		$error_pk_id = $this->checkRecordKey($post);

		$encrypt_id = urldecode($post['encrypt_self_food_id']);
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

			$result = $this->Shop_food_menu->update($post);
			if($result == false){
				$message = $this->Shop_food_menu->error_message;
				$ok = FALSE;
			}else{
				$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>' . $this->Shop_food_menu->error_message;
				$ok = TRUE;

				$this->load->model("common_model");
				$this->common_model->update('self_food_menu_composition',array(
					'user_update'=>get_session('user_id'),
					'datetime_update'=>date("Y-m-d H:i:s"),
					'user_delete'=>get_session('user_id'),
					'datetime_delete'=>date("Y-m-d H:i:s"),
					'fag_allow'=>'delete'
					),
					array('self_food_id'=>$id)
				);
				$arr = $post['rmat_id'];
				$energy_amt = 0;
				foreach ($arr as $key => $value) {
					if($key==0 || $post['rmat_id'][$key]=='') {
						continue;
					}else {
						$tmp = rowArray($this->common_model->custom_query("select energy_val from raw_material where fag_allow!='delete' and rmat_id='{$post['rmat_id'][$key]}' order by rmat_id desc limit 1"));
						$energy_amt_tmp = isset($tmp['energy_val'])?$tmp['energy_val']:0;
						$energy_amt+=($energy_amt_tmp*floatval($post['amount'][$key]));
						$id_new = $this->common_model->insert("self_food_menu_composition",
							array(
								'user_add'=>get_session('user_id'),
								'datetime_add'=>date("Y-m-d H:i:s"),
								'self_food_id'=>$id,
								'rmat_id'=>$post['rmat_id'][$key],
								'amount'=>$post['amount'][$key]
							)
						);
						//$id_self[] = $id_new;
					}
				}
				if($energy_amt!=0) {
					$this->common_model->update('self_food_menu',array('energy_amt'=>$energy_amt),array('self_food_id'=>$id));
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
			$result = $this->Shop_food_menu->delete($post);
			if($result == false){
				$message = $this->Shop_food_menu->error_message;
				$ok = FALSE;
			}else{
				$message = '<strong>ลบข้อมูลเรียบร้อย</strong>';
				$ok = TRUE;

				$this->load->model('common_model');
				$this->common_model->update("self_food_menu_composition",
					array('user_delete'=>get_session('user_id'),'datetime_delete'=>date("Y-m-d H:i:s"),'fag_allow'=>'delete'),
					array('self_food_id'=>checkEncryptData($post['encrypt_self_food_id'])));


				$this->common_model->update("shop_food_menu_images",
					array('user_delete'=>get_session('user_id'),'datetime_delete'=>date("Y-m-d H:i:s"),'fag_allow'=>'delete'),
					array('food_id'=>checkEncryptData($post['encrypt_self_food_id'])));
				$rows = $this->common_model->custom_query("select * from shop_food_menu_images where food_id=".checkEncryptData($post['encrypt_self_food_id']));

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
	private function setDataListFormat($lists_data, $start_row=0)
	{
		$data = $lists_data;
		$count = count($lists_data);

		$this->load->model('common_model');

		for($i=0;$i<$count;$i++){
			$start_row++;
			$data[$i]['record_number'] = $start_row;
			$pk1 = $data[$i]['self_food_id'];
			$data[$i]['url_encrypt_id'] = urlencode(encrypt($pk1));

			if($pk1 != ''){
				$pk1 = encrypt($pk1);
			}
			$data[$i]['encrypt_self_food_id'] = $pk1;
			$data[$i]['preview_fag_allow'] = $this->setFagAllowSubject($data[$i]['fag_allow']);
			$data[$i]['price_amt'] = number_format($data[$i]['price_amt'],2);
			$data[$i]['energy_amt'] = number_format(($data[$i]['energy_amt']/1000),2);
			$data[$i]['datetime_delete'] = setThaiDate($data[$i]['datetime_delete']);
			$data[$i]['datetime_add'] = setThaiDate($data[$i]['datetime_add']);
			$data[$i]['datetime_update'] = setThaiDate($data[$i]['datetime_update']);

			$rows = $this->common_model->custom_query("select a.*,b.rmat_name as rmat_name from self_food_menu_composition as a left join raw_material as b on a.rmat_id=b.rmat_id where a.fag_allow='allow' and a.self_food_id=".$data[$i]['self_food_id']);
			$this->data['seft_comp'] = "";
			$arr_tmp = array();
			foreach ($rows as $key => $value) {
				$arr_tmp[] = $value['rmat_name'];
			}
			if(count($arr_tmp)) {
				$data[$i]['seft_comp'] = implode(',',$arr_tmp);
			}

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

		$pk1 = $data['self_food_id'];
		$this->data['recode_url_encrypt_id'] = urlencode(encrypt($pk1));

		if($pk1 != ''){
			$pk1 = encrypt($pk1);
		}
		$this->data['encrypt_self_food_id'] = $pk1;


		$cateIdCateName = $this->Shop_food_menu->getValueOf('category', 'cate_name', "cate_id = '$data[cate_id]'");
		$this->data['cateIdCateName'] = $cateIdCateName;


		$userDeleteUserFname = $this->Shop_food_menu->getValueOf('users', 'user_fname', "user_id = '$data[user_delete]'");
		$this->data['userDeleteUserFname'] = $userDeleteUserFname;


		$userAddUserFname = $this->Shop_food_menu->getValueOf('users', 'user_fname', "user_id = '$data[user_add]'");
		$this->data['userAddUserFname'] = $userAddUserFname;


		$userUpdateUserFname = $this->Shop_food_menu->getValueOf('users', 'user_fname', "user_id = '$data[user_update]'");
		$this->data['userUpdateUserFname'] = $userUpdateUserFname;

		$this->data['record_self_food_id'] = $data['self_food_id'];
		$this->data['record_self_food_name'] = $data['self_food_name'];
		$this->data['record_cate_id'] = $data['cate_id'];
		$this->data['record_type_id'] = $data['type_id'];
		$this->data['record_price_amt'] = $data['price_amt'];
		$this->data['record_energy_amt'] = ($data['energy_amt']/1000);
		$this->data['record_user_delete'] = $data['user_delete'];
		$this->data['record_datetime_delete'] = $data['datetime_delete'];
		$this->data['record_user_add'] = $data['user_add'];
		$this->data['record_datetime_add'] = $data['datetime_add'];
		$this->data['record_user_update'] = $data['user_update'];
		$this->data['record_datetime_update'] = $data['datetime_update'];
		$this->data['preview_fag_allow'] = $this->setFagAllowSubject($data['fag_allow']);
		$this->data['record_fag_allow'] = $data['fag_allow'];

		$this->load->model('common_model');
		$rows = $this->common_model->custom_query("select a.*,b.rmat_name as rmat_name from self_food_menu_composition as a left join raw_material as b on a.rmat_id=b.rmat_id where a.fag_allow='allow' and a.self_food_id=".$data['self_food_id']);
		$this->data['record_seft_comp'] = "";
		$arr_tmp = array();
		foreach ($rows as $key => $value) {
			$arr_tmp[] = $value['rmat_name'];
		}
		if(count($arr_tmp)) {
			$this->data['record_seft_comp'] = implode(',',$arr_tmp);
		}

		$this->data['record_self_food_menu_composition'] = json_encode(array());
		$rows = $this->common_model->custom_query("select * from self_food_menu as a left join self_food_menu_composition as b on a.self_food_id=b.self_food_id where a.fag_allow!='delete' and b.fag_allow!='delete' and a.self_food_id=".$data['self_food_id']);
		if(count($rows)) {
			$this->data['record_self_food_menu_composition'] = json_encode($rows);
		}
		$this->data['count_record'] = count($rows);

		//$this->data['record_price_amt'] = number_format($data['price_amt'],2);
		$this->data['record_price_amt'] = $data['price_amt'];
		$this->data['record_energy_amt'] = number_format(($data['energy_amt']/1000),2);
		$this->data['record_datetime_delete'] = setThaiDate($data['datetime_delete']);
		$this->data['record_datetime_add'] = setThaiDate($data['datetime_add']);
		$this->data['record_datetime_update'] = setThaiDate($data['datetime_update']);

	}
}
/*---------------------------- END Controller Class --------------------------------*/
