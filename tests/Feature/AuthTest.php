<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @test auth
     */
    use RefreshDatabase;

    public function gearにアクセスする()
    {

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/gears');

        $response->assertStatus(200);
    }
}
