@props([
    'bg' => 'danger',
    'icon' => 'ban',
    'title' => 'Callout!',
    'content' => null,
])

@php
	$content = $content ?? $slot;
@endphp

<div class="callout callout-{{ $bg }}">
	<h5>
		<i class="icon fas fa-{{ $icon }} mr-2"></i>
		{{ $title }}
	</h5>

	<p>
		{{ $content }}
	</p>
</div>
