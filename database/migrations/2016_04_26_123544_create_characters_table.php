<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration
{
    var $hp;
    var $sp;
    var $add_hp;
    var $add_sp;
    var $max_hp;
    var $max_sp;

    var $str;
    var $con;
    var $int;
    var $agi;
    var $dex;
    var $luk;
    var $sta_mod = array();

    var $st_points,$sk_points;
    var $add_stp,$add_skp;

    var $item = array();
    var $skill = array();

    var $quick_slot = array();
    var $equipment = array();

    var $save;
    var $location;
    var $map_state;
    var $battle_temp;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('equipment_set_id');

            $table->string('name');
            $table->tinyInteger('gender');
            $table->text('bio');

            $table->tinyInteger('job');

            $table->tinyInteger('base_level')->default(1);
            $table->tinyInteger('job_level')->default(1);

            $table->bigInteger('base_exp')->default(0);
            $table->bigInteger('job_exp')->default(0);

            $table->tinyInteger('hair_style');
            $table->string('hair_color', 6);

            $table->integer('health_points');
            $table->integer('special_points');

            $table->smallInteger('str')->default(1);
            $table->smallInteger('con')->default(1);
            $table->smallInteger('agi')->default(1);
            $table->smallInteger('dex')->default(1);
            $table->smallInteger('int')->default(1);
            $table->smallInteger('luk')->default(1);

            $table->integer('bonusAgi')->default(0);
            $table->integer('bonusDex')->default(0);
            $table->integer('bonusInt')->default(0);
            $table->integer('bonusCon')->default(0);
            $table->integer('bonusLuk')->default(0);

            $table->integer('rank_points');

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
        Schema::drop('characters');
    }
}
