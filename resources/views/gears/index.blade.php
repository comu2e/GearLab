@extends('layouts.app')

@section('nav')
    <app :user_id={{Auth::id()}}></app>
@endsection
