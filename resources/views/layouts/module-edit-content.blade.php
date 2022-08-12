<div class="card">
        {{--
        <div class="card-header text-right">
            {{ controllerActionTitle('edit') }}
        </div>
        --}}

        <div class="card-body">
            <x-form id="actionForm" action="{{ route(controllerRoute('update'), $model->id) }}" method="PATCH" has-files>
                @includeIf(controllerName() .'._create_edit_show')
            </x-form>
        </div>

        <div class="card-footer text-right">
            @includeIf('layouts._module-action-buttons', [
                'buttons' => ['save', 'cancel', 'delete', 'restore']
            ])
        </div>
</div>
