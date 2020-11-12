@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    画像配置

                </div>
            <div>
                <a href="{{ url('/users') }}" class="text-sm text-gray-700 underline">ユーザーリスト</a>

            </div>

                <div>
                    {{--        ログイン前に表示--}}
                    @auth (session('status'))
                        <a href="{{ url('/concept') }}" class="text-sm text-gray-700 underline">技術概要</a>
                    @endif
                </div>
            </div>
        </div>


    </div>
</div>
@endsection
