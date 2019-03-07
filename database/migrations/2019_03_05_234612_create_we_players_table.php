<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('we_players', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->text('name');
            $table->tinyInteger('team_id')->nullable();
            $table->tinyInteger('gender');
            $table->integer('user_id')->nullable();
            $table->unsignedTinyInteger('inactive')->nullable()->default(0);
            $table->string('dbf_id', 10)->nullable();
            $table->integer('badmintonpeople_id')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->timestamp('confirmed_at')->nullable();

        });

        Schema::create('we_trainings', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->time('start');
            $table->time('end');
            $table->binary('recurringid')->nullable();
            $table->integer('type_id');
            $table->string('title', 255)->nullable();
            $table->text('info')->nullable();
            $table->time('response_time');
            $table->date('response_date')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();




        });

        Schema::create('we_player_trainings', function (Blueprint $table) {
            $table->integer('player_id')->unsigned();
            $table->integer('training_id')->unsigned();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('declined_at')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->primary(['training_id', 'player_id']);
            $table->index('player_id');
            $table->index('training_id');

            $table->foreign('player_id')->references('id')
                ->on('we_players')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('training_id')->references('id')
                ->on('we_trainings')->onDelete('cascade')->onUpdate('cascade');




        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('we_players');
        Schema::dropIfExists('we_trainings');
        Schema::dropIfExists('we_player_trainings');

    }
}
