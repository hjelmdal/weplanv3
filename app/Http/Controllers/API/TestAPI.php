<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestAPI extends Controller
{
    public function test(Request $request) {

        $validated = $request->validate([
            'password' => ['required',
                'min:6',
                'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/',
                'confirmed']
        ]);

        return response()->json($request);
    }
}
