<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test admin Login.
     *
     * @return void
     */
    public function testAdmin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/login')
                ->type('user_id', 'admin')
                ->type('password', 'admin')
                ->press('ログイン')
                ->disableFitOnFailure()
                ->screenshot('admin/loginのテスト')
                ->assertSee('管理側TOP')
                ->clickLink('ユーザー一覧')
                ->disableFitOnFailure()
                ->assertSee('ユーザー一覧')
                ->screenshot('ユーザーログインのテスト');
        });


    }
    /**
     * A Dusk test Login.
     *
     * @test login
     */
    public function GuestLoginのテスト()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->clickLink('Guest Login')
                ->disableFitOnFailure()
                ->assertSee('ギアタイムライン')
                ->screenshot('Gear　Home');
        });


    }
    /**
     * A Dusk test Create画面の遷移.
     *
     * @test create
     */
    public function Create画面の遷移()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->clickLink('Guest Login')
                ->disableFitOnFailure()
                ->assertSee('ギアタイムライン')
                ->clickLink('ギア登録画面へ')
                ->clickAndHold()
                ->pause(1000)
                ->releaseMouse()
                ->assertSee('ギアカテゴリ')
                ->assertSee('ギアメーカー')
                ->assertSee('ギア名')
                ->assertSee('お気に入りポイント')
                ->assertSee('参考にしたサイト')
                ->screenshot('Gear　Create');

        });


    }

}
