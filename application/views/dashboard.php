<script>
  var chart_labels = {chart_labels};
  var chart_data = JSON.parse('{chart_data}');
</script>
      <!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-4 col-sm-6 mb-4">
          <div class="card text-white bg-default o-hidden h-100">
            <div class="card-body" style="color:#333; padding-right: 5px !important">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-user-friends" style="font-size: 80px;"></i>
              </div>
              <div style="float:right; margin-top:-70px; font-size: 18px; font-weight: bold; text-align: right;" class="mr-5">สมาชิกทั้งหมด <br/>{userCount1}</div>
              
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-4">
          <div class="card text-white bg-default o-hidden h-100">
            <div class="card-body" style="color:#333; padding-right: 5px !important">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-user" style="font-size: 80px; color: #ec9d3d"></i>
              </div>
              <div style="color: #ec9d3d;float:right; margin-top:-70px; font-size: 18px; font-weight: bold; text-align: right;"  class="mr-5">สมาชิกทั่วไป <br/>{userCount2}</div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-4">
          <div class="card text-white bg-default o-hidden h-100">
            <div class="card-body" style="color:#333; padding-right: 5px !important">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-user-check" style="font-size: 80px; color: #30dc1b"></i>
              </div>
              <div style="color:#30dc1b;float:right; margin-top:-70px; font-size: 18px; font-weight: bold; text-align: right;"  class="mr-5">สมาชิก VIP <br/>{userCount3}</div>
            </div>
          </div>
        </div>
      </div>
      <!-- Area Chart Example-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i> <b>สถิติการเข้าใช้งาน</b></div>
        <div class="card-body">
          <canvas id="myAreaChartD" width="100%" height="30"></canvas>
        </div>
        <div class="card-footer small text-muted"><?php echo date("d/m").'/'.(date("Y")+543).' '.date("H:i:s");?></div>
      </div>
    </div>
