@props([
	'th'		=> null,
	'filter'	=> null,
	'module'	=> controllerName(),
	'model'		=> optional(),
	'preview'	=> null,
	'edit'		=> null,
	'delete'	=> null,
	'restore'	=> null,
	'visible'	=> true,
])

@php
	$preview = $preview ? 'preview' : null;
	$restore = $restore ? 'restore' : null;
	$delete = $delete ? 'delete' : null;
	$edit = $edit ? 'edit' : null;
	$th = $th ? 'th2' : null;
	$filter = $filter ? 'filter2' : null;
@endphp

<tr style="position: relative;" {{ $attributes->merge(['id' => "{$module}-row-{$model->id}"]) }} data-model-id="{{ $model->id }}">
	@if( $th )
		<th {{ $attributes->merge(['class' => 'text-center', 'style' => 'width:40px;' ]) }}>
			{{ html() -> checkbox('bulkIdsAll', false, '1') -> class('rowsSelectAll icheckable') }}
	    </th>
	@elseif( $filter )
		<th colspan="2">&nbsp;</th>
	@else
		<td {{ $attributes->merge(['class' => 'text-center', 'style' => 'width:40px;' ]) }}>
		    {{ html()->checkbox('bulkIds[]', false, $model->id)->id('bulkId_'. $model->id)->class('rowSelectBox icheckable') }}
		    	<div class="row-actions">


			{{ $buttonsPrepend ?? '' }}

		    @if( $preview && $model -> viewable() )
		        <a href="{{ $model -> url('show') }}" class="btn btn-link tip" title="{{ trans('global.view') }}" data-toggle="tooltip" data-placement="top">
		                <x-icon icon="file" fw />
		        </a>
		    @endif

		    @if ( $edit && $model -> editable() )
		        <a href="{{ $model -> url('edit') }}" class="btn btn-link tip" title="{{ trans('global.edit') }}" data-toggle="tooltip" data-placement="top">
		                <x-icon icon="edit" fw />
		        </a>
		    @endif


		    @if ( $delete && $model -> deletable() )
				<x-form id="destroyForm_{{ $model->id }}" action="{{ $model -> url('destroy') }}" method="DELETE" style="display:inline-block;">
					<button type="submit" class="btn btn-link text-red tip" value="{{ trans('global.delete') }}"
						title="{{ trans('global.delete') }}" data-toggle="tooltip" data-placement="top"
						@click.stop.prevent="deleteModel($el)"
						data-confirm="{{ __(controllerName() .'.messages.confirm-delete', ['user' => $model->id]) }}"
            			data-confirm-text="{{ __(controllerName() .'.messages.confirm-delete-approve') }}"
            			data-cancel-text="{{ __(controllerName() .'.messages.confirm-delete-deny') }}"
					>
						<x-icon fw icon="trash" />
					</button>
				</x-form>
		    @endif

		    @if ( $restore && $model -> restorable() )
				<x-form id="restoreForm_{{ $model->id }}" action="{{ $model -> url('restore') }}" method="DELETE" style="display:inline-block;">
		            <button type="submit" class="btn btn-link text-red tip" value="{{ trans('global.restore') }}"
		                title="{{ trans('global.restore') }}" data-toggle="tooltip" data-placement="top"
						@click.stop.prevent="restoreModel($el)"
						data-confirm="{{ __(controllerName() .'.messages.confirm-restore', ['user' => $model->id]) }}"
            			data-confirm-text="{{ __(controllerName() .'.messages.confirm-restore-approve') }}"
            			data-cancel-text="{{ __(controllerName() .'.messages.confirm-restore-deny') }}"
					>
		                <x-icon fw icon="trash" />
		            </button>
				</x-form>
		    @endif

			{{ $buttonsAppend ?? '' }}

		    	</div>

		</td>
	@endif

	{{ $slot }}

	@if( $th )
		{{--
	    <th {{ $attributes->merge(['style' => 'width:200px;' ]) }}>
	        {{ trans('global.actions') }}
	    </th>
	    --}}
	@elseif( $filter )
	    <th class="text-center">
            <button type="submit" class="btn btn-sm btn-success" data-js-action="submitFilterForm" form="filterForm">
                <x-icon icon="filter" />
            </button>
            <button type="clear" class="btn btn-sm btn-secondary" data-js-action="clearFilterForm" form="filterForm">
                <x-icon icon="broom" />
            </button>
	    </th>
	@else
		{{--
		<td class="text-center">
			{{ $buttonsPrepend ?? '' }}

		    @if( $preview && $model -> viewable() )
		        <a href="{{ route($routes['preview'], [$model->id]) }}" class="btn btn-sm btn-link tip" title="{{ trans('global.view') }}" data-toggle="tooltip" data-placement="top">
		                <x-icon icon="file" fw />
		        </a>
		    @endif

		    @if ( $edit && $model -> editable() )
		        <a href="{{ route($routes['edit'], [$model->id]) }}" class="btn btn-sm btn-link tip" title="{{ trans('global.edit') }}" data-toggle="tooltip" data-placement="top">
		                <x-icon icon="edit" fw />
		        </a>
		    @endif

		    @if ( $delete && $model -> deletable() )
				<x-form id="destroyForm" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
					action="{{ route(controllerRoute('destroy'), $model->id) }}" method="DELETE"
		            style="display:inline-block;">
			            <button type="submit" class="btn btn-sm btn-link text-red tip" value="{{ trans('global.delete') }}"
			                title="{{ trans('global.delete') }}" data-toggle="tooltip" data-placement="top">
			                    <x-icon icon="trash" fw />
			            </button>
				</x-form>
		    @endif

		    @if ( $restore && $model -> restorable() )
				<x-form id="restoreForm" action="{{ route(controllerRoute('restore'), $model->id) }}" method="DELETE"
		            onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display:inline-block;">
		            <button type="submit" class="btn btn-sm btn-link text-red tip" value="{{ trans('global.restore') }}"
		                title="{{ trans('global.restore') }}" data-toggle="tooltip" data-placement="top">
		                    <x-icon icon="trash" fw />
		            </button>
				</x-form>
		    @endif

			{{ $buttonsAppend ?? '' }}
		</td>
		--}}
	@endif
</tr>

