<div class="container-fluid">
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="<?php echo ($this->session->userdata('user_level') == 'shop') ? '{site_url}dashboard_res' : '{site_url} '; ?>">
				หน้าหลัก
			</a>
		</li>
		{breadcrumb}
		<li class="breadcrumb-item {class}"><a href="{url}">{title}</a></li>
		{/breadcrumb}
	</ol>
</div>
