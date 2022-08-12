@props([
    'striped' => null,
    'percent' => 50,
    'text'  => null,
    'type' => 'primary',
    'size'  => 'standard',
])

<div {{ $attributes->merge(['class' => 'progress progress-'. $size]) }}>
    <div class="progress-bar bg-{{ $type }} {{ $striped ? 'progress-bar-striped' : '' }}" role="progressbar" 
        aria-valuemin="0" aria-valuemax="100" aria-valuenow="{{ $percent }}" style="width: {{ $percent }}%">
        <span class="sr-only">{{ $text ?? $slot }}</span>
        {{ $text ?? $slot }}
    </div>
</div>
