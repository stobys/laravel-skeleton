<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="refresh" content="300">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,800,800i,900,900i"
                rel="stylesheet">
                
        <!-- Styles -->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

        <script src="{{ asset('js/app.js') }}"></script>

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

        {{--// JS Scripts //--}}
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
