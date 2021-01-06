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
    use RefreshDatabase;

    public function testIsLikedByNull()
    {
        $gear = Gear::factory()->create();
        $user= User::factory()->create();
        $gear->like_ing()->attach($user);

        $result = $gear->isLiked(null);

        $this->assertFalse($result);
    }
    public function testIsLikedByAnother()
    {
        $gear = Gear::factory()->create();
        $user= User::factory()->create();
        $another= User::factory()->create();
        $gear->like_ing()->attach($another);

        $result = $gear->isLiked($user);

        $this->assertFalse($result);
    }
}
