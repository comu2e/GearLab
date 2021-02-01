@extends('layouts.app')

@section('content')
    <div id="app">
        <gear-list-component></gear-list-component>

    </div>
    <div class="d-flex justify-content-center" id="app">
        <img src={{asset('/img/'.$gear_category.'.svg')  }} width=15%>


        @foreach($gear_categorized as $gear)
            <div class="container">
                <div class="d-flex justify-content-center">
                    <img src={{$gear->image_url}} width="500" height="500">
                </div>
                <div>
                    @if($gear->is_liked_by_auth_user())
                        <a href="{{ route('gear.unlike', ['id' => $gear->id]) }}"
                           class="btn btn-success btn-sm">いいね<span
                                class="badge">{{$gear->likes->count() }}</span></a>
                    @else
                        <a href="{{ route('gear.like', ['id' => $gear->id]) }}"
                           class="btn btn-secondary btn-sm">いいね<span
                                class="badge">{{ $gear->likes->count()}}</span></a>
                    @endif
                </div>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('gear_edit') }}">

                        <a href="{{ url("edit/$gear->id") }}" class="btn btn-primary">
                            {{ __('Edit') }}
                        </a>
                        <form action="{{route('gears.destroy',$gear->id) }}" method="POST">
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
