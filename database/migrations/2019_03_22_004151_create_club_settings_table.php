<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\ClubSettings;


class CreateClubSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('club_settings', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer('club_id')->nullable();
            $table->string('name')->nullable();
            $table->integer('season_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Ensure to put up the settings record
        ClubSettings::firstOrCreate(["id" => 1]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('club_settings');
    }
}
