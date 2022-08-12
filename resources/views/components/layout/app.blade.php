@props([
    'title'     => config('app.name', 'APP'),
    'heading'   => '',
    'livewire'  => null,
    'xData'    => null,
])

@php
    $livewire = $livewire ? true : false;
@endphp

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('favicon.png') }}" rel="icon" type="image/png">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,800,800i,900,900i"
        rel="stylesheet">

    @yield('headerStyles')
    @yield('headerScripts')

    @if($livewire)
        @livewireStyles
    @endif
</head>

<body id="app" class="hold-transition sidebar-mini layout-fixed layout-footer-fixed layout-navbar-fixed
        {{ $sidebarCollapse ? 'sidebar-collapse' : '' }}">
    @include('partials._js_vars')

    <div class="wrapper">
        @includeIf('layouts._navbar-menu')
        @includeIf('layouts._sidebar-menu')

        <button class="btn btn-warning btn-scroll scroll-to-top" title="Go to Top">
                <x-icon fw icon="angle-double-up" />
            </button>
            <button class="btn btn-warning btn-scroll scroll-to-bottom" title="Go to Bottom">
                <x-icon fw icon="angle-double-down" />
            </button>
        {{-- Content Wrapper. Contains page content --}}
        <div class="content-wrapper px-3" @if($xData) x-data="{{ $xData }}" @endif>
            <div id="toast-messages" class="pt-3">
                @include('flash::message')
            </div>

            {{-- Content Header (Page header) --}}
            <section class="content-header">
                @section('content-header')
                    <x-layout.content-header heading="{{ $heading }}"></x-layout.content-header>
                @show
                @section('index-filter')
                @show
            </section>

            {{-- Main content --}}
            <section class="content">
                {{ $slot }}
            </section>
        </div><!-- /.content-wrapper -->

        @includeIf('layouts._footer')
        @includeIf('layouts._control-sidebar')
    </div>

    {{--// JS Scripts //--}}
    @if($livewire)
        @livewireScripts
    @endif
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>

    @yield('scripts')

    <script type="text/javascript">
        var ctrlPressed = false;

            var appBaseUrl = '{{ URL::to('/') }}/';
            var appLang = '{{ Lang::locale() }}';
            var appCsrfToken = '{{ csrf_token() }}';

            $(document)
                    .ajaxStart(function () {
                        vAPP.showLoader();
                    })
                    .ajaxStop(function () {
                        vAPP.hideLoader();
                    })
                    .ajaxSuccess(function() {
                        initAfterAjax();
                    })
                    .ajaxError(function(event, jqxhr, settings, thrownError){
                        if ( jqxhr.status == 401 )
                        {
                            window.location = window.location;
                        }
                        else if ( jqxhr.status == 419 )
                        { // -- token mismatch, reload page and try again
                            vAPP.toastError('token mismatch, reload page and try again');
                        }
                        else if ( jqxhr.status == 422 )
                        { // -- validation error
                            console.log('AJAX reqest status : '+ jqxhr.status);

                            var errors = JSON.parse(jqxhr.responseText);
                            vAPP.toastError(errors.message);
                        }
                        else {
                            console.log('AJAX reqest status : '+ jqxhr.status);
                        }
                    });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $( document ).ready(function() {
                // initVue();
                initAfterAjax();

                @yield('readyScripts')
            })
            .keydown(function(event){
                if(event.which=="17")
                {
                    ctrlPressed = true;
                }
            })
            .keyup(function(){
                ctrlPressed = false;
            });

            // window.translations = {!! Cache::get('translations') !!};

            @yield('footerScripts')
    </script>

    <div id="loading-wrapper" style="display:none;">
        <img id="loading-image" src="{{  asset('img/ajax-loader2.gif') }}" alt="Loading..." />
    </div>

</body>
</html>
