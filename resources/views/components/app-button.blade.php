@props([
    'icon' => '',
    'text' => 'text',
    'badge' => '',
    'bg' => 'info'
])

<a {{ $attributes->merge(['class' => "btn btn-app"]) }}>
	@if($badge)
		<span class="badge bg-{{ $bg }}">{{ $badge }}</span>
	@endif
    <i class="fas fa-{{ $icon }}"></i>
    {{ $text }}
</a>
