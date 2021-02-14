<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @test guestLogin
     */
    public function ゲストログインを試す()
    {
        #/guestにアクセスしたときはguestLoginが呼び出されて/gearsにリダイレクトする。
        $response = $this->get('guest');
        $response->assertStatus(302);

    }
}
