<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeDeclinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('we_declines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("player_id")->unsigned();
            $table->integer("training_id")->nullable();
            $table->date("start_date");
            $table->date("end_date")->nullable();
            $table->string("description")->nullable();
            $table->bigInteger("type_id")->unsigned()->nullable();
            $table->bigInteger("category_id")->nullable()->unsigned();
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->foreign('player_id')->references('id')->on('we_players');
            $table->foreign('category_id')->references('id')->on('we_decline_categories');
            $table->foreign('type_id')->references('id')->on('we_activity_types');
        });

        // Schema::table('we_declines', function(Blueprint $table) {
        //     $table->foreign('player_id')
        //         ->references('id')
        //         ->on('we_players');
                
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('we_declines');
    }
}
