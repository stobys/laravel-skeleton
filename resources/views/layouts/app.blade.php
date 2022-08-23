<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <x-layout.favicon />
    @vite()

    @yield('headerStyles')
    @yield('headerScripts')
</head>

<body id="app" class="hold-transition sidebar-mini layout-fixed layout-footer-fixed layout-navbar-fixed
        {{ $sidebarCollapse ? 'sidebar-collapse' : '' }}">
    @include('partials._js_vars')

    <div class="wrapper">
        @includeIf('layouts._navbar-menu')
        {{-- @includeIf('layouts._navbar-menu-2nd') --}}
        @includeIf('layouts._sidebar-menu')

        {{-- Content Wrapper. Contains page content --}}
        <div class="content-wrapper p-3">
            <div id="toast-messages mt-2">
                @include('flash::message')
            </div>

            {{-- Content Header (Page header) --}}
            <section class="content-header">
                @section('content-header')
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Title</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('root') }}">
                                        <i class="fa fa-fw fa-home"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Module
                                </li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
                {{-- @includeFirst(['controller.content-header', 'layouts._content-header']) --}}
                @show
            </section>

            {{-- Main content --}}
            <section class="content">
                @yield('content')
            </section>
        </div><!-- /.content-wrapper -->

        @includeIf('layouts._footer')
        @includeIf('layouts._control-sidebar')
    </div>

    @yield('scripts')

    <script type="text/javascript" defer>
        var ctrlPressed = false;

            var appBaseUrl = '{{ URL::to('/') }}/';
            var appLang = '{{ Lang::locale() }}';
            var appCsrfToken = '{{ csrf_token() }}';

            // window.translations = {!! Cache::get('translations') !!};

            @yield('footerScripts')
    </script>

    <div id="loading-wrapper" style="display:none;">
        <img id="loading-image" src="{{  asset('img/ajax-loader.gif') }}" alt="Loading..." />
    </div>

    <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">
                    <p>One fine body&hellip;</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</body>

</html>
