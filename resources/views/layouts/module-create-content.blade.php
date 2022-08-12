<div class="card">
        {{--
        <div class="card-header text-right">
            {{ controllerActionTitle('create') }}
        </div>
        --}}

        {{--
        <div class="card-header text-right">
            {{ controllerActionTitle('create') }}
        </div>
        --}}

        <div class="card-body">
            <x-form id="actionForm" action="{{ route(controllerRoute('store')) }}" method="PUT" has-files>
                @includeIf(controllerName() .'._create_edit_show')
            </x-form>
        </div>

        <div class="card-footer text-right">
            @include('layouts._module-action-buttons', [
                'buttons' => ['save', 'cancel']
            ])
        </div>
</div>
