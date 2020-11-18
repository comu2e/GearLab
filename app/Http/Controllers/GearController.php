<?php

namespace App\Http\Controllers;

use http\Env\Request;
use Illuminate\Support\Facades\App;
use Auth;
use App\Models\Gear;
use App\Models\User;
use Storage;
use App\Http\Requests\GearRequest;

class GearController extends Controller
{

    public function category_index($user_id,$gear_category)
    {
        $gears =Gear::all();
        $users =User::all();

        $gear_categorized = $gears->where('user_id',$user_id)->where('gear_category',$gear_category)->all();
        $user  = $users -> where('user_id',$user_id)->all();

        return view('users/category_index',compact('user','gear_categorized','gear_category'));
    }

    public function index()
    {
        $gears =Gear::all();
        return view('gear/index',compact('gears'));

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
        var_dump($request->all());
    $image = $request->file('image_url');

    // バケットの`myprefix`フォルダへアップロード
    $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
    // アップロードした画像のフルパスを取得
    $gear->image_url = Storage::disk('s3')->url($path);

    $gear -> gear_name= $request-> gear_name;
    $gear -> user_id = Auth::user()->id;;

    $gear -> gear_category = $request-> gear_category ;
    $gear -> maker_name= $request-> maker_name;
    $gear -> content = $request-> content;
    $gear -> updated_at = date('Y/m/d H:i:s');
    $gear -> edited_at = date('Y/m/d H:i:s');

    $gear->save();
    return redirect()->route('users.index');
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($gear_id)
    {
//        どこかに保存して
        $categories = array('Cut','Shelter','Fire','Container','Comfort');

        $gear = Gear::find($gear_id);
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
        $gear = Gear::where('gear_id',$id)->first();

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
        $gears = Gear::where('gear_id',$id)->first();
        $gears->content = $gears->content;
        $gears->save();
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
        //
    }

}
