<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GearControllerTest extends TestCase
{
    /**
     * @test index
     */
    public function アプリのindexを開く()
    {

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @test index
     */
    public function アプリのindexを開く()
    {

        $response = $this->get('/');

        $response->assertStatus(200);
    }

}
