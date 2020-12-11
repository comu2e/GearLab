@extends('layouts.app')

@section('nav')
    <app :user={{Auth::user()}}></app>
@endsection
