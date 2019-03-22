<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{


    public function login() {
        return redirect()->route("login");
    }
}
