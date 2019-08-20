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
            $table->text("type");
            $table->json("content")->nullable();
            $table->timestamp("approved_at")->nullable();
            $table->timestamp("rejected_at")->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();
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
