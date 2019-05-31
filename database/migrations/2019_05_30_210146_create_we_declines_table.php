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
            $table->integer("player_id");
            $table->integer("training_id")->nullable();
            $table->date("start_date");
            $table->date("end_date")->nullable();
            $table->string("description")->nullable();
            $table->integer("type_id")->nullable();
            $table->integer("category_id")->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();
        });
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
