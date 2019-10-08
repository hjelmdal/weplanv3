<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->is('api/*')) {
            if ($request->header('Authorization')) {
                try {
                    $token = $request->header("Authorization");
                    $user = User::where('api_token', $token)->firstOrFail();
                } catch (ModelNotFoundException $e) {
                    Log::error("User with token: " . $token . " NOT FOUND");
                    return response()->json(["message" => 'Unauthorized! - Please log in!'], 401);

                }
                $request->attributes->add(['user' => $user]);
                if (!$user->isComplete()) {
                    return response()->json(["message" => 'User details not completed!', "redirect" => route("verification.notice")], 403);
                }

                return $next($request);
            }
        } else {
            $user = Auth::user();

            if (!$user) {
                return redirect('login');
            }
            if (!$user->isComplete()) {
                return redirect(route("verification.notice"));
            }
            return $next($request);
        }
    }
}
