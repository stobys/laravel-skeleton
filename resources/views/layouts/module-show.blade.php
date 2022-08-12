@extends('layouts.app')

@section('content-header')
	@include('layouts.module-show-header')
@endsection

@section('content')
	@include('layouts.module-show-content', ['action' => 'show'])
@endsection
