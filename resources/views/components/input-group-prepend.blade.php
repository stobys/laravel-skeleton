@props([
    'attribs' => [
        'class' => 'input-group-prepend',
    ],
])

<div {{ $attributes->merge($attribs) }}>
    <span class="input-group-text">
        {{ $slot }}
    </span>
</div>
