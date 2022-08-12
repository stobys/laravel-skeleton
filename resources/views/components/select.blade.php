@props([
	'collection'	=> null,
	'selected'		=> [],
	'attribs'	=> [
		'class'	=> 'select2 select2able',
		'style'	=> 'width: 100%;'
	],
])

<select {{ $attributes->merge($attribs) }}>
	{{ $slot }}
</select>
