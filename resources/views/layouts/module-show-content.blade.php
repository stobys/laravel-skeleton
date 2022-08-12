<div class="card">
    <x-form action="{{ route(controllerRoute('index')) }}">
        {{--
        <div class="card-header text-right">
            {{ controllerActionTitle('edit') }}
        </div>
        --}}

        <div class="card-body">
                @include(controllerName() .'._create_edit_show')
        </div>

        <div class="card-footer text-right">
            @include('layouts._module-action-buttons', [
                'buttons' => ['edit', 'delete', 'restore']
            ])
        </div>
    </x-form>
</div>
