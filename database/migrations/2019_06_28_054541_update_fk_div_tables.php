<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFkDivTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('we_declines', function (Blueprint $table) {
            $table->integer("player_id")->unsigned()->change();
            $table->bigInteger("type_id")->unsigned()->nullable()->change();
            $table->bigInteger("category_id")->nullable()->unsigned()->change();

            $table->foreign('player_id')->references('id')->on('we_players');
            $table->foreign('category_id')->references('id')->on('we_decline_categories');
            $table->foreign('type_id')->references('id')->on('we_activity_types');
            

        });

        Schema::table('we_players', function (Blueprint $table) {            
            $table->integer("team_id")->unsigned()->change();
            $table->integer("user_id")->unsigned()->change();

            $table->foreign('team_id')->references('id')->on('we_teams');
            $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('dbf_id')->references('dbf_id')->on('bp_players');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('we_declines', function (Blueprint $table) {
            //
        });
    }
}
