	<style>
	.menubar-nav .nav-link i {
		font-size: 22px;
		color: #b6b4b4;
	}

	.menubar-nav .nav-link.active i {
		color: #673ab7;
	}
	</style>
	<!-- Menubar -->
	<div class="menubar-area">
		<div class="toolbar-inner menubar-nav">
			<a href="{{ route('member.dashboard') }}"
			   class="nav-link {{ request()->routeIs('member.dashboard') ? 'active' : '' }}">
				<i class="fa-solid fa-house"></i>
			</a>

			<a href="{{ url('member/my-income') }}"
			   class="nav-link {{ request()->is('member/my-income') ? 'active' : '' }}">
				<i class="fa-solid fa-indian-rupee-sign"></i>
			</a>

			<a href="{{ url('member/apply-physical-membership') }}"
			   class="nav-link {{ request()->is('member/apply-physical-membership') ? 'active' : '' }}">
				<i class="fa-solid fa-circle-plus"></i>
			</a>

			<a href="{{ url('member/my-profile') }}"
			   class="nav-link {{ request()->is('member/my-profile') ? 'active' : '' }}">
				<i class="fa-solid fa-user"></i>
			</a>
		</div>
	</div>
	<!-- Menubar -->
