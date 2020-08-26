<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Frontend_page.php ]
 */
class Frontend_page extends CI_Controller
{

	private $data;
	private $per_page;
	private $breadcrumb_data;
	private $left_sidebar_data;
	private $another_js;
	private $another_css;

	public function __construct()
	{
		parent::__construct();

		$data['base_url'] = base_url();
		$data['site_url'] = site_url();

		$data['csrf_token_name'] = $this->security->get_csrf_token_name();
		$data['csrf_cookie_name'] = $this->config->item('csrf_cookie_name');
		$data['csrf_protection_field'] = insert_csrf_field(true);

		$this->per_page = 12;
		$this->num_links = 6;
		$this->uri_segment = 3;
		$this->load->model('Frontend_get_news_model', 'Frontend_news');
		$this->load->model('Frontend_get_shops_model', 'Frontend_shops');

		$this->data = $data;
		$this->breadcrumb_data = $data;
		$this->left_sidebar_data = $data;

		$this->another_js .= '<script src="' . base_url('assets/themes/sb-admin/vendor/chart.js/Chart.min.js') . '"></script>';
		$this->another_js .= '<script src="' . base_url('assets/themes/sb-admin/js/sb-admin-charts.min.js') . '"></script>';
	}

	// ------------------------------------------------------------------------

	/**
	 * Render this controller page
	 * @param String path of controller
	 * @param Integer total record
	 */
	private function render_view($path)
	{
		$this->data['top_navbar'] = $this->parser->parse('template/majestic/frontendpage_navbar_view', $this->data, TRUE);
		$this->data['page_content'] = $this->parser->parse_repeat($path, $this->data, TRUE);
		$this->data['another_css'] = $this->another_css;
		$this->data['another_js'] = $this->another_js;
		$this->parser->parse('template/majestic/frontendpage_view', $this->data);
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

	public function index()
	{
		$start_row = 0;
		$results_news = $this->Frontend_news->read_index($start_row);
		$list_data_news = $this->setDataListFormat($results_news['list_data'], $start_row);
		$this->data['data_list_get_news'] = $list_data_news;
		$this->data['data_news_list'] = $list_data_news;

		$results_shops = $this->Frontend_shops->read_index($start_row);
		$list_data_shops = $results_shops['list_data'];
		$this->data['data_list_shops'] = $list_data_shops;

		$this->render_view('frontend_page');
		// die(print_r($this->data['data_list_shops']));
		// print_r($this->db->last_query());
		// die();
	}

	public function news_page()
	{
		$start_row = $this->uri->segment($this->uri_segment, '0');
		if (!is_numeric($start_row)) {
			$start_row = 0;
		}
		$per_page = $this->per_page;
		$results_news = $this->Frontend_news->read($start_row, $per_page);
		$total_row = $results_news['total_row'];
		$search_row = $results_news['search_row'];
		$list_data_news = $this->setDataListFormat($results_news['list_data'], $start_row);


		$page_url = site_url('frontend_page');
		$pagination = $this->create_pagination($page_url . '/news_page', $search_row);
		$end_row = $start_row + $per_page;
		if ($search_row < $per_page) {
			$end_row = $search_row;
		}

		if ($end_row > $search_row) {
			$end_row = $search_row;
		}

		$this->data['data_news_list'] = $list_data_news;
		$this->data['current_page_offset'] = $start_row;
		$this->data['start_row']	= $start_row + 1;
		$this->data['end_row']	= $end_row;
		$this->data['total_row']	= $total_row;
		$this->data['search_row']	= $search_row;
		$this->data['page_url']	= $page_url;
		$this->data['pagination_link']	= $pagination;
		$this->data['csrf_protection_field']	= insert_csrf_field(true);

		$this->render_view('news_page');
		// $start_row = 0;
		// $results_news = $this->Frontend_news->read($start_row);
		// $list_data_news = $this->setDataListFormat($results_news['list_data'], $start_row);

		// $this->data['data_list_get_news'] = $list_data_news;
		// $this->data['data_news_list'] = $list_data_news;

		// $this->render_view('news_page');
		// die(print_r($this->data['data_list_shops']));
		// print_r($this->db->last_query());
		// die();
	}

	public function news_detail_page($blog_id)
	{
		$start_row = 0;
		$results_news = $this->Frontend_news->detail_read($blog_id);
		//$list_data_news = $this->setDataListFormat($results_news['list_data'], $start_row);
		//$this->data['data_list_get_news'] = $list_data_news;
		$this->data['data_news'] = $results_news;
		$this->data['blog_name_title'] = $results_news['blog_name_title'];
		$this->data['blog_detail'] = $results_news['blog_detail'];
		$this->data['encrypt_name'] = $results_news['encrypt_name'];
		$this->data['userAddUserFname'] = $results_news['userAddUserFname'];

		// $results_shops = $this->Frontend_shops->read($start_row);
		// $list_data_shops = $results_shops['list_data'];
		// $this->data['data_list_shops'] = $list_data_shops;

		$this->render_view('news_detail_page');
		// die(print_r($this->data['data_list_shops']));
		// print_r($this->db->last_query());
		// die();
	}

	public function shops_page()
	{
		$start_row = $this->uri->segment($this->uri_segment, '0');
		if (!is_numeric($start_row)) {
			$start_row = 0;
		}
		$per_page = $this->per_page;
		$results_shops = $this->Frontend_shops->read($start_row, $per_page);
		$total_row = $results_shops['total_row'];
		$search_row = $results_shops['search_row'];
		$list_data_shops = $results_shops['list_data'];
		// $list_data_shops = $this->setDataListFormat($results_shops['list_data'], $start_row);


		$page_url = site_url('frontend_page');
		$pagination = $this->create_pagination($page_url . '/shops_page', $search_row);
		$end_row = $start_row + $per_page;
		if ($search_row < $per_page) {
			$end_row = $search_row;
		}

		if ($end_row > $search_row) {
			$end_row = $search_row;
		}

		$this->data['data_list_shops'] = $list_data_shops;
		$this->data['current_page_offset'] = $start_row;
		$this->data['start_row']	= $start_row + 1;
		$this->data['end_row']	= $end_row;
		$this->data['total_row']	= $total_row;
		$this->data['search_row']	= $search_row;
		$this->data['page_url']	= $page_url;
		$this->data['pagination_link']	= $pagination;
		$this->data['csrf_protection_field']	= insert_csrf_field(true);
		// die(print_r($this->data['data_list_shops']));
		// print_r($this->db->last_query());
		// die();
		$this->render_view('shops_page');

		// $start_row = 0;
		// $results_news = $this->Frontend_news->read($start_row);
		// $list_data_news = $this->setDataListFormat($results_news['list_data'], $start_row);
		// $this->data['data_list_get_news'] = $list_data_news;
		// $this->data['data_news_list'] = $list_data_news;

		// $results_shops = $this->Frontend_shops->read($start_row);
		// $list_data_shops = $results_shops['list_data'];
		// $this->data['data_list_shops'] = $list_data_shops;

		// $this->render_view('shops_page');
		// die(print_r($this->data['data_list_shops']));
		// print_r($this->db->last_query());
		// die();
	}

	public function shop_detail_page($shop_id)
	{
		$start_row = 0;
		$results_shop = $this->Frontend_shops->detail_read($shop_id);
		$this->data['shop_id'] = $results_shop['shop_id'];
		$this->data['shop_cover'] = $results_shop['shop_cover'];
		$this->data['shop_name_th'] = $results_shop['shop_name_th'];
		$this->data['shop_name_en'] = $results_shop['shop_name_en'];
		$this->data['addr'] = $results_shop['addr'];
		$this->data['mobile_no'] = $results_shop['mobile_no'];

		$results_promotions = $this->Frontend_shops->promotions_read($shop_id);
		$this->data['data_list_promotions'] = $results_promotions['list_data'];

		$results_food = $this->Frontend_shops->food_read($shop_id);
		$this->data['data_list_menu'] = $results_food['list_data'];

		$this->render_view('shops_detail_page');
	}


	private function setDataListFormat($lists_data, $start_row = 0)
	{
		$data = $lists_data;
		$count = count($lists_data);
		for ($i = 0; $i < $count; $i++) {
			$start_row++;
			$data[$i]['record_number'] = $start_row;
			$pk1 = $data[$i]['blog_id'];
			$data[$i]['url_encrypt_id'] = urlencode(encrypt($pk1));

			if ($pk1 != '') {
				$pk1 = encrypt($pk1);
			}
			$str = strlen($data[$i]['blog_name']);
			$blog_name_title = $data[$i]['blog_name'];

			if ($str > 100) {
				$blog_name_title = iconv_substr($data[$i]['blog_name'], 0, 30, "UTF-8") . "...";
				$data[$i]['blog_name_title'] = $blog_name_title;
			} else {
				$data[$i]['blog_name_title'] = $blog_name_title;
			}
		}
		return $data;
	}
}
/*---------------------------- END Controller Class --------------------------------*/
