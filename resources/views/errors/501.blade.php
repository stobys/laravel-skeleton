@extends('layouts.app')

@section('headerStyles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Shrikhand&display=swap');
</style>
@endsection

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6 offset-md-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">
                        <x-icon icon="home" fw />
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    @lang('app.errors.501.code')
                </li>
                <li class="breadcrumb-item active">
                    @lang('app.errors.501.name')
                </li>
            </ol>
        </div>
    </div>
</div><!-- /.container-fluid -->
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3 text-center http-error-code">
            #501
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 offset-md-3 text-center http-error-desc">
            {{ $exception->getMessage() ?: __('app.errors.501.description') }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 offset-md-3 text-center py-4">
            <a href="{{ url()->previous() }}" class="btn btn-adient-teal py-3">
                <x-icon icon="arrow-circle-left" fw /> &nbsp;
                {{ __('app.labels.go-to-previous-page') }}
            </a>
            <a href="{{ route('home') }}" class="btn btn-adient-green py-3">
                <x-icon icon="home" fw /> &nbsp;
                {{ __('app.labels.go-to-homepage') }}
            </a>
        </div>
    </div>

    @debug
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">
                    {{ $exception->getMessage() }}
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>

            </div>
            <div class="card-body" style="display: block;">
                {{ $exception->getFile() }} : {{ $exception->getLine() }}

                <pre>{{ $exception->getTraceAsString() }}</pre>
            </div>
        </div>
    @enddebug
@endsection