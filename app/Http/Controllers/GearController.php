<?php

namespace App\Http\Controllers;

//use http\Env\Request;
use Illuminate\Http\Response;
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

    public function category_index($user_id, $gear_category)
    {

        $gears = Gear::all();
        $users = User::all();

        $gear_categorized = $gears->where('user_id', $user_id)->where('gear_category', $gear_category)->all();
        $user = $users->where('user_id', $user_id)->all();

        return view('users/category_index', compact('user', 'gear_categorized', 'gear_category'));
    }

    public function index(Request $request)
    {
        //RequestはFormrequest使ってはだめ
        $query = Gear::query();


        $search1 = $request->input('category');
        $search2 = $request->input('content');

        if ($request->has('category') && $search1 == ('All')) {
            $gears = DB::table('gears')->paginate(10);
        } else {
            $query->where('gear_category', $search2)->get();

        }


        $gears = $query->orderBy('updated_at', 'desc')->paginate(10);
        return view('gears/index', compact('gears'));

    }

    public function favorite_gear()
    {
//テーブルをlikesテーブルとgearsテーブルをLeft結合
        $gears = DB::table('gears')
            ->join('likes', 'likes.user_id', '=', 'gears.user_id')
            ->where('likes.user_id', '=', Auth::id())->get();
//        user_idカラムで認証しているユーザーIDのテーブルを取得

//        $gears=Gear::all();
        return view('gears/favorite', compact('gears'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('gears/create');

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image',
            'gear_name' => 'required',
            'gear_category' => 'required',
            'maker_name' => 'required',
            'content' => ['required','min:2'],

        ], [
            'file.required' => '画像が選択されていません',
            'file.image' => '画像ファイルではありません',
            'gear_category.required' => '登録するギアのカテゴリを選択してください',

            'gear_name.required' => '登録するギアの名前を入力してください',
            'maker_name.required' => '登録するギアのメーカ名を入力してください',
            'content.min' => 'ギアのお気に入りポイントを2文字以上入力してください',
            'content.required' => 'ギアのお気に入りポイントを入力してください',
        ]);

        if (request()->file) {
            $image = $request->file('file');
            $image_url = Storage::disk('s3')->put('/myprefix', $image, 'public');
            $gear = new Gear();
            $gear->image_url = Storage::disk('s3')->url($image_url);
            $gear->gear_name = $request->gear_name;
            $gear->maker_name = $request->maker_name;
            $gear->content = $request->content;
            $gear->gear_category = $request->gear_category;
            $gear->updated_at = date('Y/m/d H:i:s');
            $gear->gear_category = $request->gear_category;

            $gear->user_id = $request->user_id;
            $gear->save();

            return ['success' => '登録しました!'];
        }
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
//        どこかに保存して
        $categories = array('Cut', 'Shelter', 'Fire', 'Container', 'Comfort');

        $gear = Gear::find($id);
        return view('gears.show', compact('gear', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update_gear($id)
    {
        $gear = Gear::find($id)->first();
        $gear->content = $gear > content;
        $gear->save();
        return redirect('users.index');
    }

    public function edit(GearRequest $request)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, Gear $gear)
    {
//        $gear->update($request->all());
        $gear = $this -> Gear ->updateGear($request,$gear);

        return $gear;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
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
