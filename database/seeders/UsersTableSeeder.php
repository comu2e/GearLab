<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * データベース初期値設定の実行
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'UserName',
            'email' => 'User@mailaddress.com',
            'password' => bcrypt('password'),
        ]);
        $users = factory(App\Models\User::class, 100)->create();
    }
}
