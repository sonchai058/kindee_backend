
<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
	<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
		<a class="nav-link" href="{site_url}/dashboard">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
		</a>
	</li>
	<li class="nav-item {members_manage_class}">
		<a class="nav-link" href="{site_url}/member_manage">
			<i class="fa fa-users"></i>
		<span>จัดการข้อมูลสมาชิก</span></a>
	</li>
	<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
		<a class="nav-link" href="{site_url}/demo/academic_year">
            <i class="fa fa-users" aria-hidden="true"></i>
            <span class="nav-link-text">ข้อมูลประจำปีการศึกษา</span>
		</a>
	</li>
	
	<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
		<a class="nav-link" href="{site_url}/demo/room">
            <i class="fa fa-users" aria-hidden="true"></i>
            <span class="nav-link-text">ห้องเรียน</span>
		</a>
	</li>
	
	<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
		<a class="nav-link" href="{site_url}/demo/student">
            <i class="fa fa-users" aria-hidden="true"></i>
            <span class="nav-link-text">ข้อมูลนักเรียน</span>
		</a>
	</li>
	
	<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
		<a class="nav-link" href="{site_url}/demo/teacher">
            <i class="fa fa-users" aria-hidden="true"></i>
            <span class="nav-link-text">ข้อมูลอาจารย์</span>
		</a>
	</li>
	
	<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
		<a class="nav-link" href="{site_url}/address/address_list">
            <i class="fa fa-users" aria-hidden="true"></i>
            <span class="nav-link-text">บันทึกที่อยู่นักเรียน</span>
		</a>
	</li>
	
	<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
		<a class="nav-link" href="{site_url}/charts">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Charts</span>
		</a>
	</li>
	<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
		<a class="nav-link" href="{site_url}/tables">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Tables</span>
		</a>
	</li>
	<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
		<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Components</span>
		</a>
		<ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
				<a href="{site_url}/navbar">Navbar</a>
			</li>
            <li>
				<a href="{site_url}/card">Cards</a>
			</li>
		</ul>
	</li>
	<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
		<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Example Pages</span>
		</a>
		<ul class="sidenav-second-level collapse" id="collapseExamplePages">
            <li>
				<a href="{site_url}/login">Login Page</a>
			</li>
            <li>
				<a href="{site_url}/regis">Registration Page</a>
			</li>
            <li>
				<a href="{site_url}/forgot">Forgot Password Page</a>
			</li>
            <li>
				<a href="{site_url}/blank_page">Blank Page</a>
			</li>
		</ul>
	</li>
	<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
		<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">Menu Levels</span>
		</a>
		<ul class="sidenav-second-level collapse" id="collapseMulti">
            <li>
				<a href="#">Second Level Item</a>
			</li>
            <li>
				<a href="#">Second Level Item</a>
			</li>
            <li>
				<a href="#">Second Level Item</a>
			</li>
            <li>
				<a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">Third Level</a>
				<ul class="sidenav-third-level collapse" id="collapseMulti2">
					<li>
						<a href="#">Third Level Item</a>
					</li>
					<li>
						<a href="#">Third Level Item</a>
					</li>
					<li>
						<a href="#">Third Level Item</a>
					</li>
				</ul>
			</li>
		</ul>
	</li>
	<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
		<a class="nav-link" href="http://phpcodemania.blogspot.com" target="_blank">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">Link</span>
		</a>
	</li>
</ul>
<ul class="navbar-nav sidenav-toggler">
	<li class="nav-item">
		<a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
		</a>
	</li>
</ul>
<ul class="navbar-nav ml-auto">
	<li class="nav-item">
		<form class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
				<input class="form-control" type="text" placeholder="Search for...">
				<span class="input-group-append">
					<button class="btn btn-primary" type="button">
						<i class="fa fa-search"></i>
					</button>
				</span>
			</div>
		</form>
	</li>
	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-envelope"></i>
            <span class="d-lg-none">Messages
				<span class="badge badge-pill badge-primary">12 New</span>
			</span>
            <span class="indicator text-primary d-none d-lg-block">
				<i class="fa fa-fw fa-circle"></i>
			</span>
		</a>
		<div class="dropdown-menu" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">New Messages:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
				<strong>David Miller</strong>
				<span class="small float-right text-muted">11:21 AM</span>
				<div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
			</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
				<strong>Jane Smith</strong>
				<span class="small float-right text-muted">11:21 AM</span>
				<div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
			</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
				<strong>John Doe</strong>
				<span class="small float-right text-muted">11:21 AM</span>
				<div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
			</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all messages</a>
		</div>
	</li>
	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alerts
				<span class="badge badge-pill badge-warning">6 New</span>
			</span>
            <span class="indicator text-warning d-none d-lg-block">
				<i class="fa fa-fw fa-circle"></i>
			</span>
		</a>
		<div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">New Alerts:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
				<span class="text-success">
					<strong>
					<i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
				</span>
				<span class="small float-right text-muted">11:21 AM</span>
				<div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
			</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
				<span class="text-danger">
					<strong>
					<i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
				</span>
				<span class="small float-right text-muted">11:21 AM</span>
				<div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
			</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
				<span class="text-success">
					<strong>
					<i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
				</span>
				<span class="small float-right text-muted">11:21 AM</span>
				<div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
			</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all alerts</a>
		</div>
	</li>
	<li class="nav-item dropdown no-arrow">
		<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fa fa-user-circle fa-fw"></i>
		</a>
		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
			<a class="dropdown-item">{user_prefix_name} {user_fullname} {user_lastname}</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{site_url}/member_profile">ข้อมูลสมาชิก</a>
			<a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal_change_pass">เปลี่ยนรหัสผ่าน</a>
		</div>
	</li>
	<li class="nav-item">
		<a class="nav-link" data-toggle="modal" data-target="#exampleModal">
		<i class="fa fa-fw fa-sign-out"></i>Logout</a>
	</li>
</ul>
