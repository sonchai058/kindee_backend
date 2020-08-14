<br />
<br />
<br />
<section class="ftco-section ftco-category ftco-no-pt">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url({base_url}/assets/images/frontend/news_food.jpg);">
							<div class="text px-3 py-1">
								<h2 class="mb-0"><a href="#">ข่าวสาร</a></h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center mb-3 pb-3">
			<div class="col-md-12 heading-section text-left ftco-animate">
				<h2 class="mb-4">ร้านค้า</h2>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="product">
					<div align="center" ><img  src="{base_url}{shop_cover}" width="500" alt="Colorlib Template"></div>
					<div class="text py-3 pb-4 px-3 text-left">
						<p class="price">
							<span class="price-sale">{shop_name_th}</span>
						</p>
						<h3 style="color: #000;">{shop_name_en}</h3>
						<p>ที่อยู่ : {addr}</p>
						<p>Tel : {mobile_no}</p>

					</div>
					<div class=" py-3 pb-4 px-3" style="color: #E78D13;">โปรโมชั่น</div>
					<div class="row py-3 pb-4 px-3 ">
					<div class="col-md-3 col-lg-3" parser-repeat="[data_list_promotions]">
							<div class="text text-left">
									<span class="price-sale">{pro_name}</span>
									<span class="price-sale">{pro_discount}</span>
							</div>
					</div>
					</div>
					<div class=" py-3 pb-4 px-3" style="color: #E78D13;">เมนูอาหาร</div>
					<div class="row">
					<div class="col-md-3 col-lg-3" parser-repeat="[data_list_menu]">
						<div class="product">
							<div align="center" ><img  src="{base_url}{encrypt_name}" width="200" alt="Colorlib Template"></div>
							<div class="text py-3 pb-4 px-3 text-left">
								<p class="price">
									<span class="price-sale">{self_food_name}</span>
								</p>
								พลังงาน : {energy_amt} กิโลแคลอรี่<br/>
								ราคา : {price_amt} บาท<br/>
							</div>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<br />
<!-- <section class="ftco-section" id="shops">
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
					<a href="#" class="img-prod"><img class="img-fluid" src="{base_url}{shop_cover}" alt="Colorlib Template">
						<div class="overlay"></div>
					</a>
					<div class="text py-3 pb-4 px-3 text-left">
						<p class="price">
							<span class="price-sale">{shop_name_th}</span>
						</p>
						<h3 style="color: #000;">{shop_name_en}</h3>
						<p>ที่อยู่ : {addr}</p>
						<p>Tel : {mobile_no}</p>

					</div>
				</div>
			</div>
		</div>
	</div>
</section> -->
<style>
	.blog_detail {
	}
</style>
