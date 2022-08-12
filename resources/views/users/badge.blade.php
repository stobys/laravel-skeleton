@extends('layouts.empty')

@section('content')
  <x-qrcode code="U{{ $user->personal_no }}" text="{{ $user->fullname() }}" />

  <x-qrcode code="U0" text="WYLOGUJ" />
@endsection
