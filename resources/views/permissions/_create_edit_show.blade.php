<div class="row">
    <div class="col-md-6">
        <x-form-group name="group_id">
            {{ html() -> select('group_id', $groups, old('group_id', $model->group_id ?? null))
                -> class('form-control select2 select2able')
                -> attributeIf($action == 'show', 'disabled', 'disabled')
                -> classIf($errors->has('group_id'), 'is-invalid')
            }}
        </x-form-group>
    </div>

    <div class="col-md-6">
        <x-form-group name="name" required>
            {{ html() -> text('name') -> class('form-control')
                    -> value( old('name', isset($model) ? $model->name : '') )
                    -> attributeIf($action == 'show', 'disabled', 'disabled')
                    -> classIf($errors->has('name'), 'is-invalid')
                    -> placeholder('module.action')
            }}
        </x-form-group>
    </div>
</div>
