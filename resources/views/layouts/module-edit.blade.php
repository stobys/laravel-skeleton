@extends('layouts.app')

@section('content-header')
	@includeIf('layouts.module-edit-header')
@endsection

@section('content')
	@includeIf('layouts.module-edit-content', ['action' => 'edit'])
@endsection
