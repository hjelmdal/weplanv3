<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_jobs', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->uuid('job_id')->nullable();
            $table->string('status')->nullable();
            $table->string('command')->nullable();
            $table->string('arguments')->nullable();
            $table->integer('updated_count')->nullable();
            $table->integer('created_count')->nullable();
            $table->integer('errors_count')->nullable();
            $table->decimal('runtime',10,2)->nullable();
            $table->integer('data_checksum')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('system_jobs');
    }
}
