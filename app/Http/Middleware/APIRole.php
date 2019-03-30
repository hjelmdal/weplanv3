<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Exceptions\UnauthorizedException;

class APIRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if($request->header('Authorization')) {
            try {
                $token = $request->header("Authorization");
                $user = User::where('api_token', $token)->firstOrFail();

            } catch (ModelNotFoundException $e) {
                Log::error("NOT FOUND");
                return $this->_401();

            }

            $roles = is_array($role)
                ? $role
                : explode('|', $role);

            if(!$user->hasAnyRole($roles)) {
                return $this->_403();
            } else {
                return $next($request);
            }
        } else {
            return $this->_401();
        }
    }

    private function _401() {
        return response()->json(["message => Unauthorized!"],401);
    }
    private function _403() {
        return response()->json(["message => Forbidden!"],403);
    }
}
