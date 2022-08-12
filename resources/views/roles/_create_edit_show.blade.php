<x-form-group name="name" required>
    {{ html() -> text('name') -> class('form-control')
            -> value( old('name', isset($model) ? $model->name : '') )
            -> attributeIf($action == 'show', 'disabled', 'disabled')
            -> classIf($errors->has('name'), 'is-invalid')
    }}
</x-form-group>

<x-form-group name="permissions" selectors>
    {{ html() -> multiselect('permissions', $permissions) -> class('form-control select2able')
        -> value( old('permissions', isset($model) ? optional($model->permissions)->pluck('id') : '') )
        -> attributeIf($action == 'show', 'disabled', 'disabled')
        -> classIf($errors->has('title'), 'is-invalid')
    }}
</x-form-group>
