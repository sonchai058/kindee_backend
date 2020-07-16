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

	/**
	 * Index of controller
	 */

	public function index()
	{
		$start_row = 0;
		$results_news = $this->Frontend_news->read($start_row);
		$list_data_news = $this->setDataListFormat($results_news['list_data'], $start_row);
		$this->data['data_list_get_news'] = $list_data_news;
		$this->data['data_news_list'] = $list_data_news;

		$results_shops = $this->Frontend_shops->read($start_row);
		$list_data_shops = $results_shops['list_data'];
		$this->data['data_list_shops'] = $list_data_shops;

		$this->render_view('frontend_page');
		// die(print_r($this->data['data_list_shops']));
		// print_r($this->db->last_query());
		// die();
	}

	public function news_page()
	{
		$start_row = 0;
		$results_news = $this->Frontend_news->read($start_row);
		$list_data_news = $this->setDataListFormat($results_news['list_data'], $start_row);
		$this->data['data_list_get_news'] = $list_data_news;
		$this->data['data_news_list'] = $list_data_news;

		// $results_shops = $this->Frontend_shops->read($start_row);
		// $list_data_shops = $results_shops['list_data'];
		// $this->data['data_list_shops'] = $list_data_shops;

		$this->render_view('news_page');
		// die(print_r($this->data['data_list_shops']));
		// print_r($this->db->last_query());
		// die();
	}

	public function shops_page()
	{
		$start_row = 0;
		$results_news = $this->Frontend_news->read($start_row);
		$list_data_news = $this->setDataListFormat($results_news['list_data'], $start_row);
		$this->data['data_list_get_news'] = $list_data_news;
		$this->data['data_news_list'] = $list_data_news;

		$results_shops = $this->Frontend_shops->read($start_row);
		$list_data_shops = $results_shops['list_data'];
		$this->data['data_list_shops'] = $list_data_shops;

		$this->render_view('shops_page');
		// die(print_r($this->data['data_list_shops']));
		// print_r($this->db->last_query());
		// die();
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
