<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Auth;
use App\Models\Gear;

class GearController extends Controller
{

    public function category_index($user,$gear_category)
    {
        $gears =Gear::all();

        $gear_categorized =$gears->where('user_id',$user)->where('gear_category',$gear_category)->all();

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

    public function store(Request $request)
{
    $gear = new Gear;
    $gear -> gear_name= $request-> gear_name;
    $gear -> user_id = $request -> id;

    $gear -> gear_category = $request-> gear_category ;
    $gear -> maker_name= $request-> gear_maker;
    $gear -> content = $request-> content;
    $gear -> image_url = 'イメージurl';
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

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
