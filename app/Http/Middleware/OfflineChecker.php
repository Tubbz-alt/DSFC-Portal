<?php

namespace App\Http\Middleware;

use Closure;
use Config;


class OfflineChecker
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
        $url=$request->url();
        if(Config::get('app.offline') AND ($request->path() !== "under-construction") AND (strpos($url, 'localhost')===FALSE))
        {
            return redirect('/under-construction');            
        }
        return $next($request);
    }
}
