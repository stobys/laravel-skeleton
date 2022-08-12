<div class="row">
    <div class="col-sm-6">
        @php
            $selectors = true;
        @endphp

        <x-form-group name="groups" :selectors="$selectors">
            {{ html() -> multiselect('groups', $groups, session('filters.'. controllerName() .'.groups', []))
                -> class('form-control select2 select2able')
            }}
        </x-form-group>
    </div>
</div>
