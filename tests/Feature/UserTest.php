<?php

namespace Tests\Feature;

use App\Models\FollowUser;
use App\Models\Gear;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
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

        FollowUser::firstOrCreate([
            'user_id' => $user->id,
            'followed_user_id' => $another->id,
        ]);


//        userがanotherをフォローしているか
        $result = $user->isFollowedBy($another);

        $this->assertTrue($result);
    }


}
