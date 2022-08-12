@props([
    'id'        => 'file',
    'name'      => 'file',
    'icon'      => 'folder-open',
    
    'multiple'  => false,
    'accept'    => false,
])

@php
    if ( $multiple )
    {
        $multiple = true;
    }

    if ( $multiple && substr($name, -2) !== '[]' )
    {
        $name .= '[]';
    }
@endphp

<div class="form-group">
    <div class="input-group file-picker">
        <div class="input-group-prepend file-picker-trigger clickable">
            <span class="input-group-text">
                <x-icon fw :icon="$icon" class="mr-2" />
                {{ $multiple ? __('app.placeholder.choose-files') : __('app.placeholder.choose-file') }}
            </span>
        </div>
        <input type="file" name="{{ $name }}" class="d-none" 
            @if($multiple) multiple="multiple" @endif
            @if($accept) accept="{{ $accept }}" @endif
        >
        <input type="text" class="form-control file-picker-trigger clickable" readonly="readonly">
    </div>
</div>
