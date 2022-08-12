@extends('layouts.app')

@section('headerStyles')
    <style>
        .center {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }

        .circle {
            background:#FF66CC;
            border-radius: 50%;
            margin:20px;
            box-shadow: 0px 0px 1px 1px #0000001a;
        }

        .green{
            background: #66FF99;
        }
        
        .orange{
            background: #f17c57fa;
        }
        
        .blue{
            background: #3652D9;
        }
        
        .rose{
            background:#FF66CC;
        }

        .pulse {
            animation: pulse-animation 1s infinite;
        }

        @keyframes pulse-animation {
            0% {
                box-shadow: 0 0 0 0px rgba(0, 0, 0, 0.2);
            }
            100% {
                box-shadow: 0 0 0 15px rgba(0, 0, 0, 0);
            }
        }

        #copied-text {
            font-family: monospace;
            white-space: pre;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Dashboard') }}
                        <span class="badge badge-success pulse m-2">1</span>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ auth()->check() ? __('You are logged in!') : __('You are _not_ logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
