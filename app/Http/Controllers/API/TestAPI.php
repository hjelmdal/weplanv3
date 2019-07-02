<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestAPI extends Controller
{
    public function test(Request $request) {
        return response()->json($request);
    }
}
