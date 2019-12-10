<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Dashboard.php ]
 */
class Dashboard_user extends CRUD_Controller 
{
	private $per_page;
	private $another_js;
	private $another_css;

	public function __construct()
	{
		parent::__construct();

		$this->another_js .= '<script src="'. base_url('assets/themes/sb-admin/vendor/chart.js/Chart.min.js').'"></script>';
		$this->another_js .= '<script src="'. base_url('assets/themes/sb-admin/js/sb-admin-charts.js').'"></script>';
	}

	// ------------------------------------------------------------------------

	/**
	 * Index of controller
	 */
	public function index()
	{
		$this->dashboard();
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
		
		
		$this->data['top_navbar'] = $this->parser->parse('template/sb-admin-bs4/top_navbar_view', $this->top_navbar_data, TRUE);
		$this->data['left_sidebar'] = $this->parser->parse('template/sb-admin-bs4/left_sidebar_view', $this->left_sidebar_data, TRUE);
		$this->data['breadcrumb_list'] = $this->parser->parse('template/sb-admin-bs4/breadcrumb_view', $this->breadcrumb_data, TRUE);
		$this->data['page_content'] = $this->parser->parse_repeat($path, $this->data, TRUE);
		$this->data['another_css'] = $this->another_css;
		$this->data['another_js'] = $this->another_js;
		$this->parser->parse('template/sb-admin-bs4/homepage_view', $this->data);
		
	}

	public function dashboard()
	{
		$this->breadcrumb_data['breadcrumb'] = array();

		$this->render_view('dashboard_user');
	}

}
/*---------------------------- END Controller Class --------------------------------*/