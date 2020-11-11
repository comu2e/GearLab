<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

use App\Models\Gear;

class GearController extends Controller
{

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
    $gear -> maker_name= $request-> maker_name;

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
        $categories = array('カットギア','シェルターギア','','火熾しギア','コンテナギア','快適化ギア');

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
