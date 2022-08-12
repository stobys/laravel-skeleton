@if ( in_array('back', $buttons) )
    <a href="{{ url()->previous() }}" class="btn btn-lg btn-adient">
        <x-icon icon="chevron-left" />
        &nbsp; {{ trans('app.tip.go-back') }}
    </a>
@endif

@if ( in_array('edit', $buttons) )
    {{ html()->a(route( $module .'.edit', [$model->id]))->class('btn btn-lg btn-adient')->open() }}
        <x-icon icon="edit" />
        &nbsp; {{ trans('app.tip.edit') }}
    {{ html()->a()->close() }}
@endif

@if ( in_array('change-password', $buttons) )
    {{ html()->submit()->class('btn btn-lg btn-success')->open() }}
        <x-icon icon="key" />
        &nbsp; {{ trans('users.label.pass-change') }}
    {{ html()->submit()->close() }}
@endif

@if ( in_array('submit', $buttons) )
    {{ html()->submit()->class('btn btn-lg btn-success')->open() }}
        <x-icon icon="save" />
        &nbsp; {{ trans('app.form.save') }}
    {{ html()->submit()->close() }}
@endif

@if ( in_array('cancel', $buttons))
    {{ html()->a(route( $module .'.index'))->class('btn btn-lg btn-warning')->open() }}
        <x-icon icon="times" />
        &nbsp; {{ trans('app.actions.cancel') }}
    {{ html()->a()->close() }}
@endif

@if( in_array('delete', $buttons) && ! $model->trashed() )
    <a href="{{ route($module .'.delete', [$model->id]) }}" class="btn btn-lg btn-danger">
        <x-icon icon="trash-o" />
        &nbsp; {{ trans('app.tip.delete') }}
    </a>
@endif

@if( in_array('restore', $buttons) && $model->trashed() )
    <a href="{{ route( $module .'.restore', [$model->id]) }}" class="btn btn-lg btn-adient">
        <x-icon icon="trash-o" />
        &nbsp; {{ trans('app.tip.restore') }}
    </a>
@endif

@if ( in_array('execute', $buttons) )
    {{ html()->submit()->class('btn btn-lg btn-success')->open() }}
        <x-icon icon="paper-plane" />
        &nbsp; {{ trans('app.actions.execute') }}
    {{ html()->submit()->close() }}
@endif
