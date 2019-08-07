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
            $table->bigIncrements('id')->unsigned();
            $table->integer("player_id");//->unsigned();
            $table->integer("training_id")->nullable();
            $table->date("start_date");
            $table->date("end_date")->nullable();
            $table->string("description")->nullable();
            $table->integer("type_id")->unsigned()->nullable();
            $table->integer("category_id")->nullable()->unsigned();
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
