@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center">

    <div>
        <ul>
            <li class="d-flex justify-content-center">
                {{{$user -> name}}}
            </li>
            <li class="d-flex justify-content-center">
                    @foreach($categories as $category)
                    <div>
                        <div> {{"image"}}</div>
                       <div> {{$category}}</div>
                       </div>
                    @endforeach
            </li>
        </ul>
    </div>
</div>

@endsection
