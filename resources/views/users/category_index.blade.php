@extends('layouts.app')

@section('content')

    {{$user}}
    {{$gear_category}}
    @foreach($gear_categorized as $gear)
      <div class="d-flex justify-content-center">  {{($gear->maker_name)}}</div>
    @endforeach
@endsection
