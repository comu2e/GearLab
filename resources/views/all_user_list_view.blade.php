@extends('layouts.app')

{{--ページネーション機能--}}
{{--foreachでuserを一覧表示--}}
{{--foreachでuserを一覧からユーザー画面に遷移--}}
@section('content')
{{--users情報を呼び出す--}}
{{$users = \App\Http\Controllers\UserController::index()}}


    @foreach($users as $user)
        <div >{{$user->name}}</div>
    @endforeach
@endsection
