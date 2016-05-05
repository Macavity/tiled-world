<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_positions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('type');
            $table->unsignedInteger('type_detail');

            $table->unsignedTinyInteger('gender');

            $table->smallInteger('top');
            $table->smallInteger('left');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('image_positions');
    }
}
