<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class School
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = \App\Models\User::find($request->route()->parameter('id'));
        if($user && $user->user_type!='school'){
            abort(404);
            // return response()->json($request->route()->parameter('id'));
        }
        return $next($request);
    }
}
