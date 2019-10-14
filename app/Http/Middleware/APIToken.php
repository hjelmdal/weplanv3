<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class APIToken
{
    protected $guard = "web";
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->header('Authorization')) {
            try {
                $token = $request->header("Authorization");
                $user = User::where('api_token', $token)->firstOrFail();
            } catch (ModelNotFoundException$e) {
                return response()->json(["message" => 'Unauthorized! Please log in', "header" => $request->header("Authorization")], 401);

            }
            $request->attributes->add(['user' => $user]);



            return $next($request);
        } else {
            return response()->json(["message => Unauthorized - Missing Token", "errors" => "Unauthorized - Missing Token"],401);
        }



    }
}
