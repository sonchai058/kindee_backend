<script>
	var num = {count_image};
	var data_id = {data_id};
	var state = 'edit';
</script>
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

				<div class="row">
					<div class="col-sm-12 col-md-4">
						<label class="col-sm-12 control-label" for="self_food_name">ชื่อร้าน (ไทย) :</label>
						<input type="text" class="form-control " id="shop_name_th" name="shop_name_th" value="{record_shop_name_th}"  />
					</div>

					<div class="col-sm-12 col-md-4">
						<label class="col-sm-12 control-label" for="shop_name_en">ชื่อร้าน (อังกฤษ)  :</label>
						<input type="text" class="form-control " id="shop_name_en" name="shop_name_en" value="{record_shop_name_en}"  />
					</div>

					<div class="col-sm-12 col-md-4">
						<label class="col-sm-12 control-label" for="cate_id">ชื่อประเภทร้าน  :</label><br/>
						<select id='cate_id'  name='cate_id' value="{record_cate_id}" >
							<!-- <option value="">- เลือก ชื่อประเภทร้าน -</option> -->
							{category_cate_id_option_list}
						</select>
					</div>
				</div>
				
				<br/>

				<div class="row">
					<div class="col-sm-12 col-md-4">
						<label class="col-sm-12 control-label" for="shop_photo">รูปโปรไฟล์  :</label>
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

					<div class="col-sm-12 col-md-4">
						<label class="col-sm-12 control-label" for="shop_cover">รูปปก  :</label>
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
				
				<br/>

				<div class="row">
					<div class="col-sm-12 col-md-4">
						<label class="col-sm-12 control-label" for="mobile_no">เบอร์โทร  :</label>
						<input type="text" class="form-control " id="mobile_no" name="mobile_no" value="{record_mobile_no}"  />
					</div>
				
					<div class="col-sm-12 col-md-4">
						<label class='col-sm-12 control-label' for='email_addr'>อีเมล  :</label>
						<input type="text" class="form-control " id="email_addr" name="email_addr" value="{record_email_addr}"  />
					</div>
					
					<div class="col-sm-12 col-md-4">
						<label class="col-sm-12 control-label" for="cus_passwd">รหัสผ่าน  :</label>
						<input type="password" class="form-control " id="cus_passwd" name="cus_passwd" value="{record_cus_passwd}"  />
					</div>

				</div>
				
				<br/>

				<div class="row">
					<div class="col-sm-12 col-md-12">
						<label class='col-sm-12 control-label' for='addr'>ที่อยู่  :</label>
						<textarea  class="form-control" id="addr" name="addr" rows="5">{record_addr}</textarea>
					</div>
				</div>
				
				<br/>

				<div class="row">
					<div class="col-sm-12 col-md-4">
						<label class='col-sm-12 control-label' for='point_lat'>พิกัด ละติจูด  :</label>
						<input  type="number" step="0.01" class="form-control " id="point_lat" name="point_lat" value="{record_point_lat}"  />
					</div>

					<div class="col-sm-12 col-md-4">
						<label class='col-sm-12 control-label' for='point_long'>พิกัด ลองจิจูด  :</label>
						<input  type="number" step="0.01" class="form-control " id="point_long" name="point_long" value="{record_point_long}"  />
					</div>
				</div>

				<br/>

				<div class="row">
					<div class="col-sm-12 col-md-4">
					<label class='col-sm-12 control-label' for='shop_user'>ชื่อผู้ดูแล  :</label><br/>
					<select id='shop_user' disabled="true" name='shop_user' value="{record_shop_user}" >
						<option value="">- เลือก ชื่อผู้ดูแล -</option>
						{users_shop_user_option_list}
					</select>
					</div>

					<div class="col-sm-12 col-md-4">
						<label class='col-sm-12 control-label' for='fag_allow'>สถานะ  :</label><br/>
						<select id="fag_allow" name="fag_allow" value="{record_fag_allow}" >
							<option value="">- เลือก สถานะ -</option>
							<option value="allow">เผยแพร่</option>
							<option value="block">ไม่เผยแพร่</option>
							<option value="delete">ลบ</option>
						</select>
					</div>
				</div>

				<br/>
				<h5>พิกัดร้าน :</h5>
				<div class="row">
					<div class="col-sm-12 col-md-12">
	                    <input id="searchInput" name="searchInput" class="form-control controls" type="text" placeholder="ค้นหาตำแหน่ง" style="widht:500px; margin-top: 5px;" onclick="$(this).select()">
	                    <div id="map" style="width:100%;height:300px;"></div>
	                    <ul id="geoData" style="font-size:10px">
	                        <li><b>ที่อยู่จากแผนที่:</b> <span id="location"></span> <b>รหัสไปรษณีย์:</b> <span id="postal_code"></span> <b>ประเทศ:</b> <span id="country"></span> <b>Latitude:</b> <span id="lat"></span> <b>Longitude:</b> <span id="lon"></span></li>
	                    </ul>
					</div>

				</div>	

				<br/>
				<h5>รูปภาพ :</h5>
				<div class="row form-group">
					<div class="col-sm-4">
							<button onclick="$('#pro-image').click()" type="button" id=""
								class="btn btn-warning btn-md" data-toggle="modal"
								data-target="" >
								&nbsp;&nbsp;<i class="fa fa-upload"></i> อัปโหลดรูป &nbsp;&nbsp;
							</button>
								<input accept="image/*" type="file" id="pro-image" name="pro-image[]" style="display: none;" class="form-control" multiple>
					</div>
				</div>
				<div class="row form-group">
				    <div class="preview-images-zone" id="uploadContent">
						{shop_images}
				    </div>
				</div>

				<br/>

				<div class='form-group'>
					<div class="col-sm-12 text-right">
						<button  type="button" class='btn btn-warning btn-md'  data-toggle='modal' data-target='#editModal' >&nbsp;&nbsp;<i class="fa fa-save"></i> บันทึก &nbsp;&nbsp;</button>

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
						<!--
						<div class="col-sm-8">
							<label class="col-sm-3 text-right badge badge-warning" for="edit_remark">ระบุเหตุผล :</label>
						</div>
						<div class="col-sm-12">
							<input type="text" class="form-control" id="edit_remark">
						</div>
					-->
					</div>
				</form>
			</div>
			<div class='modal-footer'>
				<button type='button' class='btn btn-warning' data-dismiss='modal'>ปิด</button>
				<button type='button' class='btn btn-warning' id='btnSaveEdit'>&nbsp;บันทึก&nbsp;</button>
			</div>
		</div>
	</div>
</div>

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

        var latitude = {record_point_lat};
        var longitude = {record_point_long};

        setTimeout(function(){
        	//alert($("#point_lat").val());
	        if($("#point_lat").val()=='' || $("#point_lat").val()==0) {
	        	$("#point_lat").val(latitude);
	        }
	        if($("#point_long").val()=='' || $("#point_long").val()==0) {
	        	$("#point_long").val(longitude);
	        }
    	},500);

        /*
        if(position!=undefined) {
          latitude = position.coords.latitude;
          longitude = position.coords.longitude;
        }
        */
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

        document.getElementById('location').innerHTML = "ค้นหาตำแหน่ง";
        document.getElementById('lat').innerHTML = latitude;
        document.getElementById('lon').innerHTML = longitude;
		$("#point_lat").val(latitude); 
		$("#point_long").val(longitude);


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
			$("#point_lat").val(evt.latLng.lat().toFixed(3)); 
			$("#point_long").val(evt.latLng.lng().toFixed(3));
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
			$("#point_lat").val(place.geometry.location.lat()); 
			$("#point_long").val(place.geometry.location.lng());
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmtoJRjQwBbRpG89moh1jXZRwoviIsqf0&libraries=places&callback=locate" async defer></script>