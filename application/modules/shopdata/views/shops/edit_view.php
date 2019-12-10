<!--  [ View File name : edit_view.php ] -->
	<div class="card">
	<!--	
		<div class="card-header bg-primary">
			<h3 class="card-title"><i class="fa fa-edit"></i> แก้ไขข้อมูล <strong>shops</strong></h3>
		</div>
	-->
		<div class="card-body">
			<form class='form-horizontal' id='formEdit' accept-charset='utf-8'>
				{csrf_protection_field}
				<input type="hidden" name="submit_case" value="edit" />
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='cate_id'>ชื่อประเภทร้าน  :</label>
					<div class='col-sm-10'>
					<select id='cate_id'  name='cate_id' value="{record_cate_id}" >
						<option value="">- เลือก ชื่อประเภทร้าน -</option>
						{category_cate_id_option_list}
					</select>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='shop_photo'>รูปโปรไฟล์  :</label>
					<div class='col-sm-10'>

						<div class="upload-box">
							<div class="hold input-group">
								<span class="btn-file"> คลิกเพื่อแนบไฟล์
									<input type="file" id="shop_photo" name="shop_photo" data-elem-preview="shop_photo_preview" data-elem-label="shop_photo_label" />
								</span><input class="form-control" id="shop_photo_label" name="shop_photo_label" 
									placeholder="กรุณาเลือกไฟล์ที่ต้องการอัพโหลด"  readonly="readonly" value="{record_shop_photo_label}" />
							</div>
						</div>
						 {preview_shop_photo}
						<input type="hidden" id="shop_photo_old_path" name="shop_photo_old_path" value="{record_shop_photo}" />
						<div style="clear:both"></div>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='shop_cover'>รูปปก  :</label>
					<div class='col-sm-10'>

						<div class="upload-box">
							<div class="hold input-group">
								<span class="btn-file"> คลิกเพื่อแนบไฟล์
									<input type="file" id="shop_cover" name="shop_cover" data-elem-preview="shop_cover_preview" data-elem-label="shop_cover_label" />
								</span><input class="form-control" id="shop_cover_label" name="shop_cover_label" 
									placeholder="กรุณาเลือกไฟล์ที่ต้องการอัพโหลด"  readonly="readonly" value="{record_shop_cover_label}" />
							</div>
						</div>
						 {preview_shop_cover}
						<input type="hidden" id="shop_cover_old_path" name="shop_cover_old_path" value="{record_shop_cover}" />
						<div style="clear:both"></div>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='shop_name_th'>ชื่อไทย  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="shop_name_th" name="shop_name_th" value="{record_shop_name_th}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='shop_name_en'>ชื่ออังกฤษ  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="shop_name_en" name="shop_name_en" value="{record_shop_name_en}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='mobile_no'>มือถือ  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="mobile_no" name="mobile_no" value="{record_mobile_no}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='email_addr'>อีเมล  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="email_addr" name="email_addr" value="{record_email_addr}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='shop_user'>ชื่อผู้ดูแล  :</label>
					<div class='col-sm-10'>
					<select id='shop_user'  name='shop_user' value="{record_shop_user}" >
						<option value="">- เลือก ชื่อผู้ดูแล -</option>
						{users_shop_user_option_list}
					</select>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='addr'>เลขที่ ที่อยู่  :</label>
					<div class='col-sm-10'>

						<textarea  class="form-control" id="addr" name="addr" rows="5">{record_addr}</textarea>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='fag_allow'>สถานะ  :</label>
					<div class='col-sm-10'>

						<select id="fag_allow" name="fag_allow" value="{record_fag_allow}" >
							<option value="">- เลือก สถานะ -</option>
							<option value="allow">เผยแพร่</option>
							<option value="block">ไม่เผยแพร่</option>
							<option value="delete">ลบ</option>
						</select>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='point_lat'>พิกัด ละติจูด  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="point_lat" name="point_lat" value="{record_point_lat}"  />
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-2 control-label' for='point_long'>พิกัด ลองจิจูด  :</label>
					<div class='col-sm-10'>

						<input type="text" class="form-control " id="point_long" name="point_long" value="{record_point_long}"  />
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-4">
						<img src="{base_url}assets/images/info.kindee.kindee.png">
					</div>
					<div class="col-sm-4">
						<img src="{base_url}assets/images/info.kindee.kindee.png">
					</div>
					<div class="col-sm-4">
						<button type="button" id=""
							class="btn btn-info btn-lg" data-toggle="modal"
							data-target="" >
							&nbsp;&nbsp;<i class="fa fa-upload"></i> อัปโหลดรูป &nbsp;&nbsp;
						</button>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-12">
	                    <input id="searchInput" name="searchInput" class="form-control controls" type="text" placeholder="ค้นหาตำแหน่ง" onclick="$(this).select()">
	                    <div id="map" style="width:100%;height:300px;"></div>
	                    <ul id="geoData" style="font-size:10px">
	                        <li><b>ที่อยู่จากแผนที่:</b> <span id="location"></span> <b>รหัสไปรษณีย์:</b> <span id="postal_code"></span> <b>ประเทศ:</b> <span id="country"></span> <b>Latitude:</b> <span id="lat"></span> <b>Longitude:</b> <span id="lon"></span></li>
	                    </ul>
					</div>
				</div>

				<div class='form-group'>
					<div class='col-sm-offset-2 col-sm-10'>
						<button  type="button" class='btn btn-primary btn-lg'  data-toggle='modal' data-target='#editModal' >&nbsp;&nbsp;<i class="fa fa-save"></i> บันทึก &nbsp;&nbsp;</button>

						</div>
				</div>

				<input type="hidden" name="encrypt_shop_id" value="{encrypt_shop_id}" />


			</form>
		</div> <!--card-body-->
	</div> <!--card-->

<!-- Modal -->
<div class='modal fade' id='editModal' tabindex='-1' role='dialog' aria-labelledby='editModalLabel' aria-hidden='true'>
	<div class='modal-dialog' role='document'>
		<div class='modal-content'>
			<div class='modal-header'>
				<h4 class='modal-title' id='editModalLabel'>บันทึกข้อมูล</h4>
				<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
			</div>
			<div class='modal-body'>
				<h4>ยืนยันการเปลี่ยนแปลงแก้ไขข้อมูล ?</h4>
				<form class="form-horizontal" onsubmit="return false;" >
					<div class="form-group">
						<div class="col-sm-8">
							<label class="col-sm-3 text-right badge badge-warning" for="edit_remark">ระบุเหตุผล :</label>
						</div>
						<div class="col-sm-12">
							<input type="text" class="form-control" id="edit_remark">
						</div>
					</div>
				</form>
			</div>
			<div class='modal-footer'>
				<button type='button' class='btn btn-default' data-dismiss='modal'>ปิด</button>
				<button type='button' class='btn btn-primary' id='btnSaveEdit'>&nbsp;บันทึก&nbsp;</button>
			</div>
		</div>
	</div>
</div>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmtoJRjQwBbRpG89moh1jXZRwoviIsqf0&libraries=places&callback=locate" async defer></script>
    <script>
    var im = 'http://www.robotwoods.com/dev/misc/bluecircle.png';
    function locate(){
        navigator.geolocation.getCurrentPosition(initMap,fail);
    }
     function fail(){
        initMap();
         console.log('navigator.geolocation failed, may not be supported');
     }

    function initMap(position) {
        var myLatLng;

        var latitude = 18.7952876;
        var longitude = 98.9620002;

        if(position!=undefined) {
          latitude = position.coords.latitude;
          longitude = position.coords.longitude;
        }
        //console.log(position);
        myLatLng = new google.maps.LatLng(latitude, longitude);

        var mapOptions = {
          zoom: 13,
          center: myLatLng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(document.getElementById('map'),
                                      mapOptions);
        var userMarker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            icon: im,
            //draggable:true
        });

        document.getElementById('location').innerHTML = "ตำแหน่งที่อยู่";
        document.getElementById('lat').innerHTML = latitude;
        document.getElementById('lon').innerHTML = longitude;

        var input = document.getElementById('searchInput');
        setTimeout(function(){
          $("#searchInput").val(document.getElementById('location').innerHTML);
        },500);
      
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            icon: "{base_url}assets/images/marker.png",
            map: map,
            anchorPoint: new google.maps.Point(0, -29),
            draggable:true
        });
        //dragger
        google.maps.event.addListener(marker, 'dragend', function() 
        {
            geocodePosition(marker.getPosition());
        });
        google.maps.event.addListener(marker, 'dragend', function(evt){
            console.log('Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Lng: ' + evt.latLng.lng().toFixed(3));
            document.getElementById('lat').innerHTML = evt.latLng.lat().toFixed(3);
            document.getElementById('lon').innerHTML = evt.latLng.lng().toFixed(3);
        });

        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }
      
            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(15);
            }
            marker.setIcon(({
                icon: "{base_url}assets/images/marker.png",
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
        
            var address = '';
            if (place.address_components) {
                address = [
                  (place.address_components[0] && place.address_components[0].short_name || ''),
                  (place.address_components[1] && place.address_components[1].short_name || ''),
                  (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }
        
            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, marker);
          
            //Location details
            for (var i = 0; i < place.address_components.length; i++) {
                if(place.address_components[i].types[0] == 'postal_code'){
                    document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
                }
                if(place.address_components[i].types[0] == 'country'){
                    document.getElementById('country').innerHTML = place.address_components[i].long_name;
                }
            }
            document.getElementById('location').innerHTML = place.formatted_address;
            document.getElementById('lat').innerHTML = place.geometry.location.lat();
            document.getElementById('lon').innerHTML = place.geometry.location.lng();
        });


    }

        function geocodePosition(pos) 
        {
           geocoder = new google.maps.Geocoder();
           geocoder.geocode
            ({
                latLng: pos
            }, 
                function(results, status) 
                {
                    if (status == google.maps.GeocoderStatus.OK) 
                    {
                        document.getElementById('location').innerHTML = results[0].formatted_address;
                        document.getElementById('addr').innerHTML = results[0].formatted_address;
                        console.log(results[0].formatted_address);
                    } 
                    else 
                    {
                        console.log('Cannot determine address at this location.'+status);
                    }
                }
            );
        }
        //dragger
</script>
