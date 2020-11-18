<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateLikeTable extends Migration
{
    /**
     :* Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('gear_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
//           https://qiita.com/dai_designing/items/67a48e31d50899c6543f
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); // userが削除されたとき、それに関連するlikeも一気に削除される

            $table->foreign('gear_id')
                ->references('id')
                ->on('gears')
                ->onDelete('cascade'); // gearが削除されたとき、それに関連するlikeも一気に削除される
        });
    }
}
