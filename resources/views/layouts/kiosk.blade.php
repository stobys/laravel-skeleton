<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="refresh" content="300">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <x-layout.favicon />
        @vite()

        @yield('headerScripts')
    </head>


    <body id="app" class="hold-transition layout-top-nav">
        @include('partials._js_vars')
        <div class="wrapper">
            {{-- Content Wrapper. Contains page content --}}
            <div class="content-wrapper">
                {{-- Content Header (Page header) --}}
                <section class="content-header">
                    @section('content-header')
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1>Welcome</h1>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('root') }}">
                                                <i class="fa fa-fw fa-home"></i>
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item active">
                                            Welcome
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
        </div>

        @yield('scripts')

        <script type="text/javascript">
            var ctrlPressed = false;

            var appBaseUrl = '{{ URL::to('/') }}/';
            var appLang = '{{ Lang::locale() }}';
            var appCsrfToken = '{{ csrf_token() }}';

            @yield('footerScripts')

        </script>

        <div id="loading-wrapper" style="display:none;">
            <img id="loading-image" src="{{  asset('img/ajax-loader.gif') }}" alt="Loading..." />
        </div>

    </body>
</html>
