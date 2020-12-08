<?php
$tmp_txt = '';
if ($this->session->userdata('user_level') == 'super_user') {
	$this->load->model("common_model");
	$rows = $this->common_model->custom_query("select * from users where fag_allow='allow' and user_level='user'");
	$tmp_txt = "<center><select value='เลือก User' id='user_select' style='margin-top:5px;'><option disabled selected>เลือก User</option>";
	foreach ($rows as $key => $value) {
		$selected = "";
		if ($this->session->userdata('user_id') == $value['user_id']) {
			$selected = "selected";
		}
		$tmp_txt = $tmp_txt . "<option {$selected} value='{$value['user_id']}'>{$value['user_fname']}</option>";
	}
	$tmp_txt = $tmp_txt . "</select></center>";
}
?>
<?php
$tmp_txt2 = '';
if ($this->session->userdata('user_level') == 'nutritionist') {
	$this->load->model("common_model");
	$rows = $this->common_model->custom_query("select users_nutritionist.*,users.* FROM users_nutritionist LEFT JOIN users ON users_nutritionist.user_id = users.user_id WHERE users_nutritionist.user_nutri = '{$this->session->userdata('user_nutri')}' and users_nutritionist.fag_allow = 'allow'");
	$tmp_txt2 = "<center><select value='เลือก User' id='user_select' style='margin-top:5px;'><option disabled selected>เลือก User</option>";
	foreach ($rows as $key => $value) {
		$selected = "";
		if ($this->session->userdata('user_id') == $value['user_id']) {
			$selected = "selected";
		}
		$tmp_txt2 = $tmp_txt2 . "<option {$selected} value='{$value['user_id']}'>{$value['user_fname']}</option>";
	}
	$tmp_txt2 = $tmp_txt2 . "</select></center>";
}
?>

<div class="sidebar" data-color="orange" data-background-color="black" data-image="{base_url}assets/themes/material/assets/img/sidebar-3.jpg">
	<div class="logo">
		<a href="{site_url}frontend_page" class="simple-text logo-normal">
			<img src="{base_url}assets/images/info.kindee.kindee.png" alt="logo" style="width:40px">&emsp;
			<span>Kindee | Story</span>
		</a>
	</div>
	<div class="sidebar-wrapper">
		<?php
		echo $tmp_txt;
		echo $tmp_txt2;
		?>
		<ul class="nav">

			<?php if ($this->session->userdata('user_level') == 'admin') { ?>
				<li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'dashboard') { ?>active<?php } ?>">
					<a class="nav-link" href="{site_url}dashboard">
						<i class="material-icons">home</i>
						<p>หน้าหลัก</p>
					</a>
				</li>
				<li class="nav-item <?php if ($this->uri->segment(1) == 'blogdata' && $this->uri->segment(2) == 'blog') { ?>active<?php } ?>">
					<a class="nav-link" href="{site_url}blogdata/blog">
						<i class="material-icons">dashboard</i>
						<p>ข่าว/บทความ</p>
					</a>
				</li>
				<li class="nav-item <?php if ($this->uri->segment(1) == 'selffood' && $this->uri->segment(2) == 'self_food_menu') { ?>active<?php } ?>">
					<a class="nav-link" href="{site_url}selffood/self_food_menu">
						<i class="material-icons">insert_emoticon</i>
						<p>ข้อมูลเมนูปรุงเอง(ระบบ)</p>
					</a>
				</li>
				<li class="nav-item <?php if ($this->uri->segment(1) == 'shopdata' && $this->uri->segment(2) == 'shops') { ?>active<?php } ?>">
					<a class="nav-link" href="{site_url}shopdata/shops">
						<i class="material-icons">menu</i>
						<p>จัดการร้านอาหาร</p>
					</a>
				</li>
				<li class="nav-item <?php if ($this->uri->segment(1) == 'setting' && $this->uri->segment(2) == 'users') { ?>active<?php } ?>">
					<a class="nav-link" href="{site_url}setting/users">
						<i class="material-icons">person</i>
						<p>จัดการผู้ใช้งาน</p>
					</a>
				</li>
				<li class="nav-item <?php if ($this->uri->segment(1) == 'prodata' && $this->uri->segment(2) == 'pro') { ?>active<?php } ?>">
					<a class="nav-link" href="{site_url}prodata/pro">
						<i class="material-icons">credit_card</i>
						<p>จัดการข้อมูลบัตรเครดิต</p>
					</a>
				</li>
				<li class="nav-item <?php if ($this->uri->segment(1) == 'packagedata' && $this->uri->segment(2) == 'package') { ?>active<?php } ?>">
					<a class="nav-link" href="{site_url}packagedata/package">
						<i class="material-icons">library_books</i>
						<p>ตรวจสอบ Package</p>
					</a>
				</li>
			<?php
			}
			?>

			<?php if ($this->session->userdata('user_level') == 'user' || $this->session->userdata('user_level') == 'super_user') { ?>

				<li class="nav-item <?php if ($this->uri->segment(1) == 'dashboard_user') { ?>active<?php } ?>">
					<a class="nav-link" href="{site_url}dashboard_user">
						<i class="material-icons">home</i>
						<p>หน้าหลัก</p>
					</a>
				</li>

				<li class="nav-item <?php if ($this->uri->segment(2) == 'users' && $this->uri->segment(3) == 'edit') { ?>active<?php } ?>">
					<a class="nav-link" href="{site_url}setting/users/edit/<?php echo $this->session->userdata('encrypt_user_id'); ?>">
						<i class="material-icons">person</i>
						<p>จัดการข้อมูลส่วนตัว</p>
					</a>
				</li>
				<?php if ($this->session->userdata('user_status') == 1) { ?>
					<li class="nav-item <?php if ($this->uri->segment(2) == 'users_result_exam_chemical') { ?>active<?php } ?>">
						<a class="nav-link" href="{site_url}exam/users_result_exam_chemical">
							<i class="material-icons">content_paste</i>
							<p>ผลตรวจสุขภาพทางทางชีวเคมี</p>
						</a>
					</li>


					<li class="nav-item <?php if ($this->uri->segment(2) == 'users_result_exam_food_allergy') { ?>active<?php } ?>">
						<a class="nav-link" href="{site_url}exam/users_result_exam_food_allergy">
							<i class="material-icons">library_books</i>
							<p>ผลตรวจการแพ้อาหาร</p>
						</a>
					</li>

					<li class="nav-item <?php if ($this->uri->segment(1) == 'foodallergy' && $this->uri->segment(2) == 'users_foood_allergy') { ?>active<?php } ?>">
						<a class="nav-link" href="{site_url}foodallergy/users_foood_allergy">
							<i class="material-icons">library_books</i>
							<p>ข้อมูลอาหารที่ท่านแพ้</p>
						</a>
					</li>

					<li class="nav-item <?php if ($this->uri->segment(1) == 'drugeat' && $this->uri->segment(2) == 'users_drug') { ?>active<?php } ?>">
						<a class="nav-link" href="{site_url}drugeat/users_drug">
							<i class="material-icons">library_books</i>
							<p>ข้อมูลยาที่ทานประจำ</p>
						</a>
					</li>
				<?php } ?>

				<li class="nav-item <?php if ($this->uri->segment(1) == 'foodeat' && $this->uri->segment(2) == 'users_food_time') { ?>active<?php } ?>">
					<a class="nav-link" href="{site_url}foodeat/users_food_time">
						<i class="material-icons">library_books</i>
						<p>ข้อมูลการรับประทานอาหาร</p>
					</a>
				</li>

				<li class="nav-item <?php if ($this->uri->segment(1) == 'selffood' && $this->uri->segment(2) == 'self_food_menu') { ?>active<?php } ?>">
					<a class="nav-link" href="{site_url}selffood/self_food_menu">
						<i class="material-icons">insert_emoticon</i>
						<p>ข้อมูลเมนูปรุงเอง</p>
					</a>
				</li>

				<li class="nav-item <?php if ($this->uri->segment(1) == 'questiondata' && $this->uri->segment(2) == 'question') { ?>active<?php } ?>">
					<a class="nav-link" href="{site_url}questiondata/question">
						<i class="material-icons">question_answer</i>
						<?php $text_title = ($this->session->userdata('user_status') == '1' ? "ปรึกษานักโภชนการ":"ปรึกษานักโภชนการ(เบื้องต้น)")  ?>
						<p><?php echo $text_title?></p>
					</a>
				</li>
				<?php if ($this->session->userdata('user_status') == '0') { ?>
				<li class="nav-item <?php if ($this->uri->segment(1) == 'packagedata' && $this->uri->segment(2) == 'package') { ?>active<?php } ?>">
					<a class="nav-link" href="{site_url}packagedata/package/add">
						<i class="material-icons">library_books</i>
						<p>Package</p>
					</a>
				</li>
				<?php
			}
			?>
			<?php
			}
			?>

			<?php if ($this->session->userdata('user_level') == 'shop') { ?>
				<li class="nav-item <?php if ($this->uri->segment(1) == 'dashboard_res') { ?>active<?php } ?>">
					<a class="nav-link" href="{site_url}dashboard_res">
						<i class="material-icons">home</i>
						<p>หน้าหลัก</p>
					</a>
				</li>

				<li class="nav-item <?php if ($this->uri->segment(1) == 'shopdata' && $this->uri->segment(2) == 'shops') { ?>active<?php } ?>">
					<a class="nav-link" href="{site_url}shopdata/shops/edit/<?php echo $this->session->userdata('encrypt_shop_id'); ?>">
						<i class="material-icons">menu</i>
						<p>ข้อมูลร้านอาหาร</p>
					</a>
				</li>

				<li class="nav-item <?php if ($this->uri->segment(1) == 'restaurant' && $this->uri->segment(2) == 'shop_food_menu') { ?>active<?php } ?>">
					<a class="nav-link" href="{site_url}restaurant/shop_food_menu">
						<i class="material-icons">menu_book</i>
						<p>เมนูอาหาร</p>
					</a>
				</li>

				<li class="nav-item <?php if ($this->uri->segment(2) == 'shop_promotions' && $this->uri->segment(3) == 'editpro') { ?>active<?php } ?>">
					<a class="nav-link" href="{site_url}restaurant/shop_promotions/editpro">
						<i class="fa fa-bullhorn"></i>
						<p>โปรโมชั่น</p>
					</a>
				</li>

				<li class="nav-item <?php if ($this->uri->segment(1) == 'outfooddata' && $this->uri->segment(2) == 'outfood') { ?>active<?php } ?>">
					<a class="nav-link" href="{site_url}outfooddata/outfood">
						<i class="material-icons">shopping_basket</i>
						<p>จัดการวัตถุดิบ</p>
					</a>
				</li>

			<?php
			}
			?>

			<?php if ($this->session->userdata('user_level') == 'nutritionist') { ?>
				<li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'dashboard') { ?>active<?php } ?>">
					<a class="nav-link" href="{site_url}dashboard">
						<i class="material-icons">home</i>
						<p>หน้าหลัก</p>
					</a>
				</li>

				<li class="nav-item <?php if ($this->uri->segment(1) == 'blogdata' && $this->uri->segment(2) == 'blog') { ?>active<?php } ?>">
					<a class="nav-link" href="{site_url}blogdata/blog">
						<i class="material-icons">dashboard</i>
						<p>ข่าว/บทความ</p>
					</a>
				</li>


				<li class="nav-item <?php if ($this->uri->segment(1) == 'questiondata' && $this->uri->segment(2) == 'question') { ?>active<?php } ?>">
					<a class="nav-link" href="{site_url}questiondata/question">
						<i class="material-icons">question_answer</i>
						<p>กระดานถามตอบ</p>
					</a>
				</li>

					<li class="nav-item <?php if ($this->uri->segment(2) == 'users_result_exam_chemical') { ?>active<?php } ?>">
						<a class="nav-link" href="{site_url}exam/users_result_exam_chemical">
							<i class="material-icons">content_paste</i>
							<p>ผลตรวจสุขภาพทางทางชีวเคมี</p>
						</a>
					</li>


					<li class="nav-item <?php if ($this->uri->segment(2) == 'users_result_exam_food_allergy') { ?>active<?php } ?>">
						<a class="nav-link" href="{site_url}exam/users_result_exam_food_allergy">
							<i class="material-icons">library_books</i>
							<p>ผลตรวจการแพ้อาหาร</p>
						</a>
					</li>

					<li class="nav-item <?php if ($this->uri->segment(1) == 'foodallergy' && $this->uri->segment(2) == 'users_foood_allergy') { ?>active<?php } ?>">
						<a class="nav-link" href="{site_url}foodallergy/users_foood_allergy">
							<i class="material-icons">library_books</i>
							<p>ข้อมูลอาหารที่ท่านแพ้</p>
						</a>
					</li>

					<li class="nav-item <?php if ($this->uri->segment(1) == 'drugeat' && $this->uri->segment(2) == 'users_drug') { ?>active<?php } ?>">
						<a class="nav-link" href="{site_url}drugeat/users_drug">
							<i class="material-icons">library_books</i>
							<p>ข้อมูลยาที่ทานประจำ</p>
						</a>
					</li>


			<?php
			}
			?>

			<li class="nav-item">
				<a class="nav-link" href="{site_url}user_login/destroy">
					<i class="material-icons">exit_to_app</i>
					<p>ออกจากระบบ</p>
				</a>
			</li>

		</ul>
	</div>

</div>
