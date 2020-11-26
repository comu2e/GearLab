<?php

namespace Tests\Feature;
use Illuminate\Support\Facades\DB;

use App\Models\Gear;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GearTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {

        $response = $this->get('/');

        $response->assertStatus(200);
    }

//    public function testEdit_gear(){
//
//        for ($i=1;$i<4;$i++){
//            $gear = Gear::find($i);
//
//            $response = $this->get('/');
//
//            $response->assertStatus(200)
//                ->assertViewIs('layouts.landing', compact('gear')); // 追加
//        }
//

//        $response = $this->get('/edit/'.$id);
//
//        $response->assertStatus(302)
//            ->assertViewIs('users.index', compact('gear')); // 追加
//    }
//    public function testDestroy(){
////        $ids = DB::table('gears')->pluck('id');
////        echo $ids;
////        foreach ($ids as $id ){
////            $gears = Gear::find($id);
////            $this->assertSoftDeleted('gears',$gears);
////        }
//        $user = factory(User::class)->create();
//
//    }
}
