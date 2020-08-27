<script>
	var point_lat = {point_lat};
	var point_long = {point_long};
</script>
<div class="content">
	<div class="container-fluid">
		<br />
		<div class="row">
			<div class="col-md-4">
				<div class="card card-profile">
					<div class="card-avatar" style="max-height:230px; max-width: 230px;">
						<img src="{shop_photo}">
					</div>
					<div class="card-body">
						<h4 class="card-title" style="font-weight: bold;">{shop_name_th}</h4>
						<p class="card-description">
							ประเภท : ร้านอาหาร{cate_name}<br />
							เบอร์โทร : {mobile_no} <br />
							อีเมล : {email_addr}<br />
							ที่อยู่ : {addr}<br />
						</p>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="card">
					<div class="card-header card-header-success">
						<h4 class="card-title" style="font-weight: bold;">Mpas</h4>
					</div>
					<div class="card-body">
						<div id="map" style="width:100%; height:420px; margin-top: 0px;"></div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header card-header-success">
						<h4 class="card-title" style="font-weight: bold;">เมนูอาหาร</h4>
					</div>
					<div class="card-body">
						<div class="row" style="padding:0px 50px">
							{shop_food_menu_images}
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header card-header-success">
						<h4 class="card-title" style="font-weight: bold;">รูปภาพ</h4>
					</div>
					<div class="card-body">
						<div class="row" style="padding:0px 50px">
							{allshops_images}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			</div>
			<div class="modal-body text-center">
				<img src="" id="imagepreview" style="max-height: 400px;">
			</div>
		</div>
	</div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmtoJRjQwBbRpG89moh1jXZRwoviIsqf0&libraries=places" async defer></script>
