<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class AdminUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u = User::firstOrNew(["email" => "stephan@pixel8.dk"]);
            $activate = false;
        if(!$u->exists) {
            $activate = true;
            $u->id = 1000;
            $u->name = "Administrator";
            $u->password = bcrypt(Str::random(20));
        }

        $u->assignRole(Role::findByName("super-admin","web"));
        $u->save();
        if($activate) {
            $u->generateActivationFlow();
        }

        $u = User::firstOrNew(["email" => "mortenspjuth@gmail.com"]);
        $activate = false;
        if(!$u->exists) {
            $activate = true;
            $u->id = 2000;
            $u->name = "Administrator";
            $u->password = bcrypt(Str::random(20));
        }

        $u->assignRole(Role::findByName("super-admin","web"));
        $u->save();
        if($activate) {
            $u->generateActivationFlow();
        }

    }
}
