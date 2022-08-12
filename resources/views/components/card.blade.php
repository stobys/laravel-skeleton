@props([
    'type'  => 'primary',

    'collapsed' => null,
    'outline' => null,

    'title' => '#',
    'footer' => '',

])

@php

    $collapsed = $collapsed ? 'collapsed-card' : '';
    $outline = $outline ? 'card-outline' : '';

@endphp
{{--
	<div {{ $attributes->merge(['class' => "{$colors[$class]} border-b p-4"]) }}>
--}}

<div {{ $attributes->merge(['class' => 'card card-'. $type .' '. $collapsed .' '. $outline]) }}>
	<div class="card-header">
		<h3 class="card-title">
			{{--<i class="fas fa-expand"></i> &nbsp; --}}
			<strong>
                {{ $title }}
            </strong>
		</h3>

		<div class="card-tools">
			{{--
			<span data-toggle="tooltip" title="{{ $badgeTitle }}" class="badge bg-{{ $badgeType }}">
				badge
			</span>
			<button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content" data-load-on-init="false">
              	<i class="fas fa-sync-alt"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize">
              	<i class="fas fa-expand"></i>
            </button>
			--}}
            <button type="button" class="btn btn-tool" data-card-widget="collapse"
				data-collapse-icon="fa-chevron-up" data-expand-icon="fa-chevron-down"
            >
                @if ( $collapsed )
                    <i class="fas fa-lg fa-chevron-down"></i>
                @else
                    <i class="fas fa-lg fa-chevron-up"></i>
                @endif
            </button>
            {{--
            <button type="button" class="btn btn-tool" data-card-widget="remove">
            	<i class="fas fa-times"></i>
            </button>
            --}}
        </div><!-- /.card-tools -->
	</div><!-- /.card-header -->

	<div class="card-body">
		{{ $slot }}
	</div><!-- /.card-body -->

	@if( $footer )
    	<div class="card-footer">
    		{{ $footer }}
    	</div><!-- /.card-footer -->
	@endif
</div>
