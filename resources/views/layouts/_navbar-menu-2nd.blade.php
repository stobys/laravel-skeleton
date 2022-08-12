<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button">
				<x-icon icon="bars" />
			</a>
		</li>
		{{--
		<li class="nav-item d-none d-sm-inline-block">
			<a href="{{ route('root') }}" class="nav-link">Home</a>
		</li>

		<li class="nav-item d-none d-sm-inline-block">
			<a href="{{ route('root') }}" class="nav-link">Contact</a>
		</li>
		--}}
	</ul>

	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">

		{{--
		<!-- Messages Dropdown Menu -->
		<li class="nav-item dropdown">
			<a class="nav-link" data-toggle="dropdown" href="#">
				<i class="far fa-comments"></i>
				<span class="badge badge-danger navbar-badge">3</span>
			</a>
			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				<a href="#" class="dropdown-item">
					<x-navbar-message avatar="user1-128x128" sender="Sławomir Tobys" text="Yo Yo! My Man!" time="two days after tomorrow" />
				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item">
					<x-navbar-message avatar="user1-128x128" sender="Brad Diesel" text="Call me whenever you can..." time="4 hrs ago" />
				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item">
					<x-navbar-message avatar="user8-128x128" sender="John Pierce" text="I got your message bro!" time="4 hrs ago" />
				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item">
					<x-navbar-message avatar="user3-128x128" sender="Nora Silvester" text="The subject goes here!" time="4 hrs ago" />
				</a>
        		<div class="dropdown-divider"></div>
        		<a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        	</div>
        </li>
		--}}

		{{-- 
		<!-- Notifications Dropdown Menu -->
		<li class="nav-item dropdown">
			<a class="nav-link" data-toggle="dropdown" href="#">
				<i class="far fa-bell"></i>
				<span class="badge badge-warning navbar-badge">15</span>
			</a>
			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				<span class="dropdown-item dropdown-header">15 Notifications</span>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item">
					<i class="fas fa-envelope mr-2"></i> 4 new messages
					<span class="float-right text-muted text-sm">3 mins</span>
				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item">
					<i class="fas fa-users mr-2"></i> 8 friend requests
					<span class="float-right text-muted text-sm">12 hours</span>
				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item">
					<i class="fas fa-file mr-2"></i> 3 new reports
					<span class="float-right text-muted text-sm">2 days</span>
				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
			</div>
		</li>
		--}}
		@auth
		<li class="nav-item dropdown">
			<a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
				<img src="{{ route('users-avatar', auth()->id()) }}" class="img-circle img-avatar avatar-sm" />
				&nbsp; {{ auth() -> user() -> family_name }}
				{{ auth() -> user() -> given_name }}
				&nbsp; <x-icon icon="caret-down" />
			</a>
			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
				<span class="dropdown-item dropdown-header" style="display:none">
					<strong>
					{{ auth()->user()->given_name }}
					{{ auth()->user()->family_name }}
					</strong>
				</span>

				<div class="dropdown-divider"></div>

				<a href="{{ route('user-profile') }}" class="dropdown-item">
					<x-icon icon="id-card" class="fa-fw text-info" />
					&nbsp; {{ __('users.actions.profile') }}
					<span class="float-right text-muted text-sm">???</span>
				</a>

				<a href="{{ route('settings.index') }}" class="dropdown-item">
					<x-icon icon="cogs" class="fa-fw text-info" />
					&nbsp; {{ __('users.actions.settings') }}
					<span class="float-right text-muted text-sm">???</span>
				</a>

				@if( auth()->user()->isSuperAdmin() )
				<div class="dropdown-divider"></div>
				<a href="{{ route('service.index') }}" class="dropdown-item">
					<x-icon icon="wrench" class="fa-fw text-info" />
					&nbsp; {{ __('service.controller') }}
					<span class="float-right text-muted text-sm">???</span>
				</a>
				@endif
				<div class="dropdown-divider"></div>
				<a href="{{ route('logout') }}" class="dropdown-item"
					onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
					<x-icon icon="sign-out-alt" class="fa-fw text-danger" />
					&nbsp; {{ __('app.actions.logout') }}
				</a>

				<x-form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"></x-form>
			</div>
				{{-- 
				<div class="btn-group hide-on-collapse pos-right">
					<div class="dropdown-menu" role="menu" style="">
						<div class="dropdown-divider"></div>
					</div>
				</div>
				--}}
		</li>
		@else
			@if( ! request()->is('login') )
			<li class="nav-item">
				<a class="nav-link" href="{{ route('login') }}">
					<x-icon icon="sign-in-alt" />
					&nbsp; {{ __('app.actions.login') }}
				</a>
			</li>
			@endif
		@endauth

		<!-- Navbar Search -->
		{{-- 
		<li class="nav-item">
			<a class="nav-link" data-widget="navbar-search" href="#" role="button">
				<i class="fas fa-search"></i>
			</a>
			<div class="navbar-search-block">
				<form class="form-inline">
					<div class="input-group input-group-sm">
						<input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
						<div class="input-group-append">
							<button class="btn btn-navbar" type="submit">
								<i class="fas fa-search"></i>
							</button>
							<button class="btn btn-navbar" type="button" data-widget="navbar-search">
								<i class="fas fa-times"></i>
							</button>
						</div>
					</div>
				</form>
			</div>
		</li>
		--}}

		<li class="nav-item">
			<a class="nav-link" data-widget="fullscreen" href="#" role="button">
				<x-icon icon="expand-arrows-alt" />
			</a>
		</li>
		
		<li class="nav-item">
			<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
				<x-icon icon="bars" />
			</a>
        </li>
    </ul>
</nav><!-- /.navbar -->
