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
					<a class="nav-link active" href="{base_url}frontend_page">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">News</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Shops
					</a>
				</li>
				<?php if ($this->session->userdata('user_level') == 'admin') { ?>
					<li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'dashboard') { ?>active<?php } ?>">
						<a class="nav-link" href="{site_url}">
							members
						</a>
					</li>
				<?php
				}
				?>
				<?php if ($this->session->userdata('user_level') == 'user' || $this->session->userdata('user_level') == 'super_user') { ?>
					<li class="nav-item<?php if ($this->uri->segment(1) == 'dashboard_user') { ?>active<?php } ?>">
						<a class="nav-link" href="{site_url}dashboard_user">
							members
						</a>
					</li>
				<?php
				}
				?>
				<?php if ($this->session->userdata('user_level') == 'shop') { ?>
					<li class="nav-item <?php if ($this->uri->segment(1) == 'dashboard_res') { ?>active<?php } ?>">
						<a class="nav-link" href="{site_url}dashboard_res">
							members
						</a>
					</li>
				<?php
				}
				?>
				<?php if ($this->session->userdata('user_level') == 'nutritionist') { ?>
					<li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'dashboard') { ?>active<?php } ?>">
						<a class="nav-link" href="{site_url}">
							members
						</a>
					</li>
				<?php
				}
				?>
				<?php if ($this->session->userdata('user_level') == '') { ?>
				<li class="nav-item">
					<a class="nav-link" href="{base_url}user_login">members</a>
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
