<style>
	.nav-tabs-flex-wrap .nav-tabs-title-left {
		float: left !important;
	}

	.nav-tabs-flex-wrap .nav-tabs-title-right {
		float: right !important;
	}
</style>
<script>
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
</script>
<div class="container-fluid">
	<div class="row">
		<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
			<div class="card card-stats">
				<div class="col-sm-4" style="padding-top: 10px;">
					<img style="border-radius:50%" src="{user_photo}" height="100" width="100">
				</div>
				<div class="mr-5" style="position:absolute; top:20px; left: 120px;float: right">
					<h4 style="font-weight:bold; font-size: 15px;">&nbsp;&nbsp{user_flname}</h4>
					<span class="float-left" style="color:#333; font-size: 13px;">&nbsp;&nbsp;วันเดือนปีเกิด: {date_of_birth}<br />&nbsp;&nbsp;อายุ {age} ปี</span>
				</div>
				<div class="card-footer">
					<div class="stats">
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-2 col-lg-3 col-md-6 col-sm-12">
			<div class="card card-stats">
				<div class="card-header card-header-drak card-header-icon">
					<h2 class="card-title text-drak">{user_height}</h2>
				</div>
				<div class="card-footer">
					<div class="stats">
						<p class="card-category text-drak">ส่วนสูง (ซ.ม.)</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-2 col-lg-3 col-md-6 col-sm-12">
			<div class="card card-stats">
				<div class="card-header card-header-drak card-header-icon">
					<h2 class="card-title text-drak">{users_exam_weight}</h2>
				</div>
				<div class="card-footer">
					<div class="stats">
						<p class="card-category text-drak">น้ำหนัก (ก.ก.)</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-2 col-lg-3 col-md-6 col-sm-12">
			<div class="card card-stats">
				<div class="card-header card-header-drak card-header-icon">
					<h2 class="card-title text-drak">{users_exam_waistline}</h2>
				</div>
				<div class="card-footer">
					<div class="stats">
						<p class="card-category text-drak">รอบเอว (ซ.ม.)</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-2 col-lg-3 col-md-6 col-sm-12">
			<div class="card card-stats">
				<div class="card-header card-header-drak card-header-icon">
					<h2 class="card-title text-drak">{users_exam_hip}</h2>
				</div>
				<div class="card-footer">
					<div class="stats">
						<p class="card-category text-drak">รอบสะโพก (ซ.ม.)</p>
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
					<!-- <img style="top:0px;     margin-top: -60px; float:right" src="{base_url}assets/images/bmi.PNG"> -->
					<div class="row">
						<div class="col-sm-2" style="background-color:#DBFF33; text-align: center; font-size: 14px; font-weight:bold; padding-top:20px; padding-bottom: 20px;">
							น้ำหนักหน่อยกว่ามาตรฐาน &nbsp;&nbsp;< 18.5 </div> <div class="col-sm-2" style="background-color:#47A44B; text-align: center; font-size: 14px; font-weight:bold; padding-top:20px; padding-bottom: 20px;">
								น้ำหนักปกติ 18.5 - 24.9
						</div>
						<div class="col-sm-2" style="background-color:#E83E80; text-align: center; font-size: 14px; font-weight:bold; padding-top:20px; padding-bottom: 20px;">
							อ้วนระดับ 1 25 - 29.9
						</div>
						<div class="col-sm-2" style="background-color:#AF7AC5; text-align: center; font-size: 14px; font-weight:bold; padding-top:20px; padding-bottom: 20px;">
							อ้วนระดับ 2 30 - 34.9
						</div>
						<div class="col-sm-2" style="background-color:#F08F00; text-align: center; font-size: 14px; font-weight:bold; padding-top:20px; padding-bottom: 20px;">
							อ้วนระดับ 3 35 - 39.9
						</div>
						<div class="col-sm-2" style="background-color:#F33527; text-align: center; font-size: 14px; font-weight:bold; padding-top:20px; padding-bottom: 20px;">
							อ้วนระดับ >40
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-12">
			<div class="card">
				<div class="card-header card-header-tabs card-header-warning">
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
		<div class="col-lg-6 col-md-6 col-sm-12">
			<div class="card">
				<div class="card-header card-header-tabs card-header-warning">
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
	</div>
</div>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<!-- <script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script> -->

<?php
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

$enddate = date("Y-m-d");
$strdate = date('Y-m-d', strtotime($enddate . "-5 days"));
$bmi = '';
$bmr = '';

$bmi_date_array = array();
$bmr_date_array = array();

$period = new DatePeriod(
	new DateTime($strdate),
	new DateInterval('P1D'),
	new DateTime($enddate)
);
foreach ($period as $key => $value) {
	$date_array[$value->format('Y-m-d')] = 0;
	$bmi_date_array[$value->format('Y-m-d')] = 0;
	$bmr_date_array[$value->format('Y-m-d')] = 0;
}


$user = rowArray($this->common_model->custom_query("select * from users where user_id={$this->session->userdata('user_id')} limit 1"));

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
ORDER BY date LIMIT 10
";

$chartrows = $this->common_model->custom_query($sql);
foreach ($chartrows as $key => $value) {

	$bmi_val = $value['user_weight'] / ((floatval($user_height) / 100) * (floatval($user_height) / 100));
	$bmr_val = 0;
	$calo_val = 0;
	if ($user_sex == 'ชาย') {
		$bmr_val = 66 + (13.7 * $value['user_weight']) + (5 * $user_height) - (6.8 * $age);
		//$calo_val = floatval($value['user_weight'])*31;
	} else if ($user_sex == 'หญิง') {
		$bmr_val = 665 + (9.6 * $value['user_weight']) + (1.8 * $user_height) - (4.7 * $age);
		//$calo_val = floatval($value['user_weight'])*27;
	}


	$bmi_date_array[$value['date']] = round($bmi_val);

	$sum = round($bmr_val / 1000);
	$bmr_date_array[$value['date']] = $sum;
	#echo $value['date'] . ' ' . $sum . '<br>';
}
$year = date("Y") + 543;
$bmicate = '';
foreach ($bmi_date_array as $key => $value) {
	$set = date("d/m", strtotime($key)) . '/' . $year;
	$bmicate .= ",'" . $set . "'";
	$bmi .= ',' . $value;
}

$bmrcate = '';
foreach ($bmr_date_array as $key => $value) {
	$set = date("d/m", strtotime($key)) . '/' . $year;
	$bmrcate .= ",'" . $set . "'";
	$bmr .= ',' . $value;
}

?>
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
			data: [<?php echo substr($bmr, 1); ?>]
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
