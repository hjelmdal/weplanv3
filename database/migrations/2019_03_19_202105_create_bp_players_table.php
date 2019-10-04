<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBpPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('shared')->create('bp_players', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('dbf_id');
            $table->integer('bp_id')->nullable();
            $table->integer('club_id')->nullable();
            $table->string('name')->nullable();
            $table->string('gender',1)->nullable();
            $table->date('birthday')->nullable();
            $table->string('age_group')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('bp_players');
    }
}
