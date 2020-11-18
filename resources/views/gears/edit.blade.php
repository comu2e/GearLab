@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">

        <form method="POST" action="/gears" enctype="multipart/form-data">

            @csrf
            <div class="form-group">

                <label>カテゴリ</label>

                {{Form::select('gear_category',
$categories,null,[ 'value' => $gear->gear_category]) }}
                @error('gear_category')
                {{$message}}
                @enderror
            </div>

            <div class="form-group">
                <label>ギアの名前</label>
                <input name="gear_name" type="text" value="{{$gear->gear_name}}">
                <div class="text-danger">
                    @error('gear_name')
                    {{$message}}
                    @enderror
                </div>

            </div>
            <div class="form-group">

                <div class="form-group">
                    <label>ギアのメーカー名</label>
                    <input name="maker_name" type="text" value="{{$gear->maker_name}}">
                </div>
            </div>
            <div class="text-danger">
                @error('maker_name')
                {{$message}}
                @enderror
            </div>

            <div class="form-group">
                お気に入りポイント<input name="content" type="text"  value="{{$gear->content}}"></div>
            {{--        入力値をデータベースにまだ渡しない--}}
            <div class="text-danger">
                @error('content')
                {{$message}}
                @enderror
            </div>

            <div class="form-group">

            <label for="">
                ギアの写真
            </label>
            <img src="{{$gear->image_url}}" width=40%>
                <div class="form-group">

            <input name="image_url" type="file">
                </div>
            <div class="text-danger">
                @error('image_url')
                {{$message}}
                @enderror
            </div>
            </div>

            <input type="submit" class="btn btn-primary" value="編集登録"/>
        </form>

    </div>

@endsection
