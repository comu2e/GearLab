<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\User;
class ExampleTest extends TestCase
{
    /**
      @test
     */
    use RefreshDatabase;
    public function これはテストです()
    {
        $user =User::factory()->create();
        $this->assertTrue(true);
    }
    public function これはテストです2()
    {
        $user =User::factory()->create();
        $this->assertTrue(false);
    }
}
