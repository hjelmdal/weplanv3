<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

class BuildApiResponse
{
    /**
    - Handle an incoming request.
     *
    - @param  \Illuminate\Http\Request  $request
    - @param  \Closure  $next
    - @param  string|null  $guard
    - @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $response = $next($request);
        $original = $response->getOriginalContent();
        if($request->header('Authorization')) {
            try {
                $token = $request->header("Authorization");
                $user = User::where('api_token', $token)->firstOrFail();
                $new = [
                    'user' => $user,
                    'data' => $original
                ];

            } catch (ModelNotFoundException $e) {
                $new = [
                    'user' => null,
                    'data' => $original
                ];
            }
        } else {
            $new = [
                'user' => null,
                'data' => $original
            ];
        }


       $request->replace(["user" => $user]);
        return $next($request);
    }
}
