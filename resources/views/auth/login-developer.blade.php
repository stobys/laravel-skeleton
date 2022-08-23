<div class="d-flex justify-content-center align-items-center h-100 mt-4">
    <div class="card card-danger login-card w-25">
        <div class="card-header">
            <h3 class="card-title">Developer Login Form</h3>
        </div>
        <div class="card-body">
            <x-form action="{{ route('developer-login') }}" method="POST">
                <div class="row align-items-center  px-4 py-3">
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text px-3">
                                <x-icon icon="user" fw />
                            </span>
                        </div>
                        {{ html() -> select('user', $users)
                                    -> class('form-control select2 select2able')
                        }}
                        <div class="input-group-append text-left">
                            <input type="submit" value="{{ trans('global.login') }}" class="btn btn-success float-right" tabindex="4">
                        </div>
                    </div>
                </div>
            </x-form>
        </div>
    </div>
</div>
