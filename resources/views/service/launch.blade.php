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
                {{ __('service.actions.launch') }}
            </li>
        </ol>
    </div>
</div>
@endsection

@section('content')
    {{ html()->form('POST', route('service.execute', $function))->open() }}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <strong>{{ __('service.function.'. $function) }}</strong>
            </h3>
        </div>

        <div class="card-body">
            @includeIf('service.functions.'. $function)
        </div><!-- /.card-body -->
        
        <div class="card-footer">
            <div class="m-2 text-center">
                @include('partials._form_buttons_footer', ['module' => 'service', 'buttons' => ['execute', 'cancel']])
            </div>
        </div>
    </div><!-- /.card -->
    {{ html()->form()->close() }}

@endsection
