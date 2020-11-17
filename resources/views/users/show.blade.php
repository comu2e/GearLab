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
                        <div class="d-flex justify-content-center" >
                        <div>
                           <img src={{asset('/img/GearLab/'.$category.'.jpg')  }} width=80% >

                            <div>
                               <a href = {{url()->current().'/gear_category='.$category}}>
                                    {{$category}}
                                </a>
                            </div>
                        </div>

                    @endforeach
                </li>
            </ul>
            {{--   認証されているときのみ投稿できるフォームを出す--}}

            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-primary rounded-circle p-0" style="width:5rem;height:5rem;color:white">
                    <a color=white href = {{ url('gears/create') }}>Add Gear</a>
                </button>
            </div>


        </div>
    </div>

@endsection
