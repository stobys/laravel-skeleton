@props([
    'attribs' => [
        'class' => 'input-group-append',
    ],
])

<div {{ $attributes->merge($attribs) }}>
    <span class="input-group-text">
        {{ $slot }}
    </span>
</div>
