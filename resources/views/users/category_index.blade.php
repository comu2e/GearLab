@extends('layouts.app')

@section('content')
    {{$gear_category}}
    @foreach($gear_categorized as $gear)
      <div class="d-flex justify-content-center">  {{($gear->$gear_category)}}</div>
      <div class="d-flex justify-content-center">  {{($gear->$image_url)}}</div>
    @endforeach

@endsection
