@extends('layouts.app')

@section('content')
    {{$user}}
    {{$gear_category}}
    {{$gear_categorized}}
    @foreach($gear_categorized as $gear)
      <div class="d-flex justify-content-center">  {{($gear->$gear_category)}}</div>
    @endforeach

@endsection
