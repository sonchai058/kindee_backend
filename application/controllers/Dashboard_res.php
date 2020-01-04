<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Dashboard.php ]
 */
class Dashboard_res extends CRUD_Controller 
{
	private $per_page;
	private $another_js;
	private $another_css;

	public function __construct()
	{
		parent::__construct();

		chkUserPerm();

		$this->upload_store_path = './assets/uploads/shops/';

		$this->another_js .= '<script src="'. base_url('assets/themes/sb-admin/vendor/chart.js/Chart.min.js').'"></script>';
		$this->another_js .= '<script src="'. base_url('assets/themes/sb-admin/js/sb-admin-charts.min.js').'"></script>';

		$this->another_js .= '<script src="'. base_url('assets/js/dashboard_res.js').'"></script>';
	}

	// ------------------------------------------------------------------------

	/**
	 * Index of controller
	 */
	public function index()
	{
		$this->load->model("common_model");

		$user = rowArray($this->common_model->custom_query("select * from shops where shop_id={$this->session->userdata('shop_id')} limit 1"));

		$this->data['shop_photo'] = base_url($user['shop_photo']);
		$this->data['shop_name_th'] = $user['shop_name_th'];
		$this->data['mobile_no'] = $user['mobile_no'];
		$this->data['email_addr'] = $user['email_addr'];
		$this->data['addr'] = $user['addr'];

		$tmp = rowArray($this->common_model->custom_query("select * from category where cate_id={$user['cate_id']} limit 1"));
		$this->data['cate_name'] = $tmp['cate_name'];

		$this->data['point_lat'] = $user['point_lat'];
		$this->data['point_long'] = $user['point_long'];

		$rows = $this->common_model->custom_query("select * from shop_food_menu_images where shop_id=".$this->session->userdata('shop_id')." and fag_allow!='delete'");
		$this->data['count_image'] = count($rows);
		$shop_food_menu_images = "";
		foreach ($rows as $key => $value) {
            $shop_food_menu_images =  $shop_food_menu_images.'<div class="card col-sm-3">
          <img class="pic" src="'.base_url().$value['encrypt_name'].'" height="200">
        </div>';
		}
		$this->data['shop_food_menu_images'] = $shop_food_menu_images;

		$this->dashboard();
	}

	public function user_select() {
		$post = $this->input->post(NULL, TRUE);

		$message = '<strong>เลือก User สำเร็จ</strong>';
		$success = TRUE;
		$encrypt_id = '';

		$this->load->model("common_model");
		$user = rowArray($this->common_model->custom_query("select * from users where user_id={$post['user_id']}"));

		if(isset($user['user_id'])) {
			$data = array(
						'user_id' => $user['user_id'],
						'shop_id'=> $user['shop_id'],
						'encrypt_user_id'=>encrypt($user['user_id']),
						'encrypt_shop_id'=>encrypt($user['shop_id']),
				);
			$encrypt_id = encrypt($user['user_id']);
			$this->session->set_userdata($data);	
		}else {
			$success = FALSE;
			$message = '<strong>เลือก User ล้มเหลว</strong>';
		}	
		$json = json_encode(array(
			'is_successful' => $success,
			'encrypt_id' =>  $encrypt_id,
			'message' => $message,
			'id'=>@$user['user_id'],
		));
		echo $json;
	}

	// ------------------------------------------------------------------------

	/**
	 * Render this controller page
	 * @param String path of controller
	 * @param Integer total record
	 */
	private function render_view($path)
	{
		/*
		$this->data['left_sidebar'] = $this->parser->parse('includes/left_sidebar_view', $this->left_sidebar_data, TRUE);
		$this->data['breadcrumb_list'] = $this->parser->parse('includes/breadcrumb_view', $this->breadcrumb_data, TRUE);
		$this->data['page_content'] = $this->parser->parse_repeat($path, $this->data, TRUE);
		$this->data['another_css'] = $this->another_css;
		$this->data['another_js'] = $this->another_js;
		$this->parser->parse('includes/homepage_view', $this->data);
		*/
		
		
		$this->data['top_navbar'] = $this->parser->parse('template/majestic/top_navbar_view', $this->top_navbar_data, TRUE);
		$this->data['left_sidebar'] = $this->parser->parse('template/majestic/left_sidebar_view', $this->left_sidebar_data, TRUE);
		$this->data['breadcrumb_list'] = $this->parser->parse('template/majestic/breadcrumb_view', $this->breadcrumb_data, TRUE);
		$this->data['page_content'] = $this->parser->parse_repeat($path, $this->data, TRUE);
		$this->data['another_css'] = $this->another_css;
		$this->data['another_js'] = $this->another_js;
		$this->parser->parse('template/majestic/homepage_view', $this->data);
		
	}

	public function dashboard()
	{
		$this->breadcrumb_data['breadcrumb'] = array();

		$this->render_view('dashboard_res');
	}

}
/*---------------------------- END Controller Class --------------------------------*/