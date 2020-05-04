<!-- chart -->
<style type="text/css">
	.highcharts-figure,
	.highcharts-data-table table {
		min-width: 360px;
		max-width: 100%;
		margin: 1em auto;

	}

	.highcharts-data-table table {
		font-family: Verdana, sans-serif;
		border-collapse: collapse;
		border: 1px solid #EBEBEB;
		margin: 10px auto;
		text-align: center;
		width: 100%;
		max-width: 500px;
	}

	.highcharts-data-table caption {
		padding: 1em 0;
		font-size: 1.2em;
		color: #555;
	}

	.highcharts-data-table th {
		font-weight: 600;
		padding: 0.5em;
	}

	.highcharts-data-table td,
	.highcharts-data-table th,
	.highcharts-data-table caption {
		padding: 0.5em;
	}
</style>
<script>
	var chart_labels = {
		chart_labels
	};
	var chart_data = JSON.parse('{chart_data}');
	var chart_data1 = {
		chart_data1
	};
	/*
		var chart_labels2 = {
			chart_labels2
		};
		var chart_data2 = JSON.parse('{chart_data2}');
		var chart_data12 = {
			chart_data12
		};*/
</script>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-4 col-md-6 col-sm-12">
			<div class="card card-stats">
				<div class="card-header card-header-dark card-header-icon">
					<div class="card-icon">
						<i class="material-icons">supervisor_account</i>
					</div>
					<h1 class="card-title text-dark">{userCount1}
						<!-- <small>GB</small> -->
					</h1>
				</div>
				<div class="card-footer">
					<div class="stats">
						<p class="card-category text-dark">สมาชิกทั้งหมด</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-6 col-sm-12">
			<div class="card card-stats">
				<div class="card-header card-header-info card-header-icon">
					<div class="card-icon">
						<i class="material-icons">person</i>
					</div>
					<h1 class="card-title text-info">{userCount2}</h1>
				</div>
				<div class="card-footer">
					<div class="stats">
						<p class="card-category text-info">สมาชิกทั่วไป</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-6 col-sm-12">
			<div class="card card-stats">
				<div class="card-header card-header-success card-header-icon">
					<div class="card-icon">
						<i class="material-icons">how_to_reg</i>
					</div>
					<h1 class="card-title text-success">{userCount3}</h1>
				</div>
				<div class="card-footer">
					<div class="stats">
						<p class="card-category text-success">Super User</p>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="card">
				<div class="card-header card-header-tabs card-header-warning">
					<div class="nav-tabs-navigation">
						<div class="nav-tabs-wrapper">
							<h4 class="nav-tabs-title">สถิติการเข้าใช้งาน</h4>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="tab-content">
						<div class="tab-pane active">

							<?php


							$year = date("Y") + 543;
							$enddate = date("Y-m-d");
							$strdate = date('Y-m-d', strtotime($enddate . "-14 days"));

							/* create list day */
							$period = new DatePeriod(
								new DateTime($strdate),
								new DateInterval('P1D'),
								new DateTime($enddate)
							);

							#$date_array = array();
							foreach ($period as $key => $value) {
								$day = $value->format('Y-m-d');
								$date_array[$day] = 0;
							}

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
							foreach ($chart as $key => $value) {
								$dateValue = $value['date'];
								$numValue = $value['num'];
								$date_array[$dateValue] = $numValue;
							}
							$values = '';
							$dates = '';
							foreach ($date_array as $key => $value) {
								$set = date('d/m', strtotime($key)) . '/' . $year . '<br>';
								$values .= ',' . $value;

								$dates .= ",'" . $set . "'";
							}

							/* create list day */
							?>
							<figure class="highcharts-figure">
								<div class="container1">
									<div class="text-center">
										<h3>จำนวนการเข้าใช้งาน</h3>
										<div style="font-size: 16px;">วันที่ <span style="font-weight: bold"><?php echo date('d/m', strtotime($strdate)) . '/' . $year; ?></span> ถึง <span style="font-weight: bold"><?php echo date('d/m', strtotime($enddate)) . '/' . $year; ?></span></div>
									</div>
									<div style="height: 270px;" id="container1"></div>
								</div>
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
<?php #exit;
?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script>
	Highcharts.chart('container1', {

		title: {
			text: ''
		},

		subtitle: {
			text: ''
		},

		yAxis: {
			title: {
				text: ''
			}
		},

		xAxis: {
			categories: [<?php echo substr($dates, 1); ?>]
		},
		credits: {
			enabled: false
		},

		legend: {
			enable: true
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
			name: 'จำนวนการเข้าใช้งาน ',
			data: [<?php echo substr($values, 1); ?>]
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
