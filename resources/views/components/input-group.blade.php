@props([
    'clear' => null,
    'copy'  => null,

    'attribs' => [
        'class' => 'input-group',
    ],
])

@php
    $clear = $clear ?? null;
    $copy = $copy ?? null;
@endphp

<div {{ $attributes->merge($attribs) }}>
    @if( $copy )
        <x-input-group-prepend class="clickable" data-js-action="inputGroupCopyToClipboard">
            <x-icon fw icon="copy" />
        </x-input-group-prepend>
    @endif

    {{ $slot }}

    @if( $clear )
        <x-input-group-append class="clickable" data-js-action="clearInputGroupField">
            <x-icon icon="times" />
        </x-input-group-append>
    @endif
</div>
