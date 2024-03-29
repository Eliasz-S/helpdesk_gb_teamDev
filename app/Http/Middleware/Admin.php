<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
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
        $user = Auth::user()
            ->load('userRole');

        $role = optional($user->userRole)->code;

        if ($role !== 'ROLE_ADMIN' && $role !== 'ROLE_SUPER_ADMIN') {
            abort(404);
        }

        return $next($request);
    }
}
