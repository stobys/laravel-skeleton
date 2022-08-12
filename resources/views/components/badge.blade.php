@props([
    'bg' => 'primary',
    'title' => null,
    'content' => null,
])

<span title="{{ $title }}" class="badge badge-{{ $bg }}">{{ $content ?? $slot }}</span>
