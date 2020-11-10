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

            $table->bigIncrements('gear_id');
            $table->integer('user_id')->unsigned();

            $table->string('gear_name');
            $table->string('maker_name');
            $table->timestamp('updated_time_at')->nullable();
            $table->timestamp('edited_time_at')->nullable();
            $table->text('content');
            $table->string('image_url');
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
        //
    }

}
