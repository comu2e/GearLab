@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-center">

        <div>
            <ul>
                <li class="d-flex justify-content-center">
                    {{$user->name}}
                </li>
                <li class="d-flex justify-content-center">
                    @foreach($categories as $category)
                        <div>
                            <div> {{"image"}}</div>
                            <div class="d-flex justify-content-center" ></div>
                            <a href = {{url()->current().'/gear_category='.$category}}>
                            {{$category}}
                            </a>

                        </div>

                    @endforeach
                </li>
            </ul>
            {{--   認証されているときのみ投稿できるフォームを出す--}}


                    <a  class="d-flex justify-content-center"  href = {{ url('gears/create') }}> + </a>

        </div>
    </div>

@endsection
