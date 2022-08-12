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
                    <a class="mr-2" href="{{ route('service.index') }}">
                        @lang('global.list')
                    </a>
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>{{ trans('service.label.function-name') }}</th>
                            <th>{{ trans('service.label.function-description') }}</th>
                            <th style="width:200px;">
                                {{ trans('app.labels.options') }}
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($functions as $function)
                        <tr>
                            <td>{{ $function['name'] }}</td>
                            <td>{{ $function['description'] }}</td>
                            <td class="text-center">
                                <a href="{{ route('service.launch', $function['name']) }}" class="btn btn-sm btn-secondary">
                                    <x-icon icon="play" class="text-danger" />
                                    &nbsp; {{ trans('service.label.launch-function') }}
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- /.card-body -->
    </div><!-- /.card -->

@endsection
