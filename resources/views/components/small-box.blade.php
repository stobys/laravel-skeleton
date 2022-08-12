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

<div class="small-box bg-{{ $bg }}">
	<div class="inner">
		<h3>{{ $content }}</h3>
		<p>{{ $title }}</p>
		{{-- <div class="progress progress-xs">
			<div class="progress-bar bg-secondary" style="width: {{ $percent }}%"></div>
		</div> --}}
	</div>
	<div class="icon">
		<x-icon icon="{{ $icon }}" />
	</div>
</div>
