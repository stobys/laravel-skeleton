<div class="row">
    <div class="col-sm-3">
        <x-form-group name="username">
            <div class="input-group">
                {{ html() -> text('username', session('filters.'. controllerName() .'.username'))
                -> placeholder( trans(controllerName() .'.fields.username_placeholder') )
                -> attribute('form', 'filterForm')
                -> class('form-control')
                }}
                <div class="input-group-append clickable" data-js-action="clearInputGroupField">
                    <span class="input-group-text">
                        <x-icon icon="times" />
                    </span>
                </div>
            </div>
        </x-form-group>
    </div>
    <div class="col-sm-3">
        <x-form-group name="ip_address">
            <div class="input-group">
                {{ html() -> text('ip_address', session('filters.'. controllerName() .'.ip_address'))
                -> placeholder( trans(controllerName() .'.fields.ip_address') )
                -> attribute('form', 'filterForm')
                -> class('form-control')
                }}
                <div class="input-group-append clickable" data-js-action="clearInputGroupField">
                    <span class="input-group-text">
                        <x-icon icon="times" />
                    </span>
                </div>
            </div>
        </x-form-group>
    </div>
    <div class="col-sm-3">
        <x-form-group name="user_agent">
            <div class="input-group">
                {{ html() -> text('user_agent', session('filters.'. controllerName() .'.user_agent'))
                -> placeholder( trans(controllerName() .'.fields.user_agent') )
                -> attribute('form', 'filterForm')
                -> class('form-control')
                }}
                <div class="input-group-append clickable" data-js-action="clearInputGroupField">
                    <span class="input-group-text">
                        <x-icon icon="times" />
                    </span>
                </div>
            </div>
        </x-form-group>
    </div>
</div>