<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('we_seasons', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_active')->nullable();
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
        Schema::dropIfExists('we_seasons');
    }
}
