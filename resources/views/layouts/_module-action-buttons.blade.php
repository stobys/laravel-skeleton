    @if ( in_array('save', $buttons) )
        <button type="submit" class="btn btn-success" form="actionForm">
            <i class="fa fa-fw fa-save mr-2"></i>
            {{ trans('global.save') }}
        </button>
	@endif

    @if ( in_array('edit', $buttons) && $model -> editable() )
        <a href="{{ route(controllerRoute('edit'), [$model->id]) }}" class="btn btn-secondary">
            <i class="fa fa-fw fa-edit mr-2"></i>
            {{ trans('global.edit') }}
        </a>
    @endif

    @if ( in_array('delete', $buttons) && $model -> deletable() )
        <x-form id="deleteForm" action="{{ route(controllerRoute('destroy'), $model->id) }}" method="DELETE"
            onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display:inline-block;">
            <button type="submit" class="btn btn-danger tip" value="{{ trans('global.delete') }}"
                title="{{ trans('global.delete') }}" data-toggle="tooltip" data-placement="top">
                    <x-icon icon="trash" fw />
                    {{ trans('global.delete') }}
            </button>
        </x-form>

        {{--//
        <div class="btn-group">
            <a href="#" type="button" class="btn btn-danger">Action</a>
            <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" href="#">
                    <x-icon icon="edit" fw />
                    .. and go to edit
                </a>
                <a class="dropdown-item" href="#">
                    <x-icon icon="list" fw />
                    .. and go to index
                </a>
            </div>
        </div>
        //--}}
    @endif

    @if ( in_array('restore', $buttons) && $model -> restorable() )
        <x-form id="restoreForm" action="{{ route(controllerRoute('restore'), $model->id) }}" method="DELETE"
            onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display:inline-block;">
            <button type="submit" class="btn btn-danger tip" value="{{ trans('global.restore') }}"
                title="{{ trans('global.delete') }}" data-toggle="tooltip" data-placement="top">
                    <x-icon icon="trash" fw />
                    {{ trans('global.restore') }}
            </button>
        </x-form>
    @endif

    <a href="" class="btn btn-link btn-separator"></a>

    @if ( in_array('cancel', $buttons) )
        @php
            switch ( $action )
            {
                case 'show':
                case 'edit':
                    $cancelUrl = url()->previous();
                break;

                case 'create':
                default:
                    $cancelUrl = route(controllerRoute('index'));
                break;
            }
        @endphp

	    <a href="{{ $cancelUrl }}" class="btn btn-secondary">
	        <i class="fa fa-fw fa-times mr-2"></i>
	        {{ trans('global.cancel') }}
	    </a>
	@endif

    <a href="{{ route(controllerRoute('index')) }}" class="btn btn-secondary">
        <i class="fa fa-fw fa-list mr-2"></i>
        {{ trans('global.back_to_list') }}
    </a>
