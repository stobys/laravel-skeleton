    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                    &nbsp; {{ langActionTitle('show') }}
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">
                            <i class="fa fa-fw fa-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route( controllerRoute('index') ) }}">
                            {{ langTitlePlural() }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a class="mr-2" href="{{ route( controllerRoute('show'), $model -> id ) }}">
                            @lang('global.show')
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
