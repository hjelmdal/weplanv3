<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_statuses', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer("user_id")->unsigned();
            $table->timestamp("password_at")->nullable();
            $table->timestamp("consent_at")->nullable();
            $table->timestamp("avatar_at")->nullable();
            $table->timestamp("avatar_approved_at")->nullable();
            $table->timestamp("player_at")->nullable();
            $table->timestamp("player_approved_at")->nullable();
            $table->timestamp("completed_at")->nullable();
            $table->timestamp("approved_at")->nullable();
            $table->timestamp("rejected_at")->nullable();
            $table->nullableTimestamps();
            $table->foreign("user_id")->references("id")->on("users")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_statuses');
    }
}
