@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center">


    @foreach($users as $user)
        <a href={{route('users.show',$user->id)}}>
        {{$user->name}}
        </a>
    @endforeach

    {{$users->links()}}
</div>
@endsection
