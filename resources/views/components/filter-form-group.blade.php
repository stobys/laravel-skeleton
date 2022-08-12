@props([
    'name' => '',
    'module' => 'general',
])

<div class="form-group">
    {!! html()->label(trans($module .'.model.'. $name))->for($name) !!}

    <div class="input-group bg-light mb-4">
    	{{ $slot }}

        <div class="input-group-append clickable" data-js-action="clearInputGroupField">
            <div class="input-group-text">
                <x-icon icon="times" />
            </div>
        </div>
    </div>
</div>
