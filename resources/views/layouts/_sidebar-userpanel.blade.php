@auth
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent text-sm" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <x-icon icon="user" class="nav-icon text-warning" />
                        <p>
                            {{ auth() -> user() -> family_name }}
                            {{ auth() -> user() -> given_name }}
                            ({{ auth() -> user() -> username }})
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{--
                        <li class="nav-item">
                            <a href="{{ route('user-profile') }}" class="nav-link">
                                <i class="fas fa-user-circle nav-icon text-warning"></i>
                                <p>{{ trans('users.profile') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link">
                                <i class="fas fa-key nav-icon text-warning"></i>
                                <p>{{ trans('global.password-change') }}</p>
                            </a>
                        </li>
                        --}}
                        <li class="nav-item separator"></li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            >
                                <i class="fas fa-sign-out-alt nav-icon text-warning"></i>
                                <p>{{ trans('global.logout') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <x-form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"></x-form>
        </nav>
</div>
@endauth
