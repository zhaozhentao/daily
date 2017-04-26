<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class TopicMiddleWare
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
        if (!Auth::check() || !Auth::user()->can('manage_topics')) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
