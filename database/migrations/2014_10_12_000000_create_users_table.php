<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('player_id',10)->nullable();
            $table->rememberToken();
    
            $table->string('api_token',100)->nullable();
            $table->string('avatar')->nullable();
            $table->timestamps();
        });
    
        Schema::create('users_facebook', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('token');
            $table->string('refresh_token')->nullable();
            $table->integer('expires_in');
            $table->string('facebook_id');
            $table->string("facebook_handle")->nullable();
            $table->index('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    
        Schema::create('users_google', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('token');
            $table->string('refresh_token')->nullable();
            $table->integer('expires_in');
            $table->string('google_id');
            $table->string("google_handle")->nullable();
            $table->index('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('users_google');
        Schema::dropIfExists('users_facebook');
    }
}
