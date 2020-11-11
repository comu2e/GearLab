@extends('layouts.app')
//
// {{--ページネーション機能--}}
// {{--foreachでuserを一覧表示--}}
// {{--foreachでuserを一覧からユーザー画面に遷移--}}
@section('content')

    @foreach($users as $user)
        <div >{{$user->name}}</div>
    @endforeach
@endsection
