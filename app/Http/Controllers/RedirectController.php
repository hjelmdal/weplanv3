<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectController extends Controller
{


    public function login() {
        if (Auth::check() && session('url.intended')) {
            return redirect(session('url.intended'));
        } else {
            return redirect()->route("login");
        }
    }
}
