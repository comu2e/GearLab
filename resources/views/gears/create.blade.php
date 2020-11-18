@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">

        <form method="POST" action="/gears" enctype="multipart/form-data">

            @csrf
            <div class="form-group">

                <label>カテゴリ</label>

                {{Form::select('gear_category',$categories,null,['class' => 'form-hoge',  'placeholder' => '選択してください']),}}

            </div>

            <div class="form-group">
                <label>ギアの名前</label>
                <input name="gear_name" type="text">
                <div class="text-danger">
                    @error('gear_name')
                    {{$message}}
                    @enderror
                </div>

            </div>
            <div class="form-group">

                <div class="form-group">ギアのメーカー名 <input name="maker_name" type="text">
                </div>
            </div>
            <div class="text-danger">
                @error('maker_name')
                {{$message}}
                @enderror
            </div>
            <div class="form-group">ギアの使用場面
                <input name="situation" type="text">
            </div>

            <div class="form-group">お気に入りポイント<input name="content" type="text"></div>
            {{--        入力値をデータベースにまだ渡しない--}}
            <div class="text-danger">
                @error('content')
                {{$message}}
                @enderror
            </div>
            ギアの写真

            <input name="image_url" type="file">
            <div class="text-danger">
                @error('image_url')
                {{$message}}
                @enderror
            </div>

            <input type="submit" class="btn btn-primary" value="投稿"/>

        </form>

    </div>
@endsection

