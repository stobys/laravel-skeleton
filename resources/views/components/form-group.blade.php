@props([
    'name' => '',
    'message' => '',
    'required' => null,
    'selectors' => null,
])

@php
    $required = is_null($required) ? '' : '*';
    $selectors = empty($selectors) ? false : true;
@endphp

<div class="form-group">
    @if( isset($label) )
        {{ $label }}
    @else
        <label class="control-label" for="{{ $name }}">
            {{ langField($name) }}
            {{ $required }}

            @if( $selectors )
                <span class="btn btn-info btn-xs select-all">
                    {{ trans('global.select_all') }}
                </span>
                <span class="btn btn-info btn-xs deselect-all">
                    {{ trans('global.deselect_all') }}
                </span>
            @endif

            {{-- {{ $labelButtons }} --}}
        </label>
    @endif

    {{ $slot }}

    @error($name)
        <em class="invalid-feedback">{{ $message }}</em>
        {{-- <p class="help-block text-danger">{{ $message }}</p> --}}
    @enderror

    <p class="helper-block">
        {{ langField($name, true) }}
    </p>
</div>
