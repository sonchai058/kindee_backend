<div class="container-fluid">
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="{site_url}
				<?php
				$user_level = $this->session->userdata('user_level');
				switch ($user_level) {
					case 'admin' || 'nutritionist':
						$user_level = 'dashboard';
						break;
					case 'user' || 'super_user':
						$user_level = 'dashboard_user';
						break;
					case 'shop':
						$user_level = 'dashboard_res';
						break;
				}
				echo $user_level; ?>
				">
				หน้าหลัก
			</a>
		</li>
		{breadcrumb}
		<li class="breadcrumb-item {class}"><a href="{url}">{title}</a></li>
		{/breadcrumb}
	</ol>
</div>
