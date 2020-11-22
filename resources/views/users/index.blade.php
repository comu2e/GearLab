@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">


        <ul>
            @foreach($users as $user)
                    <a href={{route('users.show',$user->id)}}>

                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <svg class="bd-placeholder-img" width="100%" height="200" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image"><title>Placeholder</title><rect fill="#868e96" width="70%" height="70%"/><text fill="#dee2e6" dy=".3em" x="50%" y="50%"> </text></svg>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$user->name}}</h5>
                                <p class="card-text"></p>
                                <p class="card-text"><small class="text-muted">登録日:{{$user->created_at}}</small></p>
                            </div>
                        </div>
                    </div>
                    </a>

            @endforeach

        </ul>

    </div>

@endsection

@section('footer')
    <div class="d-flex justify-content-center">
        {{$users->links('pagination::bootstrap-4') }}

    </div>

@endsection
