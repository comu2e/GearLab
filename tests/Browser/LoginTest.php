<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/login')
                ->type('user_id', 'admin')
                ->type('password', 'admin')
                ->press('ログイン')
            ->assertSee('管理側TOP');
            $browser->disableFitOnFailure();
            $browser->screenshot('admin/loginのテスト');
        });


    }
}
