@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">


        <ul>
            @foreach($users as $user)
                <li>
                    <a href={{route('users.show',$user->id)}}>
                        {{$user->name}}
                    </a>
                </li>

            @endforeach

        </ul>

    </div>

@endsection

@section('footer')
    <div class="d-flex justify-content-center">
        {{$users->links('pagination::bootstrap-4') }}

    </div>

@endsection
