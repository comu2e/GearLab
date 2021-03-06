@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Gear Lab') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row justify-content-center">
                        <img src={{asset('/img/GearLab/campall.jpg')  }} width=90% >

                    </div>

                </div>
            <div>
                <a href="{{ url('/users') }}" class="text-sm text-gray-700 underline">ユーザーリスト</a>
                <a href="{{ url('/concept') }}" class="text-sm text-gray-700 underline">技術概要</a>

                <span>   </span>
                    @auth (session('status'))
                    @endif
            </div>


            </div>
        </div>


    </div>
</div>
@endsection
