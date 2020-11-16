@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center">

    <form method="POST" action="/gears"enctype="multipart/form-data">
        @csrf
        <ul>
            <li>カテゴリ
                {{Form::select('gear_category',$categories)}}

            </li>


            <li>ギアの名前<input name="gear_name" type="text"> </li>
                <div class="text-danger">
                @error('gear_name')
                {{$message}}
                @enderror
                </div>

            <li>ギアのメーカー名 <input name="maker_name" type="text"></li>
        {{--        入力値をデータベースにまだ渡しない--}}
            <div class="text-danger">
                @error('maker_name')
                {{$message}}
                @enderror
            </div>
        <li>ギアの使用場面 <input name="situation"type="text"></li>

        <li>お気に入りポイント<input  name="content"type="text"> </li>
{{--        入力値をデータベースにまだ渡しない--}}
            <div class="text-danger">
                @error('content')
                {{$message}}
                @enderror
            </div>
        <li>購入場所<input name="place"type="text"></li>
        <li>ギアの写真
            <input name="image_url"type="file" >
            <div class="text-danger">
                @error('image_url')
                {{$message}}
                @enderror
            </div>
        </li>
    </ul>

        <input type="submit" class="btn btn-primary" value="投稿"/>

    </form>

</div>
@endsection

