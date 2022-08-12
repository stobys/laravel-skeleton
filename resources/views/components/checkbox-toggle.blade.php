@props([
    'on'  => 'primary',
    'off'	=> 'default',

    'size' => 'normal', // mini, small, normal, large

    'onstyle' => 'primary',     // -- primary,secondary,success,danger,warning,info,light,dark
    'offstyle' => 'secondary',  // -- primary,secondary,success,danger,warning,info,light,dark

    'disabled'  => null,
    'read-only'  => null,
])

@php
	$icon = $icon ? 'fa-'. $icon : '';
	$size = $size ? 'fa-'. $size : '';
	$fw = $fw ? 'fa-fw' : '';
@php

    $disabled = $disabled ? 'disabled' : '';
    $readOnly = $readOnly ? 'readonly' : '';

@endphp

<input type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled">


                <input type="checkbox" data-toggle="switch">

<input type="checkbox" data-toggle="switch">
<input type="checkbox" data-toggle="switch" checked data-inverse="true" data-on-color="secondary" data-off-color="default">
<input type="checkbox" data-toggle="switch" data-on-color="secondary" data-on-text="OUI" data-off-color="default" data-off-text="NON">
<input type="checkbox" data-toggle="switch" disabled>
<input type="checkbox" data-toggle="switch" data-size="mini">
<input type="checkbox" data-toggle="switch" data-handle-width="100">
<input type="checkbox" data-toggle="switch" data-handle-width="10">
<input type="radio" name="radio" data-toggle="switch" data-on-text="Man">
