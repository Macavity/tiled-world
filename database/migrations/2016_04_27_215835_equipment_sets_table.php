<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EquipmentSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_sets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('character_id');

            $table->string('name');
            $table->tinyInteger('face1');
            $table->tinyInteger('face2');
            $table->tinyInteger('face3');
            $table->tinyInteger('garment');
            $table->tinyInteger('armour');
            $table->tinyInteger('shoes');
            $table->tinyInteger('right_hand');
            $table->tinyInteger('left_hand');
            $table->tinyInteger('acc1');
            $table->tinyInteger('acc2');

            $table->rememberToken();
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
        Schema::drop('equipment_sets');
    }
}
