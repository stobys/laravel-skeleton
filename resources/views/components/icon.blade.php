@props([
	'icon' => null,
    'size' => null,
    'fw' => null,
])

@php
	$icon = $icon ? 'fa-'. $icon : '';
	$size = $size ? 'fa-'. $size : '';
	$fw = $fw ? 'fa-fw' : '';
@endphp

<i {{ $attributes->merge(['class' => "fas {$icon} {$size} {$fw}"]) }} aria-hidden="true"></i>
