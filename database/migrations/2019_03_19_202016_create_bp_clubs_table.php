<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBpClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bp_clubs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('club_id')->nullable();
            $table->string('name')->nullable();
            $table->string('team_name')->nullable();
            $table->text('address')->nullable();
            $table->integer('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('email')->nullable();
            $table->string('association')->nullable();
            $table->string('area')->nullable();
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
        Schema::dropIfExists('bp_clubs');
    }
}
