<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Dashboard.php ]
 */
class Dashboard extends CRUD_Controller
{
	private $per_page;
	private $another_js;
	private $another_css;

	public function __construct()
	{
		parent::__construct();

		chkUserPerm();

		//$this->another_js .= '<script src="'. base_url('assets/themes/sb-admin/vendor/chart.js/Chart.min.js').'"></script>';
		//$this->another_js .= '<script src="'. base_url('assets/themes/sb-admin/js/sb-admin-charts.min.js').'"></script>';

		// $this->another_js .= '<script src="' . base_url('assets/highcharts/highcharts.js') . '"></script>';
		// $this->another_js .= '<script src="' . base_url('assets/highcharts/modules/series-label.js') . '"></script>';
		// $this->another_js .= '<script src="' . base_url('assets/highcharts/modules/accessibility.js') . '"></script>';

		// $this->another_js .= '<script src="'. base_url('assets/themes/majestic/canvasjs.min.js').'"></script>';
		// $this->another_js .= '<script src="' . base_url('assets/js/dashboard.js') . '"></script>';
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

		$this->load->model("common_model");
		$userCount1 = rowArray($this->common_model->custom_query("select count(user_id) as num from users where fag_allow='allow'"));
		$this->data['userCount1'] = number_format($userCount1['num']);

		$userCount2 = rowArray($this->common_model->custom_query("select count(user_id) as num from users where fag_allow='allow' and user_level='user'"));
		$this->data['userCount2'] = number_format($userCount2['num']);

		$userCount3 = rowArray($this->common_model->custom_query("select count(user_id) as num from users where fag_allow='allow' and user_level='super_user'"));
		$this->data['userCount3'] = number_format($userCount3['num']);

		$enddate = date("Y-m-d");
		$day = $this->input->get('daySelect');
		$strdate = date('Y-m-d', strtotime($enddate . "-15 days"));
		/* date */
		$chartSQL = "
		SELECT
		count(state_id) as num,
		DATE(action_datetime) as date
		FROM statistics
		WHERE
		(action_datetime BETWEEN '$strdate 00:00:00' AND '$enddate 23:59:59') AND
		( status='success' and action='login')
		GROUP BY DATE(action_datetime) order by date

		";

		$chart = $this->common_model->custom_query($chartSQL);



		$this->data['chart'] = $chart;
		$this->data['chart_date'] = isset($chart[count($chart) - 1]['date']) ? $chart[count($chart) - 1]['date'] : 0;

		$chart_labels = array();
		$chart_data = array();
		$chart_data1 = array();
		foreach ($chart as $key => $value) {
			$chart_labels[] = "new Date('{$value['date']} 00:00:00').toLocaleString()";
			$chart_data[] = array('t' => $value['date'] . " 00:00:00", 'y' => $value['num']);

			@$chart_data1[] = '{ x: new Date(' . substr($value['date'], 0, 4) . ',' . (substr($value['date'], 5, 4) - 1) . ',' . substr($value['date'], 8, 2) . '), y: ' . $value['num'] . ' }';
		}
		$chart_labels = '[' . implode(',', $chart_labels) . ']';
		$this->data['chart_labels'] = $chart_labels;
		$this->data['chart_data'] = json_encode($chart_data);
		$this->data['chart_data1'] = '[' . implode(',', $chart_data1) . ']';
		$this->data['date_array'] = array();





		$this->render_view('dashboard');
	}
}
/*---------------------------- END Controller Class --------------------------------*/
