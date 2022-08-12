@extends('layouts.app')

@section('content-header')
    @includeIf('layouts.module-create-header')
@endsection

@section('content')
    @includeIf('layouts.module-create-content', ['action' => 'create'])
@endsection
