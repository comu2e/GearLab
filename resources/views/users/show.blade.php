@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">
        {{$user->name ."'s Gears"}}
    </div>
    <div class="d-flex justify-content-center">

        <div>
            <ul>

                <li class="d-flex justify-content-center">

                    @foreach($categories as $category)
                        <div class="d-flex justify-content-center">
                            <div>
                                <img src={{asset('/img/GearLab/'.$category.'.jpg')  }} width=80%>

                                <div>
                                    <a href= {{url()->current().'/gear_category='.$category}}>
                                        {{$category}}
                                    </a>
                                </div>
                            </div>

                    @endforeach
                </li>
            </ul>
            {{--   認証されているときのみ投稿できるフォームを出す--}}


            @guest

            @else
                <div class="d-flex justify-content-center">

                    <a href={{ url('gears/create') }} class="btn btn-primary" >Register Gear</a>
                </div>@endguest

        </div>
    </div>

@endsection
