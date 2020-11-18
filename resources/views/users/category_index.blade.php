@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">
        <img src={{asset('/img/'.$gear_category.'.svg')  }} width=15% >

    </div>
    @foreach($gear_categorized as $gear)
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
        <form action="{{route('gears.destroy',$gear->gear_id) }}" method="POST">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger">
                Delete
            </button>
        </form>
    </div>
</div>

    @endforeach

@endsection
