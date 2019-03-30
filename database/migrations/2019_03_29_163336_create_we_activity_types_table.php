<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeActivityTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('we_activity_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->index('id');
            $table->string('name', 99);
            $table->boolean('signup')->nullable();
            $table->boolean('decline')->nullable();
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
        Schema::dropIfExists('we_activity_types');
    }
}
