<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCalculatedStatsToCharacterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('characters', function($table){
            $table->integer('bonusStr')->default(0);
            $table->integer('bonusAgi')->default(0);
            $table->integer('bonusDex')->default(0);
            $table->integer('bonusInt')->default(0);
            $table->integer('bonusCon')->default(0);
            $table->integer('bonusLuk')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('characters', function($table){
            $table->dropColumn('bonusStr');
            $table->dropColumn('bonusAgi');
            $table->dropColumn('bonusDex');
            $table->dropColumn('bonusInt');
            $table->dropColumn('bonusCon');
            $table->dropColumn('bonusLuk');
        });
    }
}
