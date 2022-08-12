@props([
    'bg'  => 'green',
    'text' => null,
])

@php
	$text = $text ?? $slot;
@endphp

<!-- timeline time label -->
<div class="time-label">
	<span class="bg-{{ $bg }} p-2">
		{{ $text }}
	</span>
</div><!-- /.timeline-label -->
