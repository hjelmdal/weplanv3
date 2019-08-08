<?php

use Illuminate\Database\Seeder;
use App\Models\WePlan\WeActivity;

class ActivityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activities = factory(WeActivity::class,5)->create();

    }
}
