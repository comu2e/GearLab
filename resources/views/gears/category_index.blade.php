@extends('layouts.app')

@section('content')
    {{'カテゴライズ'}}
    @foreach($gear_categorized->image_url as $gear)
        {{$gear}}
    @endforeach
@endsection
