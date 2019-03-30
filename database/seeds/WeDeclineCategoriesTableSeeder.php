<?php

use Illuminate\Database\Seeder;
use App\Models\WePlan\WeDeclineCategory;
use Illuminate\Support\Carbon;

class WeDeclineCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = ["Sygdom","Arbejde","Familie", "Andet"];

        foreach ($array as $c) {
            $cat = WeDeclineCategory::firstOrNew(["reason" => $c]);
            if(!$cat->exists) {
                $cat->created_at = Carbon::now();
            } else {
                $cat->updated_at = Carbon::now();
            }
            $cat->reason = $c;
            $cat->active = 1;
            $cat->save();
        }
    }
}
