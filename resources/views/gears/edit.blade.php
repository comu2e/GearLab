@extends('...layouts.layout')

@section('gear_edit')
    投稿編集<br>

    <form action='{{ route('gear_update') }}' method='post'>
        {{ csrf_field() }}
        <input type='hidden' name='id' value='{{ $gear->gear_id }}'><br>
        ユーザーID：{{ $gear->gear_id }}<br>
        タイトル：<input type='text' name='title' value='{{ $gear->title }}'><br>
        内容：<input type='text' name='content' value='{{ $gear->content }}'><br>
        <input type='submit' value='投稿'>
    </form>
@endsection
