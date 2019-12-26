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

		chkUserPerm();

		//die(print_r($_SESSION));

		$this->another_js .= '<script src="'. base_url('assets/themes/sb-admin/vendor/chart.js/Chart.min.js').'"></script>';
		$this->another_js .= '<script src="'. base_url('assets/themes/sb-admin/js/sb-admin-charts.js').'"></script>';

		$this->another_js .= '<script src="'. base_url('assets/js/dashboard_user.js').'"></script>';
	}

	// ------------------------------------------------------------------------

	/**
	 * Index of controller
	 */
	function getAge($date) { // Y-m-d format
	    $now = explode("-", date('Y-m-d'));
	    $dob = explode("-", $date);
	    $dif = $now[0] - $dob[0];
	    if ($dob[1] > $now[1]) { // birthday month has not hit this year
	        $dif -= 1;
	    }
	    elseif ($dob[1] == $now[1]) { // birthday month is this month, check day
	        if ($dob[2] > $now[2]) {
	            $dif -= 1;
	        }
	        elseif ($dob[2] == $now[2]) { // Happy Birthday!
	            $dif = $dif." Happy Birthday!";
	        };
	    };
	    return $dif;
	}
	public function index()
	{
		$this->load->model("common_model");

		$user = rowArray($this->common_model->custom_query("select * from users where user_id={$this->session->userdata('user_id')} limit 1"));

		$this->data['user_photo'] = $user['user_photo'];
		$this->data['date_of_birth'] = substr($user['date_of_birth'],8,2).'/'.substr($user['date_of_birth'],5,2).'/'.(substr($user['date_of_birth'],0,4)+543);
		$this->data['user_flname'] = $user['user_fname'].' '.$user['user_lname'];
		$this->data['user_height'] = $user['user_height'];
		$this->data['user_sex'] = $user['user_sex'];

		$this->data['age'] = $this->getAge($user['date_of_birth']);

		$chartrows = $this->common_model->custom_query("select a.*,DATE(a.date_exam) as date from users_exam_weight as a where a.fag_allow='allow' and a.user_id={$this->session->userdata('user_id')} GROUP BY date order by date");

		$chartrows_calo = $this->common_model->custom_query("select a.*,sum(food_energy) as num,DATE(a.date_eat) as date from users_food_time as a where a.fag_allow='allow' and a.user_id={$this->session->userdata('user_id')} GROUP BY date order by date LIMIT 10");

		$users_exam_weight = rowArray($this->common_model->custom_query("select a.*,DATE(a.date_exam) as date from users_exam_weight as a where a.fag_allow='allow' and a.user_id={$this->session->userdata('user_id')} GROUP BY date order by date DESC"));
		$this->data['users_exam_weight'] = isset($users_exam_weight['user_weight'])?$users_exam_weight['user_weight']:0;
		$this->data['users_exam_weight'] = number_format($this->data['users_exam_weight']);

		$users_exam_waistline = rowArray($this->common_model->custom_query("select a.*,DATE(a.date_exam) as date from users_exam_waistline as a where a.fag_allow='allow' and a.user_id={$this->session->userdata('user_id')} GROUP BY date order by date DESC"));
		$this->data['users_exam_waistline'] = isset($users_exam_waistline['user_waist'])?$users_exam_waistline['user_waist']:0;
		$this->data['users_exam_waistline'] = number_format($this->data['users_exam_waistline']);

		$users_exam_hip = rowArray($this->common_model->custom_query("select a.*,DATE(a.date_exam) as date from users_exam_hip as a where a.fag_allow='allow' and a.user_id={$this->session->userdata('user_id')} GROUP BY date order by date DESC"));
		$this->data['users_exam_hip'] = isset($users_exam_hip['user_hib'])?$users_exam_hip['user_hib']:0;
		$this->data['users_exam_hip'] = number_format($this->data['users_exam_hip']);

		$this->data['chartrows'] = $chartrows;

		$this->data['chart_bmi'] = $chartrows;
		$this->data['chart_bmr'] = $chartrows;
		$this->data['chart_calo'] = $chartrows_calo;

		$this->data['chart_date'] = isset($chartrows[count($chartrows)-1]['date'])?$chartrows[count($chartrows)-1]['date']:0;
		$chart_labels = array();
		$chart_labels_calo = array();
		$chart_bmi = array();
		$chart_bmr = array();
		$chart_calo = array();

		$this->data['users_bmi'] = 0;
		$this->data['users_bmi_txt'] = '-';


		foreach ($chartrows as $key => $value) {
			$chart_labels[] = "new Date('{$value['date']} 00:00:00').toLocaleString()";

			$bmi_val = $value['user_weight']/((floatval($this->data['user_height'])/100)*(floatval($this->data['user_height'])/100));

			$bmr_val = 0;
			$calo_val = 0;
			if($this->data['user_sex']=='ชาย') {
			  $bmr_val = 66+ (13.7 * $value['user_weight']) + (5 * $this->data['user_height']) - (6.8 * $this->data['age']);
			  //$calo_val = floatval($value['user_weight'])*31; 
			}else if($this->data['user_sex']=='หญิง'){
			  $bmr_val = 665 + (9.6 * $value['user_weight']) + (1.8 * $this->data['user_height']) - (4.7 * $this->data['age']);
			  //$calo_val = floatval($value['user_weight'])*27; 
			}

			$this->data['users_bmi'] = number_format($bmi_val,2);
	          if($bmi_val < 18.5) { 
	          	$this->data['users_bmi_txt'] = "<br/><h6>น้ำหนักหน่อยกว่ามาตรฐาน</h6>";
	          } elseif($bmi_val >= 18.5 && $bmi_val < 24.9) { 
	          	$this->data['users_bmi_txt'] = "<br/><h6>น้ำหนักปกติ</h6>";
	          } elseif($bmi_val >= 25 && $bmi_val < 29.9) { 
	          	$this->data['users_bmi_txt'] = "<br/><h6>อ้วนระดับ 1</h6>";
	          } elseif($bmi_val >= 30 && $bmi_val < 34.9) { 
	          	$this->data['users_bmi_txt'] = "<br/><h6>อ้วนระดับ 2</h6>";
	          }elseif($bmi_val >= 35 && $bmi_val < 39.9) { 
	          	$this->data['users_bmi_txt'] = "<br/><h6>อ้วนระดับ 3</h6>";
	          }elseif($bmi_val >40) { 
	          	$this->data['users_bmi_txt'] = "<br/><h6>อ้วนระดับ 4</h6>";
	          }

			$chart_bmi[] = array('t'=>$value['date']." 00:00:00",'y'=>$bmi_val);
			$chart_bmr[] = array('t'=>$value['date']." 00:00:00",'y'=>($bmr_val/1000));
			
		}

		foreach ($chartrows_calo as $key => $value) {
			$chart_labels_calo[] = "new Date('{$value['date']} 00:00:00').toLocaleString()";
			$chart_calo[] = array('t'=>$value['date']." 00:00:00",'y'=>($value['num']/1000));
		}

		$this->data['user_height'] = number_format($this->data['user_height']);
		$chart_labels='['.implode(',',$chart_labels).']';
		$this->data['chart_labels'] = $chart_labels;
		$chart_labels_calo='['.implode(',',$chart_labels_calo).']';
		$this->data['chart_labels_calo'] = $chart_labels_calo;		
		$this->data['chart_bmi'] = json_encode($chart_bmi);
		$this->data['chart_bmr'] = json_encode($chart_bmr);
		$this->data['chart_bmr_credit'] = @$chart_bmr[count($chart_bmr)-1]['y'].' kcal/day';
		$this->data['chart_calo'] = json_encode($chart_calo);
		$this->data['chart_calo_credit'] = @$chart_calo[count($chart_calo)-1]['y'].' kcal/day';
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

		$this->render_view('dashboard_user');
	}

}
/*---------------------------- END Controller Class --------------------------------*/