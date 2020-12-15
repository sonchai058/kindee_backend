<style>
	.nav-tabs-flex-wrap .nav-tabs-title-left {
		float: left !important;
	}

	.nav-tabs-flex-wrap .nav-tabs-title-right {
		float: right !important;
	}

	.col-md-2 {
		padding-left: 0;
	}
</style>
<script>
	$(document).ready(function() {

		$(function() {

			$(".datepicker").datepicker({
				dateFormat: 'yy-mm-dd',
				maxDate: new Date(),

				dayNamesMin: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"],
				monthNamesShort: [
					"มกราคม",
					"กุมภาพันธ์",
					"มีนาคม",
					"เมษายน",
					"พฤษภาคม",
					"มิถุนายน",
					"กรกฎาคม",
					"สิงหาคม",
					"กันยายน",
					"ตุลาคม",
					"พฤศจิกายน",
					"ธันวาคม",
				],
				changeMonth: true,
				changeYear: true,
			});

		});

		var chart_labels = {
			chart_labels
		};
		var chart_labels_calo = {
			chart_labels_calo
		};
		var chart_bmi = JSON.parse('{chart_bmi}');
		var chart_bmr = JSON.parse('{chart_bmr}');
		var chart_bmr1 = {
			chart_bmr1
		};
		var chart_calo1 = {
			chart_calo1
		};
		var chart_calo = JSON.parse('{chart_calo}');
	});
</script>
<?php
 error_reporting(0);
function getAge($date)
{ // Y-m-d format
	$now = explode("-", date('Y-m-d'));
	$dob = explode("-", $date);
	$dif = $now[0] - $dob[0];
	if ($dob[1] > $now[1]) { // birthday month has not hit this year
		$dif -= 1;
	} elseif ($dob[1] == $now[1]) { // birthday month is this month, check day
		if ($dob[2] > $now[2]) {
			$dif -= 1;
		} elseif ($dob[2] == $now[2]) { // Happy Birthday!
			$dif = $dif . " Happy Birthday!";
		};
	};
	return $dif;
}
function getDateC($value)
{
	$data = explode('/', $value);
	$year  = $data[2] -  543;
	return $year . '-' . $data[1] . '-' . $data[0];
}

if ($this->input->post('bmr_strdate')) {
	$year = date("Y") + 543; #E
	$strdate = getDateC($this->input->post('bmr_strdate'));
	$enddate =  getDateC($this->input->post('bmr_enddate'));
} else {
	$year = date("Y") + 543;
	$enddate = date("Y-m-d");
	$strdate = date('Y-m-d', strtotime($enddate . "-5 days"));
}



$bmi = '';
$bmr = '';

function displayDates($date1, $date2, $format = 'Y-m-d')
{
	$dates = array();
	$current = strtotime($date1);
	$date2 = strtotime($date2);
	$stepVal = '+1 day';
	while ($current <= $date2) {
		$dates[] = date($format, $current);
		$current = strtotime($stepVal, $current);
	}
	return $dates;
}

$bmr_date_array = array();

$period = displayDates($strdate, $enddate);
// print_r($period);

foreach ($period as $key => $value) {
	$date_array[$value] = 0;

	$bmr_date_array[$value] = 0;
}




$user = rowArray($this->common_model->custom_query("select * from users where user_id={$this->session->userdata('user_id')} limit 1"));



$user_weight_date = '';
$user_weight_last = 0;
$sql = "
SELECT
a.*
,DATE(a.date_exam) as date
FROM users_exam_weight as a
WHERE
 DATE(date_exam) < '$strdate'  AND
a.fag_allow='allow' AND a.user_id={$this->session->userdata('user_id')}
 AND  (user_weight <> 0 || user_weight IS NOT NULL)
GROUP BY date
ORDER BY date DESC LIMIT 1
";
$chartrows = $this->common_model->custom_query($sql);
$bmr_last = 0;
foreach ($chartrows as $key => $value) {
 		$user_weight_last =  $value['user_weight'];
	$user_weight_date = $value['date_exam'];
}

#echo 'last : '.$user_weight_date.' = '.$user_weight_last.'<hr>';

$user_flname = $user['user_fname'] . ' ' . $user['user_lname'];
$user_height = $user['user_height'];
$user_sex = $user['user_sex'];
$age = getAge($user['date_of_birth']);
$sql = "
SELECT
a.*
,DATE(a.date_exam) as date
FROM users_exam_weight as a
WHERE
(date_exam BETWEEN '$strdate 00:00:00' AND '$enddate 23:59:59') AND
a.fag_allow='allow' AND a.user_id={$this->session->userdata('user_id')}
GROUP BY date
ORDER BY date ASC
";

$chartrows = $this->common_model->custom_query($sql);
$bmr_last = 0;
foreach ($chartrows as $key => $value) {
 	$user_weight = ($value['user_weight'] <> '') ? $value['user_weight']  : $user_weight_last;
	$bmi_val = $value['user_weight'] / ((floatval($user_height) / 100) * (floatval($user_height) / 100));
	$bmr_val = 0;
	$calo_val = 0;
	if ($user_sex == 'ชาย') {
		$bmr_val = 66 + (13.7 * $value['user_weight']) + (5 * $user_height) - (6.8 * $age);
	} else if ($user_sex == 'หญิง') {
		$bmr_val = 665 + (9.6 * $value['user_weight']) + (1.8 * $user_height) - (4.7 * $age);
	}

	#$bmi_date_array[$value['date']] = round($bmi_val);
	$sum = $bmr_val;
	$bmr_date_array[$value['date']] = $sum;
	// echo '<pre>';
	// print_r($bmr_date_array[$value['date']]);
	// echo '</pre>';
	// die();
}

// $sql_bmr_last = "
// SELECT
// a.*
// ,DATE(a.date_exam) as date
// FROM users_exam_weight as a
// WHERE
// a.fag_allow='allow' AND a.user_id={$this->session->userdata('user_id')}
// GROUP BY date
// ORDER BY date ASC
// LIMIT 0,1
// ";
// $return_bmr_last = $this->common_model->custom_query($sql_bmr_last);

// foreach ($return_bmr_last as $key => $value) {

// 	$bmi_val = $value['user_weight'] / ((floatval($user_height) / 100) * (floatval($user_height) / 100));
// 	$bmr_val = 0;
// 	$calo_val = 0;
// 	if ($user_sex == 'ชาย') {
// 		$bmr_val = 66 + (13.7 * $value['user_weight']) + (5 * $user_height) - (6.8 * $age);
// 	} else if ($user_sex == 'หญิง') {
// 		$bmr_val = 665 + (9.6 * $value['user_weight']) + (1.8 * $user_height) - (4.7 * $age);
// 	}

// 	#$bmi_date_array[$value['date']] = round($bmi_val);
// 	$sum = $bmr_val;
// 	$bmr_last_date_array = $sum;
// 	// echo '<pre>';
// 	// print_r($bmr_last_date_array[$value['date']]);
// 	// echo '</pre>';
// 	// die();

#print_r($bmr_date_array);

$bmrcate = '';

foreach ($bmr_date_array as $key => $value) {

	if ($value == 0) {
		if($bmr_last == 0){


			$bmi_val = $value['user_weight'] / ((floatval($user_height) / 100) * (floatval($user_height) / 100));
			$bmr_val = 0;
			$calo_val = 0;
			if ($user_sex == 'ชาย') {
				$value = 66 + (13.7 * $user_weight_last) + (5 * $user_height) - (6.8 * $age);
			} else if ($user_sex == 'หญิง') {
				$value = 665 + (9.6 * $user_weight_last) + (1.8 * $user_height) - (4.7 * $age);
			}

		} else {
			  $value = $bmr_last;
		}



 	}
	$set = date("d/m", strtotime($key)) . '/' . $year;
	$bmrcate .= ",'" . $set . "'";
	$bmr .= ',' . $value;
	$bmr_last = $value;
	// echo '<pre>';
	// echo('<br>');
	// print_r($bmr_date_array);
	// print_r($bmr_last_date_array);
	// echo('<br>');
	// print_r('before_value = '.$value);
	// echo('<br>');
	// print_r('after_value = '.$value);
	// echo('<br>');
	// echo('<br>');
	// echo '</pre>';
	// die();
}

/* ------------------------------------------------------------------------------------ */

if ($this->input->post('bmi_strdate')) {
	$year = date("Y") + 543;
	$bmi_strdate = getDateC($this->input->post('bmi_strdate'));
	$bmi_enddate =  getDateC($this->input->post('bmi_enddate'));
} else {
	$year = date("Y") + 543;
	$bmi_enddate = date("Y-m-d");
	$bmi_strdate = date('Y-m-d', strtotime($bmi_enddate . "-5 days"));
}


$bmi_date_array = array();
$bmi_period = displayDates($bmi_strdate, $bmi_enddate);
foreach ($bmi_period as $key => $value) {
	$date_array[$value] = 0;
	$bmi_date_array[$value] = 0;
}


$sql = "

SELECT

	DATE( a.date_eat ) AS date
	,SUM(a.food_energy)/1000 as energy
	,a.*
FROM
	users_food_time AS a
WHERE
	( date_eat BETWEEN '$bmi_strdate 00:00:00' AND '$bmi_enddate 23:59:59' )
	AND a.fag_allow = 'allow'
	AND a.user_id = {$this->session->userdata('user_id')}
GROUP BY
	date
ORDER BY
	date
 ASC
";
// echo $sql;


$bmi_data = $this->common_model->custom_query($sql);
$year = date("Y") + 543;
$bmicate = '';
$bmi_last = '0';
foreach ($bmi_data as $key => $value) {
	$bmi_date_array[$value['date']] =   number_format($value['energy'], 2);
}


foreach ($bmi_date_array as $key => $value) {
	if ($value == 0) {
		$value = $bmi_last;
	}

	$set = date("d/m", strtotime($key)) . '/' . $year;
	$bmicate .= ",'" . $set . "'";
	$bmi .= ',' . str_replace(',', '', $value);
	$bmi_last = $value;
}



?>
<div class="container-fluid">
	<br>
	<div class="container-fluid">

	<div class="row">
		<div class="col-md-4">
			<div class="card card-profile">
				<div class="card-avatar">
					<img class="img" src="{user_photo}">
				</div>
				<div class="card-body" style="margin-top:0;">
					<h4 class=" card-title">{user_flname}</h4>
					<p class="card-description">
						วันเดือนปีเกิด: {date_of_birth}
						<br>
						อายุ {age} ปี
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-2">
			<div class="card card-stats">
				<div class="card-header card-header-drak card-header-icon">
					<h2 class="card-title text-drak">{user_height}</h2>
				</div>
				<div class="card-footer">
					<br><br>
					<div class="stats">
						<p class="card-category text-drak">ส่วนสูง (ซ.ม.)</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-2">
			<div class="card card-stats">
				<div class="card-header card-header-drak card-header-icon">
					<h2 class="card-title text-drak">{users_exam_weight}</h2>
				</div>
				<div class="card-footer">
					<br><br>
					<div class="stats">
						<p class="card-category text-drak">น้ำหนัก (ก.ก.)</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-2">
			<div class="card card-stats">
				<div class="card-header card-header-drak card-header-icon">
					<h2 class="card-title text-drak">{users_exam_waistline}</h2>
				</div>
				<div class="card-footer">
					<br><br>
					<div class="stats">
						<p class="card-category text-drak">รอบเอว (ซ.ม.)</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-2">
			<div class="card card-stats">
				<div class="card-header card-header-drak card-header-icon">
					<h2 class="card-title text-drak">{users_exam_hip}</h2>
				</div>
				<div class="card-footer">
					<br><br>
					<div class="stats">
						<p class="card-category text-drak">รอบสะโพก (ซ.ม.)</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>

	<!-- Icon Cards-->
	<div class="container-fluid">
		<div class="row" style="margin-top: -22px">
			<div class="card col-sm-12">
				<div class="card-body">
					<h1 width="30%">{users_bmi} BMI {users_bmi_txt}</h1>
					<div class="row">
						<div class="col-md-2 d-flex pb-3" style="text-align: center; font-size: 14px; font-weight:bold;">
							<div class="card" style=<?php echo ($users_bmi < 18.5) ? "background-color:#A4A4A1" : "background-color:#FFFFFF";?>>
								<div class="card-body">
									<span>น้ำหนักน้อยกว่ามาตรฐาน</span>
									<br>
									<span>  < 18.5 </span>
								</div>
							</div>
						</div>
						<div class="col-md-2 d-flex pb-3" style="text-align: center; font-size: 14px; font-weight:bold;">
							<div class="card" style=<?php echo ($users_bmi >= 18.5 && $users_bmi < 24.9) ? "background-color:#A4A4A1" : "background-color:#FFFFFF";?>>
								<div class="card-body">
									<span>น้ำหนักปกติ</span>
									<br>
									<span> 18.5 - 24.9 </span>
								</div>
							</div>
						</div>
						<div class="col-md-2 d-flex pb-3" style="text-align: center; font-size: 14px; font-weight:bold;">
							<div class="card" style=<?php echo ($users_bmi >= 25 && $users_bmi < 29.9) ? "background-color:#A4A4A1" : "background-color:#FFFFFF";?>>
								<div class="card-body">
									<span>อ้วนระดับ 1</span>
									<br>
									<span> 25 - 29.9 </span>
								</div>
							</div>
						</div>
						<div class="col-md-2 d-flex pb-3" style="text-align: center; font-size: 14px; font-weight:bold;">
							<div class="card" style=<?php echo ($users_bmi >= 30 && $users_bmi < 34.9) ? "background-color:#A4A4A1" : "background-color:#FFFFFF";?>>
								<div class="card-body">
									<span>อ้วนระดับ 2</span>
									<br>
									<span> 30 - 34.9 </span>
								</div>
							</div>
						</div>
						<div class="col-md-2 d-flex pb-3" style="text-align: center; font-size: 14px; font-weight:bold;">
							<div class="card" style=<?php echo ($users_bmi >= 35 && $users_bmi < 39.9) ? "background-color:#A4A4A1" : "background-color:#FFFFFF";?>>
								<div class="card-body">
									<span>อ้วนระดับ 3</span>
									<br>
									<span> 35 - 39.9 </span>
								</div>
							</div>
						</div>
						<div class="col-md-2 d-flex pb-3" style="text-align: center; font-size: 14px; font-weight:bold;">
							<div class="card" style=<?php echo ($users_bmi > 40) ? "background-color:#A4A4A1" : "background-color:#FFFFFF";?>>
								<div class="card-body">
									<span>อ้วนระดับ 4</span>
									<br>
									<span> > 40 </span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-12">
			<div class="card">
				<div class="card-header card-header-tabs card-header-logo">
					<div class="nav-tabs-navigation">
						<div class="nav-tabs-flex-wrap">
							<h4 class="nav-tabs-title-left">BMR Chart</span>
								<h4 class="nav-tabs-title-right">{chart_bmr_credit}</span>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="tab-content">
						<div class="tab-pane active">


							<div class="row">

								<div class="col-12 text-center">
									<form class="form-horizontal" method="post" action="dashboard_user">
										{csrf_protection_field}

										เรียกดูข้อมูล
										<input type="text" name="bmr_strdate" class="text-center form-control datepicker" style="width: 150px; display:inline-block;" required value="<?php echo date('d/m', strtotime($strdate)) . '/' . $year; ?>">
										ถึง
										<input type="text=" name="bmr_enddate" class="text-center form-control datepicker" style="width: 150px; display:inline-block;" required value="<?php echo date('d/m', strtotime($enddate)) . '/' . $year; ?>">

										<button class="btn btn-success btn-sm">เรียกดู</button>
									</form>
								</div>

							</div>

							<figure class="highcharts-figure">
								<div style="height: 270px;" id="chartContainer2"></div>
							</figure>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<div class="stats">
						<?php echo date("d/m") . '/' . (date("Y") + 543) . ' ' . date("H:i:s"); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12">
			<div class="card">
				<div class="card-header card-header-tabs card-header-logo">
					<div class="nav-tabs-navigation">
						<div class="nav-tabs-flex-wrap">
							<h4 class="nav-tabs-title-left">Calories</span>
								<h4 class="nav-tabs-title-right">{chart_calo_credit}</span>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="tab-content">
						<div class="tab-pane active">
							<div class="row">

								<div class="col-12 text-center">
									<form class="form-horizontal" method="post" action="dashboard_user">
										{csrf_protection_field}

										เรียกดูข้อมูล
										<input type="text" name="bmi_strdate" class="text-center form-control datepicker" style="width: 150px; display:inline-block;" required value="<?php echo date('d/m', strtotime($bmi_strdate)) . '/' . $year; ?>">
										ถึง
										<input type="text=" name="bmi_enddate" class="text-center form-control datepicker" style="width: 150px; display:inline-block;" required value="<?php echo date('d/m', strtotime($bmi_enddate)) . '/' . $year; ?>">

										<button class="btn btn-success btn-sm">เรียกดู</button>
									</form>
								</div>

							</div>
							<figure class="highcharts-figure">
								<div style="height: 270px;" id="chartContainer1"></div>
							</figure>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<div class="stats">
						<?php echo date("d/m") . '/' . (date("Y") + 543) . ' ' . date("H:i:s"); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<script>
	Highcharts.chart('chartContainer1', {

		title: {
			text: 'Kilocalories'
		},

		subtitle: false,
		credits: {
			enabled: false
		},
		legend: {
			enable: true
		},

		xAxis: {
			categories: [<?php echo substr($bmicate, 1); ?>],

			labels: {
				rotation: 0
			}
		},
		yAxis: {
			title: ''
		},
		plotOptions: {
			line: {
				dataLabels: {
					enabled: false
				},
				enableMouseTracking: true
			}
		},

		series: [{
			name: 'User',
			data: [<?php echo substr($bmi, 1); ?>]
		}],

		responsive: {
			rules: [{
				condition: {
					maxWidth: 500
				},
				chartOptions: {
					legend: {
						enabled: false
					}
				}
			}]
		}

	});
</script>



<script>
	Highcharts.chart('chartContainer2', {

		title: {
			text: 'Kilocalories'
		},

		subtitle: false,
		credits: {
			enabled: false
		},
		legend: {
			enable: true
		},

		xAxis: {
			categories: [<?php echo substr($bmrcate, 1); ?>],
			labels: {
				rotation: 0
			}
		},
		yAxis: {
			title: ''
		},
		plotOptions: {
			line: {
				dataLabels: {
					enabled: true
				},
				enableMouseTracking: true
			}
		},

		series: [{
			name: 'User',
			data: [<?php echo substr($bmr, 1); ?>],
		}],

		responsive: {
			rules: [{
				condition: {
					maxWidth: 500
				},
				chartOptions: {
					legend: {
						enabled: true
					}
				}
			}]
		}
	});
</script>
<input type="hidden" id="update_data" name="update_data" value="<?php echo @$_GET['update_data'] ?>" />
<!-- Modal -->
<div class="modal fade" id="warningModal" tabindex="1" role="dialog" aria-labelledby="warningModalLabel" aria-hidden="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="warningModalLabel"></h4>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<p class="alert alert-warning">กรุณาอัพเดทข้อมูล น้ำหนัก และผลการตรวจเลือด</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning" data-dismiss="modal">&nbsp;Skip&nbsp;</button>&emsp;
			</div>
		</div>
	</div>
</div>