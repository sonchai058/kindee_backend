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
						<p class="card-category text-success">สมาชิก VIP</p>
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
							<h4 class="nav-tabs-title">สถิติการเข้าใช้งาน</span>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="tab-content">
						<div class="tab-pane active">
							<figure class="highcharts-figure">
								<div style="height: 270px;" id="container1"></div>
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
