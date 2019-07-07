<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeAbsensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('we_absenses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("player_id")->unsigned();
            $table->date("start_date");
            $table->date("end_date");
            $table->integer("absense_type");
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->foreign('player_id')->references('id')->on('we_players')->onUpdate("cascade");
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('we_absenses');
    }
}
