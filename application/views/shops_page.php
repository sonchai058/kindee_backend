<br />
<br />
<br />
<section class="ftco-section ftco-category ftco-no-pt">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url({base_url}/assets/images/frontend/shop_foog.jpg);">
							<div class="text px-3 py-1">
								<h2 class="mb-0">ร้านค้า</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section" id="shops">
	<div class="container">
		<div class="row justify-content-center mb-3 pb-3">
			<div class="col-md-12 heading-section text-left ftco-animate">
				<h2 class="mb-4">ร้านค้า</h2>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-lg-3" parser-repeat="[data_list_shops]">
				<div class="product">
					<a href="{base_url}frontend_page/shop_detail_page/{shop_id}" class="img-prod"><img class="img-fluid" src="{base_url}{shop_cover}" alt="Colorlib Template">
						<div class="overlay"></div>
					</a>
					<div class="text py-3 pb-4 px-3 text-left">
						<p class="price">
							<a href="{base_url}frontend_page/shop_detail_page/{shop_id}">
								<span class="shops_title price-sale">{shop_name_th}</span>
							</a>
						</p>
						<h3 class="shops_title" style="color: #000;">{shop_name_en}</h3>
						<p class="shops_detail">ที่อยู่ : {addr}</p>
						<p>Tel : {mobile_no}</p>
						<p>เวลาเปิด - ปิด : {time_open} - {time_close} น.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-md-12">
			<div class="row justify-content-md-end">
				{pagination_link}
			</div>
		</div>
	</div>
</section>
<style>
	.shops_title {
		overflow: hidden;
		display: -webkit-box;
		-webkit-line-clamp: 1;
		-webkit-box-orient: vertical;
	}

	.shops_detail {
		overflow: hidden;
		display: -webkit-box;
		-webkit-line-clamp: 3;
		-webkit-box-orient: vertical;
	}

	.page-item.active .page-link {
		z-index: 1;
		color: #fff;
		background-color: #28a745;
		border-color: #28a745;
	}

	.page-item .page-link {
		color: #6c757d;
	}

	img {
		display: block;
		margin-left: auto;
		margin-right: auto;
		width: 100%;
	}
</style>
