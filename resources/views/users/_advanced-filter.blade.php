<div class="row">
    <div class="col-sm-3">
        <x-form-group name="username">
            <div class="input-group">
                {{ html() -> text('username', session('filters.'. controllerName() .'.username'))
                -> placeholder( trans(controllerName() .'.fields.username_placeholder') )
                -> attribute('form', 'filterForm')
                -> class('form-control')
                }}
                <div class="input-group-append clickable" @click="clearInputGroupField">
                    <span class="input-group-text">
                        <x-icon icon="times" />
                    </span>
                </div>
            </div>
        </x-form-group>
    </div>
    <div class="col-sm-3">
        <x-form-group name="email">
            <div class="input-group">
                {{ html() -> text('email', session('filters.'. controllerName() .'.email'))
                -> placeholder( trans(controllerName() .'.fields.email_placeholder') )
                -> attribute('form', 'filterForm')
                -> class('form-control')
                }}
                <div class="input-group-append clickable" @click="clearInputGroupField">
                    <span class="input-group-text">
                        <x-icon icon="times" />
                    </span>
                </div>
            </div>
        </x-form-group>
    </div>
    <div class="col-sm-6">
        @php
        $selectors = true;
        @endphp

        <x-form-group name="roles" :selectors="$selectors">
            <div class="input-group">
                {{ html() -> multiselect('roles', $roles, session('filters.'. controllerName() .'.roles', []))
                -> class('form-control select2able')
                -> attribute('style', 'width:100%')
                }}
            </div>
        </x-form-group>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <x-form-group name="family_name">
            <div class="input-group">
                {{ html() -> text('family_name', session('filters.'. controllerName() .'.family_name'))
                -> placeholder( trans(controllerName() .'.fields.family_name_placeholder') )
                -> attribute('form', 'filterForm')
                -> class('form-control')
                }}
                <div class="input-group-append clickable" @click="clearInputGroupField">
                    <span class="input-group-text">
                        <x-icon icon="times" />
                    </span>
                </div>
            </div>
        </x-form-group>
    </div>
    <div class="col-sm-3">
        <x-form-group name="given_name">
            <div class="input-group">
                {{ html() -> text('given_name', session('filters.'. controllerName() .'.given_name'))
                -> placeholder( trans(controllerName() .'.fields.given_name_placeholder') )
                -> attribute('form', 'filterForm')
                -> class('form-control')
                }}
                <div class="input-group-append clickable" @click="clearInputGroupField">
                    <span class="input-group-text">
                        <x-icon icon="times" />
                    </span>
                </div>
            </div>
        </x-form-group>
    </div>
</div>