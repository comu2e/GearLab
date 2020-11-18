@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="d-flex justify-content-center">
            <img src={{$gear->image_url}} width="500" height="500">
        </div>
        <div class="d-flex justify-content-center">
            {{--        <a href="{{ route('gear_edit') }}">--}}

            <a href="{{ url("edit/$gear->gear_id") }}" class="btn btn-primary">
                {{ __('Edit') }}
            </a>
            {{-- 削除ボタンは後で正式なものに置き換えます --}}
            <a href="{{ url('gears/{gear}') }}" class="btn btn-danger">
                {{ __('Delete') }}
            </a>
        </div>

    </div>

@endsection
