<?php

namespace App\Http\Controllers;

//use http\Env\Request;
use Illuminate\Support\Facades\App;
use Auth;
use App\Models\Gear;
use App\Models\User;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Storage;
use App\Http\Requests\GearRequest;


class GearController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->only(['like', 'unlike']);
        $this->middleware('auth');
    }
    public function category_index($user_id,$gear_category)
    {

        $gears =Gear::all();
       $users =User::all();

        $gear_categorized = $gears->where('user_id',$user_id)->where('gear_category',$gear_category)->all();
        $user  = $users -> where('user_id',$user_id)->all();

        return view('users/category_index',compact('user','gear_categorized','gear_category'));
    }

    public function index(Request $request)
    {
        //RequestはFormrequest使ってはだめ
        $query = Gear::query();


        $search1 = $request->input('category');
        $search2 = $request->input('content');

        if ($request -> has('category') && $search1 ==('All')){
            $gears = DB::table('gears')->paginate(10);
        }
        else{
            $query -> where('gear_category',$search2)->get();

        }


            $gears = $query->orderBy('updated_at', 'desc')->paginate(10);
        return view('gears/index',compact('gears'));

    }
    public function favorite_gear()
    {
//テーブルをlikesテーブルとgearsテーブルをLeft結合
        $gears = DB::table('gears')
            ->join('likes', 'likes.user_id', '=', 'gears.user_id')
            ->where('likes.user_id','=',Auth::id())->get();
//        user_idカラムで認証しているユーザーIDのテーブルを取得

//        $gears=Gear::all();
        return view('gears/favorite',compact('gears'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('gears/create');

    }

    public function store(GearRequest $request)
{
    $gear = new Gear;
//    $form = $request -> all();
//    dd($form);
//    dd($request);
    //s3アップロード開始
    $image = $request->file('image_url');

    // バケットの`myprefix`フォルダへアップロード
    $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
    // アップロードした画像のフルパスを取得
    $gear->image_url = Storage::disk('s3')->url($path);

    $gear -> gear_name= $request-> gear_name;
    $gear -> user_id = Auth::id();

    $gear -> gear_category = $request-> gear_category ;
    $gear -> maker_name= $request-> maker_name;
    $gear -> content = $request-> content;
    $gear -> updated_at = date('Y/m/d H:i:s');
    $gear -> edited_at = date('Y/m/d H:i:s');

    $gear->save();
    return redirect()->route('gears.index');
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        どこかに保存して
        $categories = array('Cut','Shelter','Fire','Container','Comfort');

        $gear = Gear::find($id);
        return view('gears.show', compact('gear','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_gear($id)
    {
        $gear = Gear::find($id);

        return view('gears.edit', compact('gear'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_gear($id)
    {
        $gear = Gear::find($id)->first();
        $gear->content = $gear>content;
        $gear ->save();
        return redirect('users.index');
    }
    public function edit(GearRequest $request)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GearRequest $request)
    {

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gears = Gear::find($id);
        // 削除
        $gears->delete();
        // 一覧にリダイレクト
        return redirect('/');
    }
    public function like($id)
    {

        Like::create([
            'gear_id' => $id,
            'user_id' => Auth::user()->id,
        ]);

        session()->flash('success', 'You Liked the Post.');

        return redirect()->back();
    }
    public function unlike($id)
    {
        $like = Like::where('gear_id', $id)->where('user_id', Auth::id())->first();
        $like->delete();

        session()->flash('success', 'You Unliked the Reply.');

        return redirect()->back();
}

}
