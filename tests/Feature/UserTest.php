<?php

namespace Tests\Feature;

use App\Models\Gear;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIsFollowedByAnother()
    {
        // フォローするユーザーの作成

        $user= User::factory()->create();
        //フォローされるユーザーの作成

        $another= User::factory()->create();
//      フォローする
        $user -> follow($another->id);
//        userがanotherをフォローしているか
        $result = $user->is_following($another->id);

        $this->assertTrue($result);
    }
}
