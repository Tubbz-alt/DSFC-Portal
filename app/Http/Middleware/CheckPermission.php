<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class CheckPermission
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($user = Sentinel::check()) {
            return $next($request);
        } else {
            return redirect('user/login');
        }
    }

}