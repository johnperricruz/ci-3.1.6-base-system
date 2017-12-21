	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
			<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
			<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
			<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li>
				<br/>
				
				<li class="<?php if($page == 'dashboard'){ echo 'active';} ?>">
					<a href="<?php echo base_url('admin')?>"><i class="icon-home"></i><span class="title">Dashboard</span></a>
				</li>	
				
				<li class="<?php if($page == 'profile'){ echo 'active';} ?>">
					<a href="<?php echo base_url('admin/profile')?>"><i class="icon-user"></i><span class="title">Profile</span></a>
				</li>	
								
				<li class="<?php if($openable == 'users'){ echo 'active open';} ?>">
					<a href="javascript:void(0);"><i class="icon-users"></i><span class="title">Users</span><span class="selected"></span><span class="arrow <?php if($openable == 'users'){ echo 'open';} ?>"></span></a>
					<ul class="sub-menu">
						<li class="<?php if($page == 'view users'){ echo 'active';} ?>"><a href="<?php echo base_url('admin/users')?>"><i class="icon-magnifier"></i>View Users</a></li>
						<li class="<?php if($page == 'add user'){ echo 'active';} ?>"><a href="<?php echo base_url('admin/user/add')?>"><i class="icon-plus"></i>Add User</a></li>
					</ul>
				</li>
				
				<li class="<?php if($page == 'settings'){ echo 'active';} ?>">
					<a href="<?php echo base_url('admin/settings')?>"><i class="fa fa-gear"></i><span class="title">Settings</span></a>
				</li>	
				
				<li class="heading">
					<h3 class="uppercase">Account</h3>
				</li>	
				
				<li>
					<a href="<?php echo base_url('logout')?>"><i class="icon-logout"></i><span class="title">Logout</span></a>
				</li>				
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->