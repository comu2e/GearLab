<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGearTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gears', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('gear_category')->nullable();
            $table->string('gear_name')->nullable();
            $table->string('maker_name')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('edited_at')->nullable();
            $table->text('content')->nullable();
            $table->string('image_url')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public
    function down()
    {
//        Schema::dropIfExists('gears');
//        Schema::dropIfExists('users');
    }

}
