<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer("user_id")->unsigned()->nullable();
            $table->string("tel_country")->nullable();
            $table->string("tel_iso")->nullable();
            $table->integer("tel_dialcode")->nullable();
            $table->integer("tel_number")->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->foreign("user_id")->references("id")->on("users")->onUpdate("cascade")->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_infos');
    }
}
