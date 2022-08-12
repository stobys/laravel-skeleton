@props([
    'bg' => 'danger',
    'icon' => 'ban',
    'title' => 'Alert!',
    'content' => null,
])

@php
	$content = $content ?? $slot;
@endphp

<div class="alert alert-{{ $bg }} alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
		×
	</button>
	<h5>
		<i class="icon fas fa-{{ $icon }}"></i>
		{{ $title }}
	</h5>
	{{ $content }}
</div>
