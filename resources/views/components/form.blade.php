@props([
	'action'	=> '#',
	'method'	=> 'POST',
	'hasFiles'	=> null,
	'attribs'	=> [],
	'noCsrf'	=> false,
])

@php
	$methods = [
		'GET'		=> 'GET',
		'POST'		=> 'POST',
		'PUT'		=> 'POST',
		'HEAD'		=> 'POST',
		'DELETE'	=> 'POST',
		'PATCH'		=> 'POST',
		'OPTIONS'	=> 'POST',
	];

	$method = strtoupper($method);
	$method = in_array($method, array_keys($methods)) ? $method : 'POST';

	if ( $hasFiles )
	{
		$attribs['enctype'] = 'multipart/form-data';
	}

	if ( $noCsrf )
	{
		$noCsrf = true;
	}
@endphp

<form action="{{ $action }}" method="{{ $methods[$method] }}" {{ $attributes->merge($attribs) }}>
	@if( ! $noCsrf )
		@csrf
	@endif

    @if( ! in_array($method, ['GET', 'POST']) )
    	@method($method)
    @endif

    {{ $slot }}
</form>
