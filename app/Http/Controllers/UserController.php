<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
        $user = Auth::user();
        return view("user.profile")->with("user", $user);
    }
    
    public function profile() {
        $user = Auth::user()->with("UserStatus");
        foreach ($user->userStatus as $s) {
            if ($s->type == "password") {

            }
        }
        
        return view("user.profile")->with("user", $user);
    }
}
