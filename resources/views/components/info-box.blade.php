@props([
	'bg' => 'info',
	'icon' => null,
    'title' => null,
    'content' => null,
    'percent' => 0,
])

@php
	$icon = $icon ?: '';

	$content = $content ?? $slot;
@endphp

<div class="info-box">
	<span class="info-box-icon bg-{{ $bg }} elevation-1">
		<x-icon icon="{{ $icon }}" />
	</span>

	<div class="info-box-content">
		<span class="info-box-text">{{ $title ?? '' }}</span>
		<span class="info-box-number">{{ $content ?? '' }}</span>
		{{-- <div class="progress">
			<div class="progress-bar bg-info" style="width: {{ $percent }}%"></div>
		</div> --}}
		{{-- <span class="progress-description">{{ $percent }}%</span> --}}
	</div><!-- /.info-box-content -->
</div>
