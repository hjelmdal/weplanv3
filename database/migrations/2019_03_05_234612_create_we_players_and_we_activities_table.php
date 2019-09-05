<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWePlayersAndWeActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('we_players', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->index('id');
            $table->text('name');
            $table->tinyInteger('team_id')->nullable();
            $table->text('gender');
            $table->date("birthday")->nullable();
            $table->integer('user_id')->nullable();
            $table->unsignedTinyInteger('inactive')->nullable()->default(0);
            $table->string('dbf_id', 10)->nullable();
            $table->integer('badmintonpeople_id')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->timestamp('confirmed_at')->nullable();

        });

        Schema::create('we_activities', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->index('id');
            $table->integer('responsible_user')->unsigned();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->timeTz('start');
            $table->timeTz('end');
            $table->uuid('recurring_id')->nullable();
            $table->integer('type_id');
            $table->string('title', 255)->nullable();
            $table->text('info')->nullable();
            $table->text('address')->nullable();
            $table->timeTz('response_time');
            $table->date('response_date')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();
        });

        Schema::create('we_player_activities', function (Blueprint $table) {
            $table->integer('player_id')->unsigned();
            $table->integer('activity_id')->unsigned();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('declined_at')->nullable();
            $table->timestamp('signed_up_at')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->primary(['activity_id', 'player_id']);
            $table->index('player_id');
            $table->index('activity_id');

            $table->foreign('activity_id')->references('id')
                ->on('we_activities')->onUpdate('cascade');

            $table->foreign('player_id')->references('id')
                ->on('we_players')->onUpdate('cascade');





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
        Schema::dropIfExists('we_activities');
        Schema::dropIfExists('we_player_activities');

    }
}
