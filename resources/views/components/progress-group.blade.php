@props([
	'striped' => null,
	'percent' => 50,
	'text' => null,
	'type' => 'primary',
	'count'	=> 0,
	'max'	=> 100,
])

<div class="progress-group">
	{{ $text ?? $slot }}
	<span class="float-right">
		<b>{{ $count }}</b>/{{ $max }}
	</span>
	<div class="progress progress-sm">
		<div class="progress-bar {{ $striped ? 'progress-bar-striped' : '' }} bg-{{ $type }}" style="width: {{ $percent }}%"></div>
	</div>
</div>
