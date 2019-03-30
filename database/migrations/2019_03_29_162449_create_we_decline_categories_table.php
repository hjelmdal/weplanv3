<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeDeclineCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('we_decline_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->index('id');
            $table->string('reason', 50);
            $table->integer('active')->default(1);
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
        Schema::dropIfExists('we_decline_categories');
    }
}
