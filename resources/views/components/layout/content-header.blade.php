@props([
    'heading'     => null,
    'module_name' => $module_name ?? 'Module2',
    'moduleName' => $moduleName ?? 'Module2',

    'module_href' => '@TODO', // $module_href ?? route( controllerRoute('index') ),
    'action_name' => 'Index',
    'action_href' => '@TODO', //route( controllerRoute('index') ),
])

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-sm-6">
            @if( $heading)
                <h1>{{ $heading }}</h1>
            @endif
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">
                        <i class="fa fa-fw fa-home"></i>
                    </a>
                </li>
                {{ $breadcrumbs ?? '' }}
            </ol>
        </div>
        <hr />
    </div>
</div><!-- /.container-fluid -->
