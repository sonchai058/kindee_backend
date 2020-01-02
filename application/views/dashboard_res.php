<script>
  var point_lat = {point_lat};
  var point_long = {point_long};
</script>

    <div class="card">
      <div class="card-body">
      <!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-8 col-sm-12">
          <div class="card text-white bg-default o-hidden h-100">
            <div class="card-body" style="padding: 0;padding-top: 5px;color:#333;">
            <div class="col-sm-4">
              <img src="{shop_photo}" height="200" width="200">
            </div>
              <div class="mr-5" style="position:absolute; top:20px; left: 220px;float: right">(<b>{shop_name_th}</b>)<br/>
              <a style="float:left" class="" href="#">
              <span class="float-left" style="color:#333">
                ประเภท : ร้านอาหาร{cate_name}<br/>
                เบอร์โทร : {mobile_no}<br/>
                อีเมล : {email_addr}<br/>
                ที่อยู่ : {addr}<br/>
              </span>
              </a>
              </div>
            </div>

          </div>
        </div>
        <div class="col-xl-4 col-sm-12">
          <div id="map" style="width:350px;height:300px;"></div>
        </div>
    </div>
</div>

    <div class="card">
      <div class="card-body">
        <h3>เมนูอาหาร</h3>
      <div class="row">
        <!-- Area Chart Example-->
        {shop_food_menu_images}
      </div>
      </div>
    </div>

<!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <!-- <h4 class="modal-title" id="myModalLabel">Image preview</h4>-->
      </div>
      <div class="modal-body text-center">
        <img src="" id="imagepreview" style="max-height: 400px;" >
      </div><!--
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div>
  </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmtoJRjQwBbRpG89moh1jXZRwoviIsqf0&libraries=places" async defer></script>
