@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <a href="{{ url('admin/user_list') }}">ユーザー一覧</a> &gt; ユーザー詳細
            </div>
            <div class="card-body">

                <ul class="list-group">
                    <li class="list-group-item">名前: {{ $user->name }}</li>
                    <li class="list-group-item">メール: {{ $user->email }}</li>
                    <li class="list-group-item">作成日: {{ $user->created_at->format('Y/m/d H:i:s') }}</li>
                    <li class="list-group-item">更新日: {{ $user->updated_at->format('Y/m/d H:i:s') }}</li>


                </ul>
            </div>

        </div>
        <form method="post" action="/admin/user/{{$user->id}}">
            {{ csrf_field() }}
            <input type="submit" value="削除" class="btn btn-danger btn-sm" onclick='return confirm("本当にユーザーを削除しますか？");'>
        </form>

    </div>
@endsection
