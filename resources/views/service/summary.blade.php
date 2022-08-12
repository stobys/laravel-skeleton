@extends('layouts.app')

@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                {{ __('service.controller') }}
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">
                        <i class="fa fa-fw fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('service.index') }}">
                        {{ __('service.controller') }}
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    {{ __('service.actions.summary') }}
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <strong>{{ trans('service.label.function-summary') }} :: {{ trans('service.function.'. $function) }}</strong>
            </h3>
        </div>
    
        <div class="card-body">
            <pre>{{ var_dump($results) }}</pre>
        </div><!-- /.card-body -->
    
        <div class="card-footer">
            <div class="m-2 text-center">
                {{ html()->a(route('service.index'))->class('btn btn-lg btn-success')->open() }}
                    <x-icon icon="wrench"></x-icon>
                    &nbsp; {{ trans('service.label.service-functions') }}
                {{ html()->a()->close() }}
            </div>
        </div>
    </div><!-- /.card -->
@endsection
