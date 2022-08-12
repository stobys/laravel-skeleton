@props([
	'id' => '',
	'module' => 'general',
])

{{--//
<tr {{ $attributes->merge(['id' => "{$module}-row-{$model->id}"]) }} data-model-id="{{ $model->id }}">
		<th {{ $attributes->merge(['class' => 'text-center', 'style' => 'width:40px;' ]) }}>
			{{ html() -> checkbox('bulkIdsAll', false, '1') -> data('js-action', 'toggleSelectedItems') -> class('rowsSelectAll icheckable') }}
	    </th>

	{{ $slot }}

		<td class="text-center">
			{{ $buttonsPrepend ?? '' }}

		    @if( $preview && $model -> viewable() )
		        <a href="{{ route($module .'-show', [$model->id]) }}" class="btn btn-sm btn-adient tip" title="{{ trans('app.model.preview') }}"
		            data-toggle="tooltip" data-placement="top">
		                <x-icon icon="file" fw />
		        </a>
		    @endif
		</td>
	@endif
</tr>
//--}}

{{ html()->form()->open() }}
	<div data-module="{{ $module }}" class="card card-warning @if ( ! session('filters.'. $module .'Filtered') ) collapsed-card @endif">
	    <div class="card-header">
	        <h3 class="card-title">
	            <button type="button" class="btn btn-tool text-muted" data-card-widget="collapse" data-collapse-icon="fa-chevron-up" data-expand-icon="fa-chevron-down">
	                @if ( session('filters.'. $module .'Filtered') )
	                    <i class="fas fa-lg fa-chevron-up"></i>
	                @else
	                    <i class="fas fa-lg fa-chevron-down"></i>
	                @endif
	            </button>
	            @lang('app.form.models-list-filter')
	        </h3>

	        <div class="card-tools">
	            <button type="submit" class="btn btn-sm btn-tool text-muted"
	            	title="{{ trans('app.model.filter_submit') }}" data-toggle="tooltip" data-placement="top">
	                <i class="fa fa-lg fa-filter"></i>
	            </button>




	            <button type="button" class="btn btn-tool text-muted" data-js-action="clearFilterForm"
	            	title="{{ trans('app.model.filter_clear') }}" data-toggle="tooltip" data-placement="top">
	                <i class="fa fa-lg fa-broom"></i>
	            </button>
	        </div><!-- /filter.card-tools -->
	    </div><!-- /filter.card-header -->

	    <div class="card-body">
	    	{{ $slot }}
	    </div><!-- /filter.card-body -->
	</div>
{{ html()->form()->close() }}

