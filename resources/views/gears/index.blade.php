@extends('layouts.app')

@section('nav')
    <div>{{gettype(Auth::user())}}</div>
    <div>{{Auth::user()}}</div>
    <app :user="{{Auth::user()}}"></app>

@endsection
