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

}
