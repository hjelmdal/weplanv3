<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ["super-admin","admin","coach","player"];
        foreach($roles as $r) {
            $role = Role::firstOrNew(["name" => $r]);
            if(!$role->exists) {
                $role->created_at = Carbon::now();
            } else {
                $role->updated_at = Carbon::now();
            }
            $role->name = $r;
            $role->guard_name = "web";
            $role->save();
        }
    }
}
