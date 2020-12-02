@extends('layouts.app')

@section('content')


    <div class="container">
        <div align="center">



            <form  class="form-inline my-2 my-lg-0 ml-2">
                <select class="form-control"name="category">
                    <option>All</option>

                    @foreach($categories as $category)

                        <option>{{$category}}</option>
                    @endforeach

                </select>
                <div class="form-group">
                    <input type="search" class="form-control mr-sm-2" name="content"  value="{{request('content')}}" placeholder="キーワードを入力" aria-label="検索...">
                </div>

                <input type="submit" value="検索" class="btn btn-primary">
            </form>
        </div>

        <div class="card">
            <div class="card-header">気になるギア一覧</div>
            <div class="card-body">

                <ul class="list-group">
                    @foreach ($gears as $gear)
                        <li class="list-group-item">
                            <a href="{{ url('gear/' . $gear->id) }}"></a>
                            <div align="center" >
                                <img src="{{ $gear->image_url }} "  width="30%" alt="">

                            </div>
                            <div align="right">

                                <div>
                                    {{ 'ギア名: '.$gear->gear_name }}
                                </div>
                                <div>
                                    {{ '投稿者のUserID: '.$gear->user_id }}
                                </div>

                                <div>
                                    {{ 'ギアカテゴリ: '.$gear->gear_category }}
                                </div>
                                <div>
                                    {{ '登録日: '.$gear->updated_at }}
                                </div>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>


@endsection


{{--@section('footer')--}}
{{--    <div class="d-flex justify-content-center">--}}
{{--        {{$gears->links('pagination::bootstrap-4') }}--}}
{{--    </div>--}}
{{--@endsection--}}
