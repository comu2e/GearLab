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
            $table->bigIncrements('id')->unsigned();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('gear_id')->constrained('gears')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down()
    {
//        Schema::dropIfExists('users');
//        Schema::dropIfExists('gears');
    }
}
