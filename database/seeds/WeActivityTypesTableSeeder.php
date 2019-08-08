<?php

use Illuminate\Database\Seeder;
use App\Models\WePlan\WeActivityType;
use Illuminate\Support\Carbon;

class WeActivityTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = array(
            array("name" => "Alm. træning", "signup" => null, "decline" => 1),
            array("name" => "Ekstra træning", "signup" => 1, "decline" => null),
            array("name" => "Holdkamp", "signup" => null, "decline" => 1),
            array("name" => "Event", "signup" => 1, "decline" => null)
        );

        foreach ($array as $item) {
            $type = WeActivityType::firstOrNew(["name" => $item["name"]]);
            if(!$type->exists) {
                $type->created_at = Carbon::now();
            } else {
                $type->updated_at = Carbon::now();
            }
            $type->signup = $item["signup"];
            $type->decline = $item["decline"];
            $type->save();
        }
    }
}
