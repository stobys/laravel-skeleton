{{-- Main Sidebar Container --}}
<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
    {{-- Brand Logo --}}
    <a href="{{ route('root') }}" class="brand-link">
        <img src="{{ asset('img/app-icon-2-400.jpg') }}" alt="Logo" class="brand-image img-circle elevation-3">
        
        <span class="brand-text font-weight-light ml-2">
            {{ env('APP_NAME', 'APP') }}
        </span>
    </a>

    {{-- Sidebar --}}
    <div class="sidebar">
        {{-- SidebarSearch Form --}}
        {{--
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        --}}

        {{-- Sidebar Menu --}}
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent text-sm" data-widget="treeview" role="menu" data-accordion="false">
                @canany(['users.index', 'roles.index','permissions.index', 'projects.index', 'materials.index'])
                <li class="nav-header">ZARZĄDZANIE</li>
                @endcanany
                @can('users.index')
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ controller('users', 'active') }}">
                        <x-icon icon="users" class="nav-icon" />
                        <p>
                            {{ __('users.controller') }}
                        </p>
                    </a>
                </li>
                @endcan
                @can('roles.index')
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link {{ controller('roles', 'active') }}">
                        <x-icon icon="user-shield" class="nav-icon" />
                        <p>
                            Role
                        </p>
                    </a>
                </li>
                @endcan
                @can('permissions.index')
                <li class="nav-item">
                    <a href="{{ route('permissions.index') }}" class="nav-link {{ controller('permissions', 'active') }}">
                        <x-icon icon="list" class="nav-icon" />
                        <p>
                            Uprawnienia
                        </p>
                    </a>
                </li>
                @endcan
                @if( auth()->check() && auth()->user()->isSuperAdmin() )
                <li class="nav-item">
                    <a href="{{ route('sessions.index') }}" class="nav-link {{ controller('sessions', 'active') }}">
                        <x-icon icon="list" class="nav-icon" />
                        <p>
                            Sesje Użytkowników
                        </p>
                    </a>
                </li>
                @endif
            </ul>
        </nav><!-- /.sidebar-menu -->
    </div><!-- /.sidebar -->

    @unless( $sidebarCollapse )
        <div class="sidebar-custom">
        @guest
            @if( ! request()->is('login') )
            <a href="{{ route('login') }}" class="btn btn-secondary hide-on-collapse pos-right">
                {{ trans('app.actions.login') }}
            </a>
            @endif
        @endguest
        </div>
    @endunless
</aside>
