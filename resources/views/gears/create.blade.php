@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center">
    <form method="POST" action="/gears">
        @csrf
    <ul>

        <li>ギアの写真
            <input name="image_url" type="text">

        </li>

        <li>カテゴリ
            {{Form::select('gear_category', ['Cut Gear'=> 'Cut Gear', 'Cut'=> 'Cut', 'Fire'=> 'Fire','Container'=> 'Container','Comfort'=>'Comfort'])}}


        </li>
        <li>ギアの名前<input name="gear_name" type="text"> </li>
        <li>ギアのメーカー名 <input name="gear_maker" type="text"></li>
        <li>ギアの使用場面 <input name="situation"type="text"></li>
        <li>お気に入りポイント<input  name="content"type="text"> </li>
        <li>購入場所<input name="place"type="text"></li>
    </ul>

        <input type="submit" class="btn btn-primary" value="投稿"/>

    </form>
    <script src="{{ mix('js/app.js') }}"></script>

</div>
@endsection

