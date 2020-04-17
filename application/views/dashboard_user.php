<style>
	.nav-tabs-flex-wrap .nav-tabs-title-left{
		float: left!important;
	}
	.nav-tabs-flex-wrap .nav-tabs-title-right{
		float: right!important;
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
                น้ำหนักหน่อยกว่ามาตรฐาน &nbsp;&nbsp;< 18.5
              </div>
              <div class="col-sm-2" style="background-color:#47A44B; text-align: center; font-size: 14px; font-weight:bold; padding-top:20px; padding-bottom: 20px;">
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
