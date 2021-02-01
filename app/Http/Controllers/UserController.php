<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

use App\Models\User;
use App\Models\Gear;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->only(['like', 'unlike']);
        $this->middleware('auth');
    }

    public function index()
    {
//        $users =User::all();
        $users = User::paginate(10);

        return view('users/index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = array('Cutting Gear', 'Shelter', 'Fire gear', 'Container', 'Comfort Gear ');

        $user = User::find($id);
        return view('users.show', compact('user', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
