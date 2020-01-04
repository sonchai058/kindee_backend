<script>
  var chart_labels = {chart_labels};
  var chart_labels_calo = {chart_labels_calo};
  var chart_bmi = JSON.parse('{chart_bmi}');
  var chart_bmr = JSON.parse('{chart_bmr}');
  var chart_bmr1 = {chart_bmr1};
  var chart_calo1 = {chart_calo1};
  var chart_calo = JSON.parse('{chart_calo}');

</script>

      <!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-4 col-sm-6 mb-4" style="padding:0">
          <div class="card text-white bg-default o-hidden h-100">
            <div class="card-body" style="padding: 0;padding-top: 5px;color:#333;">
            <div class="col-sm-4" style="padding: 10px;">
              <img style="border-radius:50%" src="{user_photo}" height="100"  width="100">
            </div>
              <div class="mr-5" style="position:absolute; top:20px; left: 120px;float: right">
              <h4 style="font-weight:bold; font-size: 15px;">&nbsp;&nbsp{user_flname}</h4>
              <span class="float-left" style="color:#333; font-size: 13px;">&nbsp;&nbsp;วันเดือนปีเกิด: {date_of_birth}<br/>&nbsp;&nbsp;อายุ {age} ปี</span>
              <br/>
            </div>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-sm-6 mb-2" style="padding:0">
          <div class="card text-white bg-default o-hidden" style="height: 128px;">
            <div class="card-body" style="color:#333;">
              <div class="mr-5" ><h2>{user_height}</h2>
                <span class="float-left" style="color:#333;font-size:13px">ส่วนสูง (ซ.ม.)</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-sm-6 mb-2" style="padding:0">
          <div class="card text-white bg-default o-hidden" style="height: 128px;">
            <div class="card-body" style="color:#333">
              <div class="mr-5"><h2>{users_exam_weight}</h2><span class="float-left" style="color:#333;font-size:13px">น้ำหนัก (ก.ก.)</span></div>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-sm-6 mb-2" style="padding:0">
          <div class="card text-white bg-default o-hidden" style="height: 128px;">
            <div class="card-body" style="color:#333">
              <div class="mr-5"><h2>{users_exam_waistline}</h2><span class="float-left" style="color:#333;font-size:13px">รอบเอว (ซ.ม.)</span></div>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-sm-6 mb-2" style="padding:0">
          <div class="card text-white bg-default o-hidden" style="height: 128px;">
            <div class="card-body" style="color:#333">
              <div class="mr-5"><h2>{users_exam_hip}</h2><span class="float-left" style="color:#333;font-size:13px">รอบสะโพก (ซ.ม.)</span></div>
            </div>
          </div>
        </div>
      </div>

      <div class="row" style="margin-top: -22px">
        <div class="card col-sm-12">
          <div class="card-body">
            <h1 width="30%">{users_bmi} BMI {users_bmi_txt}</h1>
            <!-- <img style="top:0px;     margin-top: -60px; float:right" src="{base_url}assets/images/bmi.PNG"> -->
            <div class="row">
              <div class="col-sm-2" style="background-color:#FFFF00; text-align: center; font-size: 11px; padding-top:20px; padding-bottom: 20px;">
                น้ำหนักหน่อยกว่ามาตรฐาน < 18.5
              </div>
              <div class="col-sm-2" style="background-color:#00CD00; text-align: center; font-size: 11px; padding-top:20px; padding-bottom: 20px;">
                น้ำหนักปกติ 18.5 - 24.9
              </div>
              <div class="col-sm-2" style="background-color:#FF6A6A; text-align: center; font-size: 11px; padding-top:20px; padding-bottom: 20px;">
                อ้วนระดับ 1 25 - 29.9
              </div>
              <div class="col-sm-2" style="background-color:#8B658B; text-align: center; font-size: 11px; padding-top:20px; padding-bottom: 20px;">
                อ้วนระดับ 2 30 - 34.9
              </div>
              <div class="col-sm-2" style="background-color:#EEB422; text-align: center; font-size: 11px; padding-top:20px; padding-bottom: 20px;">
                อ้วนระดับ 3 35 - 39.9
              </div>
              <div class="col-sm-2" style="background-color:#EE2C2C; text-align: center; font-size: 11px; padding-top:20px; padding-bottom: 20px;">
                อ้วนระดับ >40
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Area Chart Example-->
        <div class="card col-sm-6">
          <div class="card-header" style="background: #fff !important">
            <i class="fa fa-area-chart"></i> <b>BMR Chart</b>
            <div style="float:right">{chart_bmr_credit}</div>
          </div>
          <div class="card-body">
            <!-- <canvas id="myAreaChart1" width="100%" height="30"></canvas>-->
            <div id="chartContainer1" style="height: 270px; width: 100%;"></div>
          </div>
          <!--<div class="card-footer small text-muted">BMR : {chart_bmr_credit}</div>-->
        </div>

        <!-- Area Chart Example-->
        <div class="card col-sm-6">
          <div class="card-header" style="background: #fff !important">
            <i class="fa fa-area-chart"></i> <b>Calories</b>
            <div style="float:right">{chart_calo_credit}</div>
          </div>
          <div class="card-body">
            <div id="chartContainer2" style="height: 270px; width: 100%;"></div>
            <!-- <canvas id="myAreaChart2" width="100%" height="30"></canvas>-->
          </div>
         <!-- <div class="card-footer small text-muted">{chart_calo_credit}</div>-->
        </div>
      </div>
    </div>

<!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>-->