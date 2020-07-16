	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar ftco-navbar-light justify-content-center" id="ftco-navbar">
		<a style="color: white; padding-left: 10px; padding-right: 10px;" class="navbar-brand d-flex w-50 mr-auto">
			<img src="{base_url}assets/images/info.kindee.kindee.png" alt="logo" style="width:50px">&emsp;
			<span style="align-self: center;">Kindee | Story</span>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar3" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
			<span style="color: white;" class="oi oi-menu"></span> <span style="color: white;">Menu</span>
		</button>
		<div class="navbar-collapse collapse w-100" id="collapsingNavbar3">
			<ul class="navbar-nav w-100 justify-content-center">
				<li class="nav-item">
					<a class="nav-link <?php if ($this->uri->segment(1) == 'frontend_page' && $this->uri->segment(2) == '') { ?>active<?php } ?>" href="{base_url}frontend_page">หน้าหลัก</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php if ($this->uri->segment(2) == 'news_page') { ?>active<?php } ?>" href="{base_url}frontend_page/news_page">ข่าวสาร</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php if ($this->uri->segment(2) == 'shops_page') { ?>active<?php } ?>" href="{base_url}frontend_page/shops_page">ร้านค้า
					</a>
				</li>
				<?php if ($this->session->userdata('user_level') == 'admin') { ?>
					<li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'dashboard') { ?>active<?php } ?>">
						<a class="nav-link" href="{site_url}">
							สมาชิก
						</a>
					</li>
				<?php
				}
				?>
				<?php if ($this->session->userdata('user_level') == 'user' || $this->session->userdata('user_level') == 'super_user') { ?>
					<li class="nav-item<?php if ($this->uri->segment(1) == 'dashboard_user') { ?>active<?php } ?>">
						<a class="nav-link" href="{site_url}dashboard_user">
							สมาชิก
						</a>
					</li>
				<?php
				}
				?>
				<?php if ($this->session->userdata('user_level') == 'shop') { ?>
					<li class="nav-item <?php if ($this->uri->segment(1) == 'dashboard_res') { ?>active<?php } ?>">
						<a class="nav-link" href="{site_url}dashboard_res">
							สมาชิก
						</a>
					</li>
				<?php
				}
				?>
				<?php if ($this->session->userdata('user_level') == 'nutritionist') { ?>
					<li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'dashboard') { ?>active<?php } ?>">
						<a class="nav-link" href="{site_url}">
							สมาชิก
						</a>
					</li>
				<?php
				}
				?>
				<?php if ($this->session->userdata('user_level') == '') { ?>
					<li class="nav-item">
						<a class="nav-link" href="{base_url}user_login">สมาชิก</a>
					</li>
				<?php
				}
				?>
			</ul>
			<ul class="nav navbar-nav ml-auto w-100 justify-content-end">
				<!-- <li class="nav-item">
					<a class="nav-link" href="#">Right</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Right</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Right</a>
				</li> -->
			</ul>
		</div>
	</nav>
