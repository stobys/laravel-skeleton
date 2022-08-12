@php
    $activeRolesTabActiveClass = request()->is('*/trash') ? '' : 'active';
    $trashedRolesTabTabActiveClass = request()->is('*/trash') ? 'active' : '';
@endphp

<x-layout.app :title="config('app.name') .' :: '. __('roles.controller')" x-data="alpineRoles">
    @section('content-header')
        <x-layout.content-header :heading="__('roles.index-title')"
            module_name="nazwa modulu" moduleName="nazwa modulu"
        >
            <x-slot name="breadcrumbs">
                <li class="breadcrumb-item">
                    <a href="{{ route(controllerRoute('index')) }}">
                        Role
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="{{ route(controllerRoute('index')) }}" class="mr-2">
                        Lista
                    </a>
                </li>
            </x-slot>
        </x-layout.content-header>
    @endsection
        
    @section('index-filter')
        <x-layout.index-filter query="{{ session('filters.'. controllerName() .'.default_query_string') }}"
            :sortOptions="$sortOptions">
            @includeIf('roles._advanced-filter')
        </x-layout.index-filter>
    @endsection

    <x-layout.index-content controller="inventories.booking" :models="$models">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-adient-teal card-outline">
                    <div class="card-header p-3 text-right border-bottom-0">
                        @if ( request()->is('*/trash') )
                            @can( controllerRoute('restore') )
                                <button type="button" class="btn btn-danger btn-bulk-action restore-selected float-left" style="display:none"
                                    data-href="{{ route(controllerRoute('massRestore')) }}" data-method="DELETE"
                                    @click.stop.prevent="restoreSeletedModels($el)"
                                    data-confirm="{{ __('roles.messages.confirm-restore-selected') }}"
                                    data-confirm-text="{{ __('roles.messages.confirm-restore-selected-approve') }}"
                                    data-cancel-text="{{ __('roles.messages.confirm-restore-selected-deny') }}"
                                >
                                    <x-icon fw icon="trash" /> &nbsp;
                                    {{ trans('global.restore-selected') }}
                                </button>
                            @endcan
                        @else
                            @can( controllerRoute('delete') )
                                <button type="button" class="btn btn-danger btn-bulk-action delete-selected float-left" style="display:none"
                                    data-href="{{ route(controllerRoute('massDelete')) }}" data-method="DELETE"
                                    @click.stop.prevent="deleteSeletedModels($el)"
                                    data-confirm="{{ __('roles.messages.confirm-delete-selected') }}"
                                    data-confirm-text="{{ __('roles.messages.confirm-delete-selected-approve') }}"
                                    data-cancel-text="{{ __('roles.messages.confirm-delete-selected-deny') }}"
                                >
                                    <x-icon fw icon="trash" /> &nbsp;
                                    {{ trans('global.delete-selected') }}
                                </button>
                            @endcan
                        @endif

                        <a class="btn btn-success" href="{{ route( controllerRoute('create') ) }}">
                            <x-icon fw icon="plus" class="mr-2" />
                            {{ trans(controllerName() .'.add-model') }}
                        </a>
                    </div>
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ $activeRolesTabActiveClass ?? '' }}" href="{{ route('roles.index') }}"
                                    role="tab" aria-selected="false">{{ __('roles.tabs.active') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $trashedRolesTabTabActiveClass ?? '' }}"
                                    href="{{ route('roles.trash') }}" role="tab"
                                    aria-selected="false">{{ __('roles.tabs.trashed') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body p-0">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    @if( $models->count() )
                                                        <thead class="bg-light uppercase">
                                                            @includeIf('roles._index-row-th')
                                                        </thead>
                                                    @endif
    
                                                    <tbody>
                                                        @forelse($models as $model)
                                                            @includeIf('roles._index-row', ['model' => $model])
                                                        @empty
                                                            @includeFirst([
                                                                'roles._index-no-rows',
                                                                'layouts._module-no-rows',
                                                            ])
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><!-- /.card-body -->
    
                                        @if( $models->count() )
                                        <div class="card-footer">
                                            <div class="m-2 text-center">
                                                {!! $models->links('partials._paginator') !!}
                                            </div>
                                        </div>
                                        @endif
                                    </div><!-- /.card -->
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    </x-layout.index-content>
</x-layout.app>