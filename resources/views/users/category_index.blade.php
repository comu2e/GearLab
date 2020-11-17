@extends('layouts.app')

@section('content')
    {{$gear_category}}
    @foreach($gear_categorized as $gear)

      <div class="d-flex justify-content-center">  {{($gear->gear_category)}}</div>
      <img src={{$gear->image_url}} width="500" height="500">
      <div>
          <a href="{{ route('gear_edit')}}?id={{ $gear->gear_id }}" class="btn btn-primary">
              {{ __('Edit') }}
          </a>
          {{-- 削除ボタンは後で正式なものに置き換えます --}}
          <a href="{{ url('gears/{gear}') }}" class="btn btn-danger">
              {{ __('Delete') }}
          </a>
      </div>
    @endforeach

@endsection
