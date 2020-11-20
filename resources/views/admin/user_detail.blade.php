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
                </ul>
            </div>
        </div>
    </div>
@endsection
