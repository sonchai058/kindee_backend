<!-- Navbar Search -->
<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="ค้นหา..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-info" type="button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</form>

<!-- Navbar -->
<ul class="navbar-nav ml-auto ml-md-0">
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <span class="badge badge-danger">9+</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
        </div>
    </li>
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-envelope fa-fw"></i>
            <span class="badge badge-danger">7</span>
        </a>
		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
			<a class="dropdown-item" href="#">Action</a>
			<a class="dropdown-item" href="#">Another action</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="#">Something else here</a>
		</div>
	</li>
	<li class="nav-item dropdown no-arrow">
		<a class="nav-link {login_inactive_class}" href="{site_url}/member_login" >
			<i class="fas fa-user-circle fa-fw"></i>
		</a>
		
		<a class="nav-link dropdown-toggle {login_active_class}" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fas fa-user-circle fa-fw"></i>
		</a>
		<div class="dropdown-menu dropdown-menu-right {login_active_class}" aria-labelledby="userDropdown">
			<a class="dropdown-item">{user_prefix_name} {user_fullname} {user_lastname}</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{site_url}/member_profile">ข้อมูลสมาชิก</a>
			<a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal_change_pass">เปลี่ยนรหัสผ่าน</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
			
			
			
		</div>
	</li>
</ul>