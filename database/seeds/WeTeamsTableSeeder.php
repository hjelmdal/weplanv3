<?php

use Illuminate\Database\Seeder;
use App\Models\WePlan\WeTeam;
use Illuminate\Support\Carbon;

class WeTeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = ["1. Trup","Buffertrup 1.-2. Trup","2. trup", "Buffertrup 2.-3. trup", "3. Trup", "Buffertrup 3.-4. Trup", "4. Trup"];

        foreach ($array as $c) {
            $cat = WeTeam::firstOrNew(["name" => $c]);
            if(!$cat->exists) {
                $cat->created_at = Carbon::now();
            } else {
                $cat->updated_at = Carbon::now();
            }
            $cat->active = 1;
            $cat->save();
        }
    }
}
