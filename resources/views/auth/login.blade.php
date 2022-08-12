@extends('layouts.app')

@section('content-header')
@endsection

@section('content')
    <div class="d-flex justify-content-center align-items-center h-100 mt-4">
        <div class="card login-card">
            @include('flash::message')
            
            @if( $errors->any() )
                <div class="card-body">
                    @error('username')
                        <div class="callout callout-danger">
                            {{-- <h5>{{ $message }}</h5> --}}
                            <p>{{ $message }}</p>
                        </div>
                    @enderror

                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            @endif
            <div class="card-body">
                @if( session()->has('message') )
                    <p class="alert alert-info">
                        {{ session()->get('message') }}
                    </p>
                @endif

                <x-form action="{{ route('login') }}" method="POST">
                    <div class="row align-items-center  px-4 py-3">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text px-3">
                                    <x-icon icon="user" fw />
                                </span>
                            </div>
                            <input id="username" name="username" tabindex="1" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" required autofocus placeholder="{{ trans('global.login_username') }}" value="{{ old('username', null) }}">
                            <div class="input-group-append text-left">
                                <select name="method" class="input-group-text text-left" tabindex="3">
                                    <option value="domain">adient.com</option>
                                    <option value="local">lokalnie</option>
                                </select>
                            </div>
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text px-3">
                                    <x-icon icon="key" fw />
                                </span>
                            </div>
                            <input id="password" name="password" tabindex="2" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end align-items-center px-3">
                        <input type="submit" value="{{ trans('global.login') }}" class="btn btn-success float-right" tabindex="4">
                    </div>
                </x-form>
            </div>
            {{--//
            <div class="card-footer links py-3">
                <div class="d-flex justify-content-between">
                    <div class="text-left">
                        <a href="#"> Sign Up </a>
                    </div>
                    <div class="text-right">
                        <a href="#">Forgot your password?</a>
                    </div>
                </div>
            </div>
            //--}}
        </div>
    </div>

    @env('local', 'staging')
        @includeIf('auth.login-developer')
    @endenv
@endsection

@section('content-old')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card-group">
            <div class="card p-4">
                <div class="card-body">
                    @if(session()->has('message'))
                        <p class="alert alert-info">
                            {{ session()->get('message') }}
                        </p>
                    @endif
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <h1>{{ trans('panel.site_title') }}</h1>
                        <p class="text-muted">{{ trans('global.login') }}</p>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </span>
                            </div>
                            <input name="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" required autofocus placeholder="{{ trans('global.login_username') }}" value="{{ old('username', null) }}">
                            @if($errors->has('username'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('username') }}
                                </div>
                            @endif
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                            </div>
                            <input name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">
                            @if($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>

                        <div class="input-group mb-4">
                            <div class="form-check checkbox">
                                <input class="form-check-input" name="remember" type="checkbox" id="remember" style="vertical-align: middle;" />
                                <label class="form-check-label" for="remember" style="vertical-align: middle;">
                                    {{ trans('global.remember_me') }}
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary px-4">
                                    {{ trans('global.login') }}
                                </button>
                            </div>
                            <div class="col-6 text-right">
                                <a class="btn btn-link px-0" href="{{ route('password.request') }}">
                                    {{ trans('global.forgot_password') }}
                                </a>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
