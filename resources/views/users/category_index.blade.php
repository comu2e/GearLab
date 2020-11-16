@extends('layouts.app')

@section('content')
    {{$gear_category}}
    @foreach($gear_categorized as $gear)

      <div class="d-flex justify-content-center">  {{($gear->gear_category)}}</div>
      <img src={{$gear->image_url}} width="500" height="500">

    @endforeach

@endsection
